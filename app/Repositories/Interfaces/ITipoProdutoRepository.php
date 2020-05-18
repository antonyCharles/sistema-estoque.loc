<?php

namespace App\Repositories\Interfaces;

use App\Models\TipoProduto;
use Illuminate\Support\Collection;

interface ITipoProdutoRepository
{
    public function getAll() : Collection;

    public function getId(int $id) : TipoProduto;

    public function GetTipoProdutoAllSelect() : Collection;

    public function insert(array $dados) : bool;

    public function update(int $id, array $dados) : bool;

    public function delete(int $id, string $campo) : bool;
}