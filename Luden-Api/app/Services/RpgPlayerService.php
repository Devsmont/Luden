<?php

namespace App\Services;

use App\Http\Resources\V1\RpgPlayerResource;
use App\Interfaces\Repositories\IRpgPlayerRepository;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;

class RpgPlayerService
{
    protected IRpgPlayerRepository $rpgPlayer;
    use HttpResponses;

    public function __construct(IRpgPlayerRepository $rpgPlayer)
    {
        $this->rpgPlayer = $rpgPlayer;
    }

    public function get(int $id)
    {
        $rpgPlayer = $this->rpgPlayer->get($id);
        return new RpgPlayerResource($rpgPlayer);
    }

    public function store(array $data)
    {
        $validator = Validator::make($data, [
            'user_id' => 'required|exists:users,id',
            'rpg_id' => 'required|exists:rpgs,id'
        ]);

        if ($validator->fails()) {
            return $this->errors('Validation failed', 422, $validator->errors());
        }

        $playerCreated = $this->rpgPlayer->store($validator->validated());

        if ($playerCreated) {
            return $this->success('Player created', 200, new RpgPlayerResource($playerCreated));
        }

        return $this->errors('Player not created', 400);
    }

    public function getList()
    {
        $rpgPlayers = $this->rpgPlayer->getList();
        return RpgPlayerResource::collection($rpgPlayers);
    }

    public function update(array $data, int $id)
    {
        $validator = Validator::make($data, [
            'user_id' => 'required|exists:users,id',
            'rpg_id' => 'required|exists:rpgs,id'
        ]);

        if ($validator->fails()) {
            return $this->errors('Validation failed', 422, $validator->errors());
        }

        $playerUpdated = $this->rpgPlayer->update($validator->validated(), $id);

        if ($playerUpdated) {
            return $this->success('Player updated', 200, new RpgPlayerResource($playerUpdated));
        }

        return $this->errors('Player not updated', 400);
    }

    public function delete(int $id)
    {
        $playerDeleted = $this->rpgPlayer->delete($id);

        if ($playerDeleted) {
            return $this->success('player deleted', 200);
        }

        return $this->errors('player deleted', 400);
    }
}
