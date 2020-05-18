<?php

namespace App\Enums;

use App\Services\Service;
use Exception;

class StatusEnum
{
    public static function get()
    {
        return Array(
			'A' => trans('enums.Ativo'),
			'I' => trans('enums.Inativo')
		);
    }

}