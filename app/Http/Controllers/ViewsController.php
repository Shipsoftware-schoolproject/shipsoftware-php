<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

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
        $ship = DB::table('Ships')->where('IMO', $id)->first();
        if (!$ship) {
            // FIXME: Return a nice view
            return 'Ship not found';
        }

        $type = DB::table('ShipTypes')->where('ID', $ship->TypeID)->first();
        if ($type) {
            $ship->Type = $type->Name;
        }

        $gps = DB::table('GPS')->where('IMO', $id)->latest('UpdatedTime')->first();

        return view('ship')->with(['ship' => $ship, 'gps' => $gps]);
    }
}
