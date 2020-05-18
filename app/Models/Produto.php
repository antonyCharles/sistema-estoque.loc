<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'tb_produtos';
    protected $primaryKey = 'pro_codigo';
    public $timestamps = false;
    protected $fillable = [
        'pro_descricao', 
        'tpp_codigo', 
        'pro_precocusto', 
        'pro_precovenda', 
        'pro_estoque', 
        'pro_embalagem', 
        'pro_ipi'
    ];

    public function tipoProduto()
    {
        return $this->belongsTo('App\Models\TipoProduto','tpp_codigo');
    }
}
