<?php

namespace App\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class Logger
{
    public static function log($level, $message)
    {
        if( isset(Auth::user()->email) ){
            $message = '['.Auth::user()->email.' - '.Auth::user()->cpf.'] - '.$message;
        }else{
            $message = '[N/A] - '.$message;
        };
        Log::channel('main')->$level($message);
    }
}
