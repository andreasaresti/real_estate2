<?php

namespace App\Http\Controllers\Listings;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class ActiveFeaturesController extends Controller
{
    public function get_active_features(Request $request)
    {
        $active_features_response = Helper::get_active_features();       
        $active_features_response = json_decode($active_features_response);

        return response()->json($active_features_response);
    }
}
