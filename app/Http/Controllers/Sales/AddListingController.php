<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\SalesRequestListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddListingController extends Controller
{
    public function add_listing(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sales_request_id' => 'required|integer|exists:sales_requests,id',
            'listing_id' => 'required|integer|exists:listings,id',
        ]);
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $listing = SalesRequestListing::create([
            'sales_request_id' => $request->sales_request_id,
            'listing_id' => $request->listing_id,
        ]);

        return response()->json([
            'message' => 'Listing added successfully',
            'list' => $listing,
        ], 201);
    }
}
