<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\SalesRequestListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeleteListingController extends Controller
{
    public function delete_listing(Request $request)
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

        $listing = SalesRequestListing::where('sales_request_id', $request->sales_request_id)
            ->where('listing_id' , $request->listing_id) ->delete();

        return response()->json([
            'message' => 'Listing added successfully',
            'list' => $listing,
        ], 201);
    }
}
