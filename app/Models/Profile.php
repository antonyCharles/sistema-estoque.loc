<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use App\Models\System;

class Profile extends Model
{
    protected $table = 'logn_profiles';
    protected $primaryKey = 'profile_id';
    protected $fillable = [
        'name',
        'description',
        'status',
        'created_at',
        'updated_at'
    ];

    /*
    |
    |   Métodos de relacionamento
    |
    */
    public function rolesProfile()
    {
        return $this->hasMany('App\Models\RoleProfile','profile_id');
    }

    public function parametersProfile()
    {
        return $this->hasMany('App\Models\ParameterProfile','profile_id');
    }
}
