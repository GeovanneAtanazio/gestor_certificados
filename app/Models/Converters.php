<?php

namespace App\Models;

class Converters
{
    public static function convert_object_to_array($object, $key, $value)
    {
        $array = array();
        foreach($object as $atibutes){
            $array[$atibutes->$key]= $atibutes->$value;
        };
        return $array;
    }
}