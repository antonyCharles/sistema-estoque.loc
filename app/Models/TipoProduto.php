<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoProduto extends Model
{
    protected $table = 'tb_tipoproduto';
    protected $primaryKey = 'tpp_codigo';
    public $timestamps = false;
    protected $fillable = [
        'tpp_descricao', 
    ];

    public function itensCompras(){
        return $this->belongsToMany('App\Models\ItensCompra');
    }
    
    public function itensVendas(){
        return $this->belongsToMany('App\Models\ItensVenda');
    }

    public function tipoProduto(){
        return $this->belongsTo('App\Models\TipoProduto');
    }
}
