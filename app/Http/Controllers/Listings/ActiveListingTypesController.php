<?php

namespace App\Http\Controllers\Listings;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\ListingType;
use Illuminate\Http\Request;

class ActiveListingTypesController extends Controller
{
    public function get_active_listing_types(Request $request)
    {
        $active_listing_types_response = Helper::get_active_listing_types();       
        $active_listing_types_response = json_decode($active_listing_types_response);
        // $this->authorize('view-any', Size::class);

        

        return response()->json($active_listing_types_response);
    }
}
