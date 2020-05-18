<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'tb_fornecedor';
    protected $primaryKey = 'for_codigo';
    public $timestamps = false;
    protected $fillable = [
        'for_nome',
        'for_endereco',
        'for_numero',
        'for_bairro',
        'for_cidade',
        'for_uf',
        'for_cnpjcpf',
        'for_rgie',
        'for_telefone',
        'for_fax',
        'for_celular',
        'for_email'
    ];

    public function compras()
    {
        return $this->hasMany('App\Models\Venda','com_codigo');
    }
}
