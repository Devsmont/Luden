<?php

namespace App\Repositories;

use App\Interfaces\Repositories\IRpgRepository;
use Illuminate\Database\Eloquent\Model;

class RpgRepositoryEloquent implements IRpgRepository
{
    protected Model $rpg;

    public function __construct(Model $rpg)
    {
        $this->rpg = $rpg;
    }

    public function get(int $id)
    {
        return $this->rpg->find($id);
    }

    public function store(array $data)
    {
        return $this->rpg->create($data);
    }

    public function getList()
    {
        return $this->rpg->all();
    }

    public function update(array $data, int $id)
    {
        $rpg = $this->rpg->find($id);
        $rpgUpdated = $rpg->update($data);
        if ($rpgUpdated) {
            return $rpg;
        }
        return $rpgUpdated;
    }

    public function delete(int $id)
    {
        return $this->rpg->find($id)->delete();
    }
}
