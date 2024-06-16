<?php

namespace App\Services;

use App\Http\Resources\V1\RpgResource;
use App\Interfaces\Repositories\IRpgRepository;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;

class RpgService
{
    use HttpResponses;

    private IRpgRepository $rpgRepository;

    public function __construct(IRpgRepository $rpgRepository)
    {
        $this->rpgRepository = $rpgRepository;
    }

    public function get(int $id)
    {
        $rpg = $this->rpgRepository->get($id);
        return new RpgResource($rpg);
    }

    public function store(array $data)
    {
        $validator = Validator::make($data, [
            'rpg_system_id' => 'required|exists:rpg_systems,id',
            'name' => 'required|string',
            'description' => 'required|string',
            'image_url' => 'required|url',
        ]);

        if ($validator->fails()) {
            return $this->errors('Validation failed', 422, $validator->errors());
        }

        $rpgCreated = $this->rpgRepository->store($validator->validated());

        if ($rpgCreated) {
            return $this->success('Rpg Created', 200, new RpgResource($rpgCreated));
        }

        return $this->errors('Rpg Not Created', 400);

    }

    public function getList()
    {
        $rpgs = $this->rpgRepository->getList();
        return RpgResource::collection($rpgs);
    }

    public function update(array $data, int $id)
    {
        $validator = Validator::make($data, [
            'rpg_system_id' => 'required|exists:rpg_systems,id',
            'master_id' => 'required|exists:users,id',
            'name' => 'required|string',
            'description' => 'required|string',
            'image_url' => 'required|url',
            'rpg_date' => 'required|date'
        ]);

        if ($validator->fails()) {
            return $this->errors('Validation failed', 422, $validator->errors());
        }

        $rpgUpdated = $this->rpgRepository->update($validator->validated(), $id);

        if ($rpgUpdated) {
            return $this->success('Rpg Updated', 200, new RpgResource($rpgUpdated));
        }

        return $this->errors('Rpg Not Updated', 400);
    }

    public function delete(int $id)
    {
        $rpgDeleted = $this->rpgRepository->delete($id);

        if ($rpgDeleted) {
            return $this->success('Rpg Deleted', 200);
        }

        return $this->errors('Rpg Not Deleted', 400);
    }
}
