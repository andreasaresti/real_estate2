<?php

namespace App\Http\Controllers\Listings;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActivePropertyTypesController extends Controller
{
    public function get_active_property_types(Request $request)
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

        $postData = [];

        $active_property_types_response = Helper::get_active_property_types($postData);       
        $active_property_types_response = json_decode($active_property_types_response);

        return response()->json($active_property_types_response);
    }
}
