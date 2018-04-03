<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Ship;

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
}
