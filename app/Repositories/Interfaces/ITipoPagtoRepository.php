<?php

namespace App\Repositories\Interfaces;

use App\Models\TipoPagto;
use Illuminate\Support\Collection;

interface ITipoPagtoRepository
{
    public function getAll() : Collection;

    public function getId(int $id) : TipoPagto;

    public function GetTipoPagtoAllSelect() : Collection;

    public function insert(array $dados) : bool;

    public function update(int $id, array $dados) : bool;

    public function delete(int $id, string $campo) : bool;
}