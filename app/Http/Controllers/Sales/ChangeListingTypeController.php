<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\SalesRequestListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChangeListingTypeController extends Controller
{
    public function change_listing_type(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:sales_request_listings,id',
            'status' => 'required|string|in:open,not_interested',
        ]);
        // Check if the validation errors
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        SalesRequestListing::where('id', $request->id)->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Sales Request Listings updated successfully'
        ], 201);
    }
}
