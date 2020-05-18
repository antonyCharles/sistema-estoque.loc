<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContaPagar extends Model
{
    protected $table = 'tb_contapagar';
    protected $primaryKey = 'cp_codigo';
    public $timestamps = false;
    protected $fillable = [
        'cp_valorconta',
        'cp_datavencimento',
        'cp_datapagamento',
        'nf_codigo',
        'cp_observacoes'
    ];
}
