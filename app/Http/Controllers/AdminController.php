<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use App\Company;

class AdminController extends Controller
{
    public function index()
    {
        if (!Auth::User()->isAdmin()) {
            // FIXME: Return some nice view..
            return 'You\'re not an Admin';
        }

        $users = User::with(['role', 'company'])->get();

        return view('admin')->with(['users' => $users, 'roles' => Role::all(), 'companies' => Company::all()]);
    }
}
