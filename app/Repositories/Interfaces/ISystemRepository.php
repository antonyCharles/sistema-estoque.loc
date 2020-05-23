<?php

namespace App\Repositories\Interfaces;

use App\Models\System;
use Illuminate\Support\Collection;

interface ISystemRepository
{
    public function getFirstSystem() : System;

    public function updateSystem(array $dados) : bool;
}