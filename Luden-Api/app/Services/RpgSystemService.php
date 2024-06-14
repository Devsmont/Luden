<?php

namespace App\Services;

use App\Http\Resources\V1\RpgSystemResource;
use App\Interfaces\Repositories\IRpgSystemRepository;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;

class RpgSystemService
{
    use HttpResponses;

    private IRpgSystemRepository $rpgSystemRepository;

    public function __construct(IRpgSystemRepository $rpgSystemRepository)
    {
        $this->rpgSystemRepository = $rpgSystemRepository;
    }

    public function get(int $id)
    {
        $rpgSystem = $this->rpgSystemRepository->get($id);
        return new RpgSystemResource($rpgSystem);
    }

    public function store(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'skill_dice' => 'required|int|in:4,6,8,10,12,20,100',
            'description' => 'required|string',
            'image_url' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->errors('Data Invalid', 422, $validator->errors());
        }

        $rpgSystem = $this->rpgSystemRepository->store($validator->validated());

        if ($rpgSystem) {
            return $this->success('Rpg System Created', 200, new RpgSystemResource($rpgSystem));
        }

        return $this->errors('Rpg System Created', 400);
    }

    public function getList()
    {
        $rpgSystem = $this->rpgSystemRepository->getList();
        return RpgSystemResource::collection($rpgSystem);
    }

    public function update(array $data, int $id)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'skill_dice' => 'required|int|in:4,6,8,10,12,20,100',
            'description' => 'required|string',
            'image_url' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->errors('Data Invalid', 422, $validator->errors());
        }

        $rpgSystemUpdated = $this->rpgSystemRepository->update($validator->validated(), $id);

        if ($rpgSystemUpdated) {
            return $this->
            success(
                'Rpg System Updated',
                200,
                new RpgSystemResource($rpgSystemUpdated)
            );
        }

        return $this->errors('Character not updated', 400);

    }

    public function delete(int $id)
    {
        $characterDeleted = $this->rpgSystemRepository->delete($id);

        if ($characterDeleted) {
            return $this->success('Character Deleted', 200);
        }

        return $this->errors('Character Not Deleted', 400);
    }

}
