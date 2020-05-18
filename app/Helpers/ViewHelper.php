<?php

namespace App\Helpers;

use DateTime;

class ViewHelper
{
    public static function getEnumLabel(array $lista,$key)
    {
        if(isset($lista[$key]))
            return $lista[$key];

        return trans('enums.enumLabelNotIsset',['enum' => $key]);
    }

    public static function getDateFormat($date)
    {
        if($date == null)
            return null;

        $date = new DateTime($date);
        return $date->format('d/m/Y');
    }

    public static function getValorMonetarioFormat($valor)
    {
        if($valor == null || !is_numeric($valor))
            return '0,00';

        return number_format(floatval($valor),'2',',','.');
    }

    public static function converterInNumber($valor){
		if(preg_match('/,/',$valor)){
			$valor = str_replace('.', '',$valor);
			$valor = str_replace(',', '.',$valor);
		}
		
		return $valor;
	}
}