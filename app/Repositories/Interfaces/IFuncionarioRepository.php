<?php

namespace App\Repositories\Interfaces;

use App\Models\Funcionario;
use Illuminate\Support\Collection;

interface IFuncionarioRepository
{
    public function getAll() : Collection;

    public function getId(int $id) : Funcionario;

    public function GetFuncionarioAllSelect() : Collection;

    public function insert(array $dados) : bool;

    public function update(int $id, array $dados) : bool;

    public function delete(int $id, string $campo) : bool;
}