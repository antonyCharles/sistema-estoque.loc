<?php

namespace App\Repositories\Interfaces;

use App\Models\Parameter;
use Illuminate\Support\Collection;

interface IParameterRepository
{
    public function getParametersAll() : Collection;

    public function getGParametersAllByActive() : Collection;

    public function getParameterById(int $id) : Parameter;

    public function insertParameter(array $dados) : bool;

    public function updateParameter(int $id, array $dados) : bool;

    public function deleteParameter(int $id, string $field) : bool;
}