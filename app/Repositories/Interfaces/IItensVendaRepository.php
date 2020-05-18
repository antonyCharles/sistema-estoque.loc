<?php

namespace App\Repositories\Interfaces;

use App\Models\ItensVenda;
use Illuminate\Support\Collection;

interface IItensVendaRepository
{
    public function getAll() : Collection;

    public function getId(int $id) : ItensVenda;

    public function getItensVendaByVendaId(int $vendaId) : ItensVenda;

    public function createListItensVendaforVenda(array $dados, Collection $itensVendas) : float;

    public function insertForVenda(int $ven_codigo, Collection $listItensVenda) : void;

    public function insert(array $dados) : bool;

    public function update(int $id, array $dados) : bool;

    public function delete(int $id, string $campo) : bool;
}