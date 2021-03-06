<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Ship;
use App\User;
use Auth;

class APIController extends Controller
{
    /**
     * Get all ship ID's and names
     *
     * @param string $name
     * @return Response
     */
    public function get_ship_names($name = null)
    {
        $ships = null;

        if ($name === null) {
            $ships = Ship::with('latestGps')->get();
        } else {
            $ships = Ship::where('ShipName', 'LIKE', '%' . $name . '%')->get();
        }

        return response()->json(['found' => count($ships), 'ships' => $ships]);
    }

    /**
     * Add new user
     *
     * @param Request $request
     * @return Response
     */
    public function add_user(Request $request)
    {
        if (!Auth::User()->isAdmin()) {
            return response()->json(['Error' => 'You\'re not an admin'], 403);
        }

        $validator = Validator::make($request->all(), [
            'firstName' => 'required|max:30',
            'lastName' => 'required|max:30',
            'phoneNumber' => 'nullable|max:20',
            'email' => 'required|email',
            'username' => 'required|string|unique:users|max:30',
            'password' => 'required|string|max:60',
            'picture' => 'nullable|mimes:jpeg,png',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = new User;

        $user->FirstName = $request->firstName;
        $user->LastName = $request->lastName;
        $user->Phone = $request->phoneNumber;
        $user->Email = $request->email;
        $user->Username = $request->username;
        $user->Password = $request->password;
        $user->Picture = $request->userPicture;
        $user->RoleID = $request->role;
        $user->CompanyID = $request->company;
        $user->Updated = time();

        $user->save();

        return response()->json(['ok' => 'user added']);
    }
}
