<?php

namespace App\Repositories;

use App\Interfaces\Repositories\IRpgPlayerRepository;
use Illuminate\Database\Eloquent\Model;

class RpgPlayerRepositoryEloquent implements IRpgPlayerRepository
{
    protected Model $rpgPlayer;

    public function __construct(Model $rpgPlayer)
    {
        $this->rpgPlayer = $rpgPlayer;
    }

    public function get(int $id)
    {
        return $this->rpgPlayer->find($id);
    }

    public function store(array $data)
    {
        return $this->rpgPlayer->create($data);
    }

    public function getList()
    {
        return $this->rpgPlayer->all();
    }

    public function update(array $data, int $id)
    {
        $rpgPlayer = $this->rpgPlayer->find($id);
        $rpgPlayer->update($data);
        return $rpgPlayer;
    }

    public function delete(int $id)
    {
        return $this->rpgPlayer->find($id)->delete();
    }
}
