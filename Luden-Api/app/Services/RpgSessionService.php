<?php

namespace App\Services;

use App\Http\Resources\V1\RpgSessionResource;
use App\Interfaces\Repositories\IRpgSessionRepository;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;

class RpgSessionService
{
    private IRpgSessionRepository $rpgSessionRepository;
    use HttpResponses;

    public function __construct(IRpgSessionRepository $rpgSessionRepository)
    {
        $this->rpgSessionRepository = $rpgSessionRepository;
    }

    public function get(int $id)
    {
        $session = $this->rpgSessionRepository->get($id);
        return new RpgSessionResource($session);
    }

    public function store(array $data)
    {

        $validator = Validator::make($data, [
            'rpg_id' => 'required|exists:rpgs,id',
            'name' => 'required|string',
            'session_notes' => 'required|string',
            'session_date' => 'required|date'
        ]);

        if ($validator->fails()) {
            return $this->errors('Validate fails', 422, $validator->errors());
        }

        $sessionCreated = $this->rpgSessionRepository->store($validator->validated());

        if ($sessionCreated) {
            return $this->success('Session Created', 200, new RpgSessionResource($sessionCreated));
        }

        return $this->errors('Session Not Created', 400);

    }

    public function getList()
    {
        return $this->rpgSessionRepository->getList();
    }

    public function update(array $data, int $id)
    {
        $validator = Validator::make($data, [
            'rpg_id' => 'required|exists:rpgs,id',
            'name' => 'required|string',
            'session_notes' => 'required|string',
            'session_date' => 'required|date'
        ]);

        if ($validator->fails()) {
            return $this->errors('Validate fails', 422, $validator->errors());
        }

        $sessionUpdated = $this->rpgSessionRepository->update($validator->validated(), $id);

        if ($sessionUpdated) {
            return $this->success('Session updated', 200, new RpgSessionResource($sessionUpdated));
        }

        return $this->errors('Session not updated', 400);
    }

    public function delete(int $id)
    {
        $sessionDeleted = $this->rpgSessionRepository->delete($id);
        if ($sessionDeleted) {
            return $this->success('Session Deleted', 200);
        }

        return $this->errors('Session not Deleted', 400);
    }
}
