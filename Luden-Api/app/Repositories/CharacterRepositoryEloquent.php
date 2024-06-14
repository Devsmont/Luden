<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ICharacterRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CharacterRepositoryEloquent implements ICharacterRepository
{
    protected Model $character;

    public function __construct(Model $character)
    {
        $this->character = $character;
    }

    public function get(int $id)
    {
        $character = $this->character->find($id);
        return $character->load('user', 'skill');
    }

    public function store(array $data)
    {
        $character = [
          "user_id" => Auth::id(),
          ...$data
        ];

        $characterCreated = $this->character->create($character);

        if (isset($data['skills'])) {
            foreach ($data['skills'] as $skill) {
                $value = $skill['value'] ?? null;
                $characterCreated->skill()->attach($skill['id'], ['value' => $value]);
            }
        }

        return $characterCreated;
    }

    public function getList()
    {
        $userId = Auth::id();

        return $this->character
            ->where('user_id', $userId)
            ->orWhere('visibility', true)
            ->get();
    }


    public function update(array $data, int $id)
    {
        $character = $this->character->find($id);

        if ($character->user_id != Auth::id()){
            return false;
        }
        $characterData = ['user_id' => Auth::id(), ...$data];
        $characterUpdated = $character->update($characterData);

        if ($characterUpdated) {
            $character->skill()->detach();

            foreach ($data['skills'] as $skill) {
                $existingSkill = $character->skill()->where('skills.id', $skill['id'])->first();
                if ($existingSkill) {
                    $character->skill()->updateExistingPivot($skill['id'], ['value' => $skill['value']]);
                } else {
                    $character->skill()->attach($skill['id'], ['value' => $skill['value']]);
                }
            }

            return $this->character->find($id);
        }

        return $characterUpdated;
    }

    public function delete(int $id)
    {
        return $this->character->find($id)->delete();
    }
}
