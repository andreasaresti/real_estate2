<?php

namespace App\Http\Controllers\Listings;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActiveDistrictController extends Controller
{
    public function get_active_district(Request $request)
    {
        $active_district_response = Helper::get_active_district();       
        $active_district_response = json_decode($active_district_response);

        return response()->json($active_district_response);
    }
}
