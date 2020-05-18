<?php

namespace App\Repositories\Interfaces;

use App\Models\Produto;
use Illuminate\Support\Collection;

interface IProdutoRepository
{
    public function getAll() : Collection;

    public function GetAllEmEstoque() : Collection;

    public function getId(int $id) : Produto;

    public function getInListId(array $listaId) : Collection;

    public function GetProdutoAllSelect() : Collection;

    public function insert(array $dados) : bool;

    public function update(int $id, array $dados) : bool;

    public function addQuantidadeList(Collection $lista) : void;

    public function removeQuantidadeList(Collection $lista) : void;

    public function delete(int $id, string $campo) : bool;
}