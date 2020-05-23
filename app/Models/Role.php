<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use App\Models\System;
use App\Models\RoleProfile;

class Role extends Model
{
    protected $table = 'logn_roles';
    protected $primaryKey = 'role_id';
    protected $fillable = [
        'name',
        'role',
		'role_father_id',
		'role_action_id',
        'system_id',
        'status',
        'created_at',
        'updated_at'
    ];


    /*
    |
    |   Métodos de relacionamento
    |
    */
    public function system()
    {
        return $this->belongsTo('App\Models\System','system_id');
	}
	
	public function roleAction()
    {
        return $this->belongsTo('App\Models\RoleAction','role_action_id');
    }

    public function childrenRoles()
    {
        return $this->hasMany(Role::class, 'role_father_id', 'role_id');
    }

    public function allChildrenRoles()
    {
        return $this->childrenRoles()->with('allChildrenRoles');
    }
}
