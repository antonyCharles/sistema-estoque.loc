<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class GroupParameter extends Model
{
    protected $table = 'logn_groups_parameters';
    protected $primaryKey = 'group_parameter_id';
    protected $fillable = [
        'name',
        'status',
        'created_at',
        'updated_at'
    ];

    /*
    |
    | Metodos de Relacionamento.
    |
    */
    public function parameters()
    {
        return $this->hasMany('App\Models\Parameter','group_parameter_id');
    }
}
