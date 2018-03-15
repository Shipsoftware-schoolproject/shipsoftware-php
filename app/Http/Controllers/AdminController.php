<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (!Auth::User()->isAdmin()) {
            return 'You\'re not an Admin';
        }

        return view('admin');
    }
}
