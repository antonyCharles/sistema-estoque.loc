<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PasswordReset extends Model
{
	protected $table = 'password_resets';
	public $timestamps = false;
    protected $fillable = [
        'email',
        'token',
        'created_at',
    ];
}
