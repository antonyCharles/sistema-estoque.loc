<?php

namespace App\Enums;

use App\Services\Service;
use Exception;

class SexoEnum
{
    public static function get()
    {
        return Array(
			'M' => trans('enums.Masc'),
			'F' => trans('enums.Femi')
		);
    }

}