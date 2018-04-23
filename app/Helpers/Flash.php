<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class Flash {
    /**
     * Add flash to session's key as array
     *
     * @param $key
     * @param $value
     */
    public static function add($key, $value)
    {
        $values = Session::get($key, []);
        $values[] = $value;
        Session::flash($key, $values);
    }
}