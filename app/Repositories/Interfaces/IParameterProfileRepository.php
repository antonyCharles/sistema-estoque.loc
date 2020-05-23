<?php

namespace App\Repositories\Interfaces;

interface IParameterProfileRepository
{
    public function alterParameterProfileUpdateInsertRemove(array $dados) : bool;
}