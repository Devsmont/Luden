<?php

namespace App\Interfaces\Repositories;

use Illuminate\Database\Eloquent\Model;

interface IRpgSystemRepository
{
    public function __construct(Model $rpgSystem);

    public function get(int $id);

    public function store(array $data);

    public function getList();

    public function update(array $data, int $id);

    public function delete(int $id);
}
