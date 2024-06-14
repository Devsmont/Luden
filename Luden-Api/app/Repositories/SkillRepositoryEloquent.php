<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ISkillRepository;
use Illuminate\Database\Eloquent\Model;

class SkillRepositoryEloquent implements ISkillRepository
{

    protected Model $skill;

    public function __construct(Model $skill)
    {
        $this->skill = $skill;
    }

    public function get(int $id)
    {
        return $this->skill->find($id);
    }

    public function store(array $data)
    {
        return $this->skill->create($data);
    }

    public function getList()
    {
        return $this->skill->all();
    }

    public function update(array $data, int $id)
    {
        $skill = $this->skill->find($id);
        $skill->update($data);

        return $skill;
    }

    public function delete(int $id)
    {
        return $this->skill->find($id)->delete();
    }
}
