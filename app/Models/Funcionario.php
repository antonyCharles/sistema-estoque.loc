<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = 'tb_funcionario';
    protected $primaryKey = 'fun_codigo';
    public $timestamps = false;
    protected $fillable = [
        'fun_nome', 
        'fun_endereco',
        'fun_numero',
        'fun_complemento',
        'fun_bairro',
        'fun_cidade',
        'fun_uf',
        'fun_cnpjcpf',
        'fun_rgie',
        'fun_sexo',
        'fun_nascimento',
        'fun_telefone',
        'fun_celular',
        'fun_email',
        'fun_salario'
    ];
}
