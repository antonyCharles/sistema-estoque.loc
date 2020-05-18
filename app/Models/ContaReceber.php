<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContaReceber extends Model
{
    protected $table = 'tb_contareceber';
    protected $primaryKey = 'cr_codigo';
    public $timestamps = false;
    protected $fillable = [
        'cr_valorconta',
        'cr_datavencimento',
        'cr_datarecebimento',
        'nf_codigo',
        'cr_observacoes'
    ];
}
