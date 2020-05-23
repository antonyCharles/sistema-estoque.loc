<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class RoleProfile extends Model
{
    protected $table = 'logn_roles_profiles';
    protected $primaryKey = 'role_profile_id';
    protected $fillable = [
        'profile_id',
        'role_id',
        'created_at',
        'updated_at',
        'create',
        'read',
        'update',
        'delete',
        
    ];

    /*
    |
    |   Métodos de relacionamento
    |
    */
    public function profile()
    {
        return $this->belongsTo('App\Models\Profile','profile_id');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role','role_id');
	}
}
