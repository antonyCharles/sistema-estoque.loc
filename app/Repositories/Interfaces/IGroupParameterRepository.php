<?php

namespace App\Repositories\Interfaces;

use App\Models\GroupParameter;
use Illuminate\Support\Collection;

interface IGroupParameterRepository
{
    public function getGroupsParametersAll() : Collection;

    public function getGroupsParametersAllByActive() : Collection;

    public function GetGroupsParametersAllSelect() : Collection;

    public function getGroupParameterById(int $id)  : GroupParameter;

    public function insertGroupParameter(array $dados) : bool;

    public function updateGroupParameter(int $id, array $dados) : bool;

    public function deleteGroupParameter(int $id, string $field) : bool;
}