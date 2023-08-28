<?php

namespace App\Http\Controllers\Listings;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActiveDeliveryTimesController extends Controller
{
    public function get_delivery_times(Request $request)
    {
        $delivery_times_response = Helper::get_delivery_times();       
        $delivery_times_response = json_decode($delivery_times_response);

        return response()->json($delivery_times_response);
    }
}
