<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Support\Collection;

interface IFuncionarioRepository
{
    public function getAll() : Collection;

    public function getId(int $id) : User;

    public function GetFuncionarioAllSelect() : Collection;

    public function getUserByEmail(string $email) : User;

    public function insert(array $dados) : bool;

    public function update(int $id, array $dados) : bool;

    public function updateUserPassword(string $email, string $password) : bool;

    public function delete(int $id, string $campo) : bool;
}