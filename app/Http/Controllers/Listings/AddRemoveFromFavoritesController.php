<?php

namespace App\Http\Controllers\Listings;

use App\Http\Controllers\Controller;
use App\Models\FavoriteProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AddRemoveFromFavoritesController extends Controller
{
    public function add_remove_to_favorites(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => [
                'required',
                'integer',
                Rule::exists('customers', 'id'),
            ],
            'listing_id' => [
                'required',
                'integer',
                Rule::exists('listings', 'id'),
            ]
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        $existingModel = FavoriteProperty::where('listing_id', $request->listing_id)
            ->where('customer_id', $request->customer_id)
            ->first();
        if ($existingModel) {
            $existingModel->delete();
        } else {
            FavoriteProperty::create([
                'customer_id' => $request->customer_id,
                'listing_id' => $request->listing_id
            ]);
        }

        return response()->json([
            'message' => 'Favorite Listing updated successfully'
        ], 201);
    }
}
