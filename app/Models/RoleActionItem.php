<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class RoleActionItem extends Model
{
    protected $table = 'logn_roles_actions_itens';
    protected $primaryKey = 'role_action_item_id';
    protected $fillable = [
        'name',
        'slug',
        'role_action_id',
        'status',
        'created_at',
        'updated_at'
    ];

    /*
    |
    |   Métodos de relacionamento
    |
    */
    public function roleAction()
    {
        return $this->belongsTo('App\Models\RoleAction','role_action_id');
    }
}
