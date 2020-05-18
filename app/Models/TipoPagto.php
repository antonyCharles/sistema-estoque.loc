<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPagto extends Model
{
    protected $table = 'tb_tipopagto';
    protected $primaryKey = 'tpg_codigo';
    public $timestamps = false;
    protected $fillable = [
        'tpg_descricao', 
        'tpg_qtde',
        'tpg_ativo'
    ];
}
