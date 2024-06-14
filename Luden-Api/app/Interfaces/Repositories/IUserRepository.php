<?php

namespace App\Interfaces\Repositories;

use Illuminate\Database\Eloquent\Model;

interface IUserRepository
{
    public function __construct(Model $user);

    public function get(int $id);

    public function store(array $data);

    public function getList();

    public function update(array $data, int $id);

    public function delete(int $id);

}
