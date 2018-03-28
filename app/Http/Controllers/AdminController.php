<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class AdminController extends Controller
{
    public function index()
    {
        if (!Auth::User()->isAdmin()) {
            return 'You\'re not an Admin';
        }

        $users = User::with(['role', 'company'])->get();

        return view('admin')->with(['users' => $users]);
    }
}
