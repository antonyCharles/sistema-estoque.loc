<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class System extends Model
{
    protected $table = 'logn_systems';
    protected $primaryKey = 'system_id';
    protected $fillable = [
        'name',
        'abrrev',
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
    public function roles()
    {
        return $this->hasMany('App\Models\Role','role_id');
    }
}
