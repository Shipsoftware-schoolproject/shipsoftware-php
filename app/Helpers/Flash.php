<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class Flash {
    public static function add($key, $value)
    {
        $values = Session::get($key, []);
        $values[] = $value;
        Session::flash($key, $values);
    }
}