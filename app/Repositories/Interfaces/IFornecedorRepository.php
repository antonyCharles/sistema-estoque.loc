<?php

namespace App\Repositories\Interfaces;

use App\Models\Fornecedor;
use Illuminate\Support\Collection;

interface IFornecedorRepository
{
    public function getAll() : Collection;

    public function getId(int $id) : Fornecedor;

    public function GetFornecedorAllSelect() : Collection;

    public function insert(array $dados) : bool;

    public function update(int $id, array $dados) : bool;

    public function delete(int $id, string $campo) : bool;
}