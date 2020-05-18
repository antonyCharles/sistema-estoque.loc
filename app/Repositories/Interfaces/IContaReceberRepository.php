<?php

namespace App\Repositories\Interfaces;

use App\Models\ContaReceber;
use Illuminate\Support\Collection;

interface IContaReceberRepository
{
    public function getAll() : Collection;
    
    public function getId(int $id) : ContaReceber;

    public function insert(array $dados) : bool;

    public function insertForNotaFiscalVenda(int $notaFiscal, float $valornf, int $tpgCodigo) : bool;

    public function update(int $id,$dados) : bool;

    public function delete(int $id, string $campo) : bool;
}