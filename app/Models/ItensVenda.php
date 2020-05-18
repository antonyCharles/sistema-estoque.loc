<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItensVenda extends Model
{
    protected $table = 'tb_itensvenda';
    protected $primaryKey = 'itv_codigo';
    public $timestamps = false;
    protected $fillable = [
        'ven_codigo',
        'pro_codigo',
        'itv_embalagem',
        'itv_qtde',
        'itv_valorun',
        'itv_desc',
        'itv_valortotal'
    ];

    public function produto()
    {
        return $this->belongsTo('App\Models\Produto','pro_codigo');
    }
}
