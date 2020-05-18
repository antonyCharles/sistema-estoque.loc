<?php

namespace App\Repositories\Interfaces;

use App\Models\Compra;
use Illuminate\Support\Collection;

interface ICompraRepository
{
    public function getAll() : Collection;

    public function getId(int $id) : Compra;

    public function createCompraCompleta(array $dados) : int;

    public function update(int $id, array $dados) : bool;

    public function delete(int $id, string $campo) : bool;
}