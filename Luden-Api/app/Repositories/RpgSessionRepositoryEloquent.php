<?php

namespace App\Repositories;

use App\Interfaces\Repositories\IRpgSessionRepository;
use Illuminate\Database\Eloquent\Model;

class RpgSessionRepositoryEloquent implements IRpgSessionRepository
{
    protected Model $rpgSession;

    public function __construct(Model $rpgSession)
    {
        $this->rpgSession = $rpgSession;
    }

    public function get(int $id)
    {
        return $this->rpgSession->find($id);
    }

    public function store(array $data)
    {
        return $this->rpgSession->create($data);
    }

    public function getList()
    {
        return $this->rpgSession->all();
    }

    public function update(array $data, int $id)
    {
        $rpgSession = $this->rpgSession->find($id);
        $rpgSession->update();
        return $rpgSession;
    }

    public function delete(int $id)
    {
        return $this->rpgSession->find($id)->delete();
    }
}
