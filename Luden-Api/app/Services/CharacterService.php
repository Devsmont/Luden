<?php

namespace App\Services;

use App\Http\Resources\V1\CharactersResource;
use App\Interfaces\Repositories\ICharacterRepository;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CharacterService
{
    use HttpResponses;

    private ICharacterRepository $characterRepository;

    public function __construct(ICharacterRepository $characterRepository)
    {
        $this->characterRepository = $characterRepository;
    }

    public function get(int $id)
    {
        $character = $this->characterRepository->get($id);

        if ($character->user_id == Auth::id() || $character->visibility){
            return new CharactersResource($character);
        }

        return [];
    }

    public function store(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'visibility' => 'required|boolean',
            'description' => 'required|string',
            'birth_date' => 'required|date',
            'image_url' => 'required|string',
            'status' => 'required|in:normal,morto,inconsciente,louco    ',
            'skills' => 'array',
            'skills.*.id' => 'exists:skills,id|required',
            'skills.*.value' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->errors('Data Invalid', 422, $validator->errors());
        }

        $characterCreated = $this->characterRepository->store($validator->validated());

        if ($characterCreated) {
            return $this->success('Character Created', 200, new CharactersResource($characterCreated));
        }

        return $this->errors('Character Not Created', 400);
    }

    public function getList()
    {
        $characters = $this->characterRepository->getList();
        return CharactersResource::collection($characters);
    }

    public function update(array $data, int $id)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'visibility' => 'required|boolean',
            'description' => 'required|string',
            'birth_date' => 'required|date',
            'image_url' => 'required|url',
            'status' => 'required|in:normal,dead,unconscious,insane',
            'skills' => 'array',
            'skills.*.id' => 'exists:skills,id|required',
            'skills.*.value' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->errors('Data Invalid', 422, $validator->errors());
        }

        $characterUpdated = $this->characterRepository->update($validator->validated(), $id);

        if ($characterUpdated) {
            return $this->
            success(
                'Character updated',
                200,
                new CharactersResource($characterUpdated->load('user', 'skill'))
            );
        }

        return $this->errors('Character not updated', 400);

    }

    public function delete(int $id)
    {
        $characterDeleted = $this->characterRepository->delete($id);

        if ($characterDeleted) {
            return $this->success('Character Deleted', 200);
        }

        return $this->errors('Character Not Deleted', 400);
    }
}
