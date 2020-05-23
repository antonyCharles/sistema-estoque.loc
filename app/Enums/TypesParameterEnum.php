<?php

namespace App\Enums;

use App\Services\Service;
use Exception;

class TypesParameterEnum
{
    public static function get()
    {
        return Array(
			'I' => trans('enums.input'),
			'N' => trans('enums.number'),
			'S' => trans('enums.select'),
			'M' => trans('enums.multiSelect')
		);
    }
}