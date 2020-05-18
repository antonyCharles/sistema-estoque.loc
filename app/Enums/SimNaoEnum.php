<?php

namespace App\Enums;

use App\Services\Service;
use Exception;

class SimNaoEnum
{
    public static function get()
    {
        return Array(
			'S' => trans('enums.Sim'),
			'N' => trans('enums.Nao')
		);
    }

}