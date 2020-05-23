<?php

namespace App\Repositories\Interfaces;

use App\Models\RoleAction;
use Illuminate\Support\Collection;

interface IRoleActionRepository
{
    public function getRoleActionById(int $id) : RoleAction;

    public function getRoleActionAll() : Collection;

    public function GetRolesActionsAllSelect() : Collection;

    public function insertRoleAction(array $dados) : bool;
    
    public function updateRoleAction(int $id, array $dados) : bool;

    public function deleteRoleAction(int $id, string $field) : bool;
}