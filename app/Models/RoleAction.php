<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class RoleAction extends Model
{
    protected $table = 'logn_roles_actions';
    protected $primaryKey = 'role_action_id';
    protected $fillable = [
        'name',
        'status',
        'created_at',
        'updated_at'
    ];

    /*
    |
    |   Métodos de relacionamento
    |
    */
    public function roleActionItens()
    {
        return $this->hasMany('App\Models\RoleActionItem','role_action_id');
    }
}
