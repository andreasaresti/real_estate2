<?php

namespace App\Http\Controllers\Listings;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActiveLocationController extends Controller
{
    public function get_active_location(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'district' => 'nullable|integer|exists:districts,id',
            'municipality' => 'nullable|integer|exists:municipalities,id',
        ]);
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $postData = [
            'district' => $request->district,
            'municipality' => $request->municipality,
        ];

        $active_location_response = Helper::get_active_location($postData);       
        $active_location_response = json_decode($active_location_response);

        return response()->json($active_location_response);
    }
}
