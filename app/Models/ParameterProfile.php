<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class ParameterProfile extends Model
{
    protected $table = 'logn_parameters_profiles';
    protected $primaryKey = 'parameter_profile_id';
    protected $fillable = [
        'value',
        'profile_id',
        'parameter_id',
        'created_at',
        'updated_at'
    ];

    /*
    |
    | Metodos de Relacionamento.
    |
    */
    public function profile()
    {
        return $this->belongsTo('App\Models\Profile','profile_id');
    }

    public function parameter()
    {
        return $this->belongsTo('App\Models\Parameter','parameter_id');
    }
}
