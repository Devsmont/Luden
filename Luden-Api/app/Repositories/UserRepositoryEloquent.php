<?php

namespace App\Repositories;

use App\Interfaces\Repositories\IUserRepository;
use Illuminate\Database\Eloquent\Model;

class UserRepositoryEloquent implements IUserRepository
{

    protected Model $user;

    public function __construct(Model $user)
    {
        $this->user = $user;
    }

    public function get(int $id)
    {
        return $this->user->find($id);
    }

    public function store(array $data)
    {
        return $this->user->create($data);
    }

    public function getList()
    {
        return $this->user->all();
    }

    public function update(array $data, int $id)
    {
        $user = $this->user->find($id);
        $user->update($data);
        return $user;
    }

    public function delete(int $id)
    {
        return $this->user->find($id)->delete();
    }
}
