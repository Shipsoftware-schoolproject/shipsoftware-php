<?php

namespace App\Http\Controllers;

use App\Helpers\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use App\Company;
use App\Ship;
use Illuminate\Validation\Rule;

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

    public function editUserView($UserID)
    {
        $roles = Role::all();
        $companies = Company::all();

        $user = User::find($UserID);
        if ($user == null) {
            return view('errors.custom', [
                'title' => 'Error',
                'message' => 'User not found!']);
        }

        return view('admin/add_user',
            [
                'type' => 'Muokkaa',
                'form_action' => url('/admin/users/edit/' . $user->UserID),
                'roles' => $roles,
                'companies' => $companies,
                'user' => $user
            ]
        );
    }

    public function addUser(Request $request)
    {
        $rules = User::rules();

        if ($request->input('RoleID') < 1) {
            $rules['RoleID'] = '';
        }

        if ($request->input('CompanyID') < 1) {
            $rules['CompanyID'] = '';
        }

        $this->validate($request, $rules);

        $request->merge(['Password' => Hash::make($request->Password)]);
        User::create($request->all());

        return redirect('/admin/users');
    }

    public function editUser(Request $request, $userid)
    {
        $rules = User::rules();

        $rules['Username'] = Rule::unique('Users')->ignore($userid, 'UserID');
        $rules['Email'] = Rule::unique('Users')->ignore($userid, 'UserID');

        if ($request->input('RoleID') < 1) {
            $rules['RoleID'] = '';
        }

        if ($request->input('CompanyID') < 1) {
            $rules['CompanyID'] = '';
        }

        if (strlen(trim($request->input('Password'))) <= 0) {
            $rules['Password'] = '';
        }

        $this->validate($request, $rules);

        $user = User::find($userid);
        if ($user == null) {
            Flash::add('danger', 'Käyttäjää ei löytynyt!');
            return back()->withInput($request->all());
        }

        if ($rules['Password'] != '') {
            $request->merge(['Password' => Hash::make($request->Password)]);
        } else {
            $request->merge(['Password' => $user->Password]);
        }

        $user = $user->fill($request->all());
        $user->UserID = $userid;

        $user->save();

        Flash::add('success', 'Käyttäjä muokattu onnistuneesti!');

        return redirect('/admin/users');
    }
}
