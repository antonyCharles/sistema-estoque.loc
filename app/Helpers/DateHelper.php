<?php

namespace App\Helpers;

use DateTime;

class DateHelper
{
    public static function getString($date)
    {
        if($date == null)
            return null;

        $date = new DateTime($date);
        return $date->format('d/m/Y');
    }
}