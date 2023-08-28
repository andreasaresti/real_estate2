<?php

namespace App\Http\Controllers\Listings;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\Municipality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActiveMunicipalityController extends Controller
{
    public function get_active_municipality(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'district' => 'nullable|integer|exists:districts,id',
        ]);
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $postData = [
            'district' => $request->district,
        ];

        $active_municipality_response = Helper::get_active_municipality($postData);       
        $active_municipality_response = json_decode($active_municipality_response);

        

        return response()->json($active_municipality_response);
    }
}
