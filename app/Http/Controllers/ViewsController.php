<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Facades\Auth;
use App\Company;
use App\Ship;
use App\ShipType;
use App\GPS;

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
            // TODO: Implementation
        }

        return view('main', [
            'ships' => $ships,
            'companies' => $companies
        ]);
    }

    /**
     * Show ship information page
     *
     * @param $id - Ship IMO
     * @return View
     */
    public function ship($id)
    {
        $ship = Ship::find($id);
        if (!$ship) {
            // FIXME: Return a nice view
            return view('errors.custom', ['title' => 'Error', 'message' => 'Ship was not found.']);
        }

        $company = DB::table('Companies')->where('ID', $ship->CompanyID)->first();

        $type = ShipType::find($ship->TypeID);
        if ($type) {
            $ship->Type = $type->Name;
        }

        $gps = GPS::find($id)->orderBy('UpdatedTime', 'desc')->take(1)->first();

        return view('ship')->with(['ship' => $ship, 'gps' => $gps,'company' => $company]);
    }
}
