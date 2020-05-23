<?php

namespace App\Repositories\Interfaces;

interface IRoleActionItemRepository
{
    public function alterRoleActionItemUpdateInsertRemove(array $dados) : bool;
}