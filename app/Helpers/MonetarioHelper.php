<?php

namespace App\Helpers;


class MonetarioHelper
{
    public static function fromatarValorDB($valor){
		if(preg_match('/,/',$valor)){
			$valor = str_replace('.', '',$valor);
			$valor = str_replace(',', '.',$valor);
		}
		
		return $valor;
	}
}