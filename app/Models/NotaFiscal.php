<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotaFiscal extends Model
{
    protected $table = 'tb_notafiscal';
    protected $primaryKey = 'nf_codigo';
    public $timestamps = false;
    protected $fillable = [
        'nf_valornf',
        'nf_taxaimpostonf',
        'nf_valorimposto'
    ];

    public function contasReceber()
    {
        return $this->hasMany('App\Models\ContaReceber','nf_codigo');
    }

    public function contasPagar()
    {
        return $this->hasMany('App\Models\ContaPagar','nf_codigo');
    }
}
