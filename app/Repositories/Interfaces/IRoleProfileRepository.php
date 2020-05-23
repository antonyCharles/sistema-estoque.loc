<?php

namespace App\Repositories\Interfaces;

use App\Models\RoleProfile;
use Illuminate\Support\Collection;

interface IRoleProfileRepository
{
    public function getRoleProfileForCache() : Collection;

    public function ExistRelationshipRoleIdAndRoleActionId(int $roleId, int $roleActionId) : bool;

    public function alterRolesProfileUpdateInsertRemove(array $dados) : bool;
}