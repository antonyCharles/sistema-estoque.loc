<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'tb_compras';
    protected $primaryKey = 'com_codigo';
    public $timestamps = false;
    protected $fillable = [
        'tpg_codigo',
        'for_codigo',
        'nf_codigo',
        'com_datacompra',
        'com_valortotal',
        'com_observacoes',
        'com_status'
    ];

    public function notafiscal()
    {
        return $this->belongsTo('App\Models\NotaFiscal','nf_codigo');
    }

    public function fornecedor()
    {
        return $this->belongsTo('App\Models\Fornecedor','for_codigo');
    }

    public function tipopagto()
    {
        return $this->belongsTo('App\Models\TipoPagto','tpg_codigo');
    }

    public function itenscompras()
    {
        return $this->hasMany('App\Models\ItensCompra','com_codigo');
    }
}
