<?php

namespace App\Services;

use App\Http\Resources\V1\SkillsResource;
use App\Interfaces\Repositories\ISkillRepository;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;

class SkillService
{
    use HttpResponses;

    private ISkillRepository $skillRepository;

    public function __construct(ISkillRepository $skillRepository)
    {
        $this->skillRepository = $skillRepository;
    }


    public function get(int $id)
    {
        $skill = $this->skillRepository->get($id);

        return new SkillsResource($skill);
    }

    public function store(array $data)
    {
        $validator = Validator::make($data, [
            'rpg_system_id' => 'required|exists:rpg_systems,id',
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->errors('Data Invalid', 422, $validator->errors());
        }

        $skillCreated = $this->skillRepository->store($validator->validated());

        if ($skillCreated) {
            return $this->success('Skill Created', 200, new SkillsResource($skillCreated));
        }

        return $this->errors('Skill Not Created', 400);
    }

    public function getList()
    {
        $skills = $this->skillRepository->getList();

        return SkillsResource::collection($skills);
    }

    public function update(array $data, int $id)
    {
        $validator = Validator::make($data, [
            'rpg_system_id' => 'required|exists:rpg_systems,id',
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->errors('Data Invalid', 422, $validator->errors());
        }

        $skillUpdated = $this->skillRepository->update($data, $id);

        if ($skillUpdated) {
            return $this->success('Skill Updated', 200, new SkillsResource($skillUpdated));
        }

        return $this->errors('Skill Not Updated', 400);
    }

    public function delete(int $id)
    {
        $userDeleted = $this->skillRepository->delete($id);

        if ($userDeleted) {
            return $this->success('Skill Deleted', 200);
        }

        return $this->errors('Skill Not Deleted', 400);
    }
}
