<?php

namespace App\Interfaces\Repositories;

use Illuminate\Database\Eloquent\Model;

interface IRpgSessionRepository
{
    public function __construct(Model $rpgSession);

    public function get(int $id);

    public function store(array $data);

    public function getList();

    public function update(array $data, int $id);

    public function delete(int $id);
}
