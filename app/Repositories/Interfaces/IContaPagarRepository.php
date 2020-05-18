<?php

namespace App\Repositories\Interfaces;

use App\Models\ContaPagar;
use Illuminate\Support\Collection;

interface IContaPagarRepository
{
    public function getAll() : Collection;

    public function getId(int $id) : ContaPagar;

    public function insert(array $dados) : bool;

    public function insertForNotaFiscalCompra(int $notaFiscal, float $valornf, int $tpgCodigo) : bool;

    public function update(int $id, array $dados) : bool;

    public function delete(int $id, string $campo) : bool;
}