<?php

namespace App\Repositories\Interfaces;

use App\Models\NotaFiscal;
use Illuminate\Support\Collection;

interface INotaFiscalRepository
{
    public function getAll() : Collection;

    public function getId(int $id) : NotaFiscal;

    public function GetNotaFiscalAllSelect() : Collection;

    public function insert(array $dados) : bool;

    public function insertForCompra(float $valornf, float $taxaimpostonf, float $valorimposto, int $tpgCodigo) : int;

    public function insertForVenda(float $valornf, float $taxaimpostonf, float $valorimposto, int $tpgCodigo) : int;

    public function update(int $id, array $dados) : bool;

    public function delete(int $id, string $campo) : bool;
}