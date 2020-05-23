<?php

namespace App\Models;

use Auth;
use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Services\CheckRoleService;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_funcionario';
    protected $primaryKey = 'fun_codigo';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
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
        'fun_salario',
        'name',
        'email',
        'profile_id',
        'password',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->belongsTo('App\Models\Profile','profile_id');
    }

    public function language()
    {
        return $this->belongsTo('App\Models\Language','language_id');
    }

    public function authorizeRoles($roles)
    {
        if($this->hasAnyRole($roles))
        {
            return true;
        }

        //abort(401, 'This action is unauthorized.');

        return false;
    }

    public function hasRole($role)
    {
        try
        {
            $serLogin = new CheckRoleService();

            if($serLogin->CheckRole(Auth::user()->profile_id,$role))
                return true;
            
        }
        catch(Exception $e)
        {
            return false;
        }

        return false;
    }

    public function hasAnyRole($roles)
    {
        if(is_array($roles))
        {
            foreach($roles as $role)
            {
                if($this->hasRole($role))
                    return true;
            }
        }
        else
        {
            if($this->hasRole($roles))
            {
                return true;
            }

        }
        
        return false;
    }
}
