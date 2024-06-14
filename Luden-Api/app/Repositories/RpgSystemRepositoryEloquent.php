<?php

namespace App\Repositories;

use App\Interfaces\Repositories\IRpgSystemRepository;
use Illuminate\Database\Eloquent\Model;

class RpgSystemRepositoryEloquent implements IRpgSystemRepository
{
    protected Model $rpgSystem;

    public function __construct(Model $rpgSystem)
    {
        $this->rpgSystem = $rpgSystem;
    }

    public function get(int $id)
    {
        return $this->rpgSystem->find($id);
    }

    public function store(array $data)
    {
        return $this->rpgSystem->create($data);
    }

    public function getList()
    {
        return $this->rpgSystem->all();
    }

    public function update(array $data, int $id)
    {
        $rpgSystem = $this->rpgSystem->find($id);
        $rpgSystem->update($data);
        return $rpgSystem;
    }

    public function delete(int $id)
    {
        return $this->rpgSystem->find($id)->delete();
    }
}
