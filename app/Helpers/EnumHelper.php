<?php

namespace App\Helpers;


class EnumHelper
{
    public static function getLabel($enum,$key)
    {
        $classe = 'App\\Enums\\' . $enum;
        $enum = $classe::get();
        if(isset($enum[$key]))
            return $enum[$key];

        return trans('enums.notIsset',['enum' => $key]);
    }

    public static function getEnum($enum)
    {
        $classe = 'App\\Enums\\' . $enum;
        return $classe::get();
    }
}