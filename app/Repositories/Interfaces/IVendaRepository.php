<?php

namespace App\Repositories\Interfaces;

use App\Models\Venda;
use Illuminate\Support\Collection;

interface IVendaRepository
{
    public function getAll() : Collection;

    public function getId(int $id) : Venda;

    public function createVendaCompleta(array $dados) : int;

    public function update(int $id, array $dados) : bool;

    public function delete(int $id, string $campo) : bool;
}