<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use App\Company;
use App\Ship;

class AdminController extends Controller
{
    public function ships()
    {
        $ships = Ship::with(['type', 'company'])->get();
        $companies = Company::all();

        return view('admin/ships')->with(['ships' => $ships, 'companies' => $companies]);
    }

    public function users()
    {
        $users = User::with(['role', 'company'])->get();

        return view('admin/users')->with(['users' => $users]);
    }

    public function addUserView()
    {
        $roles = Role::all();
        $companies = Company::all();

        return view('admin/add_user',
            [
                'type' => 'Lisää',
                'form_action' => url('/admin/users/add'),
                'roles' => $roles,
                'companies' => $companies
            ]
        );
    }

    public function addUser(Request $request)
    {
        $rules = User::rules();

        if ($request->input('role') < 1) {
            $rules['RoleID'] = '';
        }

        if ($request->input('company') < 1) {
            $rules['CompanyID'] = '';
        }

        $this->validate($request, $rules);

        $request->merge(['Password' => Hash::make($request->Password)]);
        User::create($request->all());

        return redirect('/admin/users');
    }
}
