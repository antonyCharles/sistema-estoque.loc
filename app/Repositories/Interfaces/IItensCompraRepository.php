<?php

namespace App\Repositories\Interfaces;

use App\Models\ItensCompra;
use Illuminate\Support\Collection;

interface IItensCompraRepository
{
    public function getAll() : Collection;

    public function getId(int $id) : ItensCompra;

    public function getItensCompraByCompraId(int $compraId) : ItensCompra;

    public function createListItensCompraforCompra(array $dados, Collection $itensCompras) : float;

    public function insertForCompra(int $com_codigo, Collection $listItensCompra) : void;

    public function update(int $id, array $dados) : bool;

    public function delete(int $id, string $campo) : bool;
}