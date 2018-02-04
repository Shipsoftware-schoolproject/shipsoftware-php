<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{
    /**
     * Get all ship ID's and names
     *
     * @param Request $request
     * @return Response
     */
    public function get_all_ship_names(Request $request)
    {
        $ships = DB::table('Ships')
                    ->select('Ships.IMO', 'ShipName', 'GPS.Lat', 'GPS.Lng')
                    ->leftJoin('GPS', function($join) {
                        $join->on('Ships.IMO', '=', 'GPS.IMO')
                            ->whereIn('ID', [DB::raw('SELECT MAX(ID) FROM GPS GROUP BY IMO')]);
                    })->get();

        return response()->json(['found' => count($ships), 'ships' => $ships]);
    }

    /**
     * Get all information about the ship
     *
     * @param Request $request
     * @param integer $id
     * @return Response
     */
    public function get_ship_info(Request $request, $id)
    {

    }

    /**
     * Get ship current location
     *
     * @param Request $request
     * @param integer $id
     * @return Response
     */
    public function get_ship_cur_location(Request $request, $id)
    {

    }

    /**
     * Get ship location history
     *
     * @param Request $request
     * @param integer $id
     * @return Response
     */
    public function get_ship_loc_history(Request $request, $id)
    {

    }
}
