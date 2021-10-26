<?php

namespace App\Models;

class Converters
{
    /**
     * Converte um objeto em um array que tem a relação chave valor personalizada.
     *
     * @param obj  $object
     * @param  $key
     * @param  $value
     *
     * @return \Illuminate\Http\Response
     */
    public static function convert_object_to_array($object, $key, $value)
    {
        $array = array();
        foreach($object as $atibutes){
            $array[$atibutes->$key]= $atibutes->$value;
        };
        return $array;
    }
}
