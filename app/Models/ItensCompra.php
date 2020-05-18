<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItensCompra extends Model
{
    protected $table = 'tb_itenscompra';
    protected $primaryKey = 'itc_codigo';
    public $timestamps = false;
    protected $fillable = [
        'com_codigo',
        'pro_codigo',
        'itc_embalagem',
        'itc_qtde',
        'itc_valorun',
        'itc_desc',
        'itc_valortotal',
    ];

    public function produto()
    {
        return $this->belongsTo('App\Models\Produto','pro_codigo');
    }
}
