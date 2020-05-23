<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Parameter extends Model
{
    protected $table = 'logn_parameters';
    protected $primaryKey = 'parameter_id';
    protected $fillable = [
        'label',
        'values_select',
        'group_parameter_id',
        'type_parameter',
        'status',
        'created_at',
        'updated_at'
    ];

    /*
    |
    |   Métodos de relacionamento
    |
    */
    public function groupParameter()
    {
        return $this->belongsTo('App\Models\GroupParameter','group_parameter_id');
    }
}
