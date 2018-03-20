<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Ship;
use App\ShipTypes;
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
        return view('main');
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
            return 'Ship not found';
        }

        $company = DB::table('Companies')->where('ID', $ship->CompanyID)->first();

        $type = ShipTypes::find($ship->TypeID);
        if ($type) {
            $ship->Type = $type->Name;
        }

        $gps = GPS::find($id)->orderBy('UpdatedTime', 'desc')->take(1)->first();

        return view('ship')->with(['ship' => $ship, 'gps' => $gps,'company' => $company]);
    }
}
