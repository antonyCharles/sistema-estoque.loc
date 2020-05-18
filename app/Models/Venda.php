<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $table = 'tb_vendas';
    protected $primaryKey = 'ven_codigo';
    public $timestamps = false;
    protected $fillable = [
        'fun_codigo',
        'tpg_codigo',
        'nf_codigo',
        'ven_datavenda',
        'ven_valortotal',
        'ven_observacoes',
        'ven_status'
    ];

    public function notafiscal()
    {
        return $this->belongsTo('App\Models\NotaFiscal','nf_codigo');
    }

    public function funcionario()
    {
        return $this->belongsTo('App\Models\Funcionario','fun_codigo');
    }

    public function tipopagto()
    {
        return $this->belongsTo('App\Models\TipoPagto','tpg_codigo');
    }
    
    public function itensvendas()
    {
        return $this->hasMany('App\Models\ItensVenda','ven_codigo');
    }
}
