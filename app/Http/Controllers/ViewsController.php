<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Company;
use App\Ship;
use App\User;

class ViewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ships = null;
        $companies = null;

        if (Auth::user()->isAdmin()) {
            $ships = Ship::with('latestGps')->get();
            $companies = Company::all();
        } else {
            $ships = Ship::with('latestGps')->where('CompanyID', User::find(Auth::id())->CompanyID)->get();
        }

        return view('main', [
            'ships' => $ships,
            'companies' => $companies
        ]);
    }

    /**
     * Show ship information page
     *
     * @param $imo - Ship IMO
     * @return View
     */
    public function ship($imo)
    {
        $ship = Ship::with(['latestGps', 'gps', 'company', 'type'])->get()->find($imo);
        if (!$ship) {
            return view('errors.custom', [
                'title' => 'Virhe',
                'message' => 'Laivaa ei löytynyt.']
            );
        }

        return view('ship')->with(['ship' => $ship]);
    }
}
