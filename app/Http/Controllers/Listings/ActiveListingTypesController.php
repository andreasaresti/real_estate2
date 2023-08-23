<?php

namespace App\Http\Controllers\Listings;

use App\Http\Controllers\Controller;
use App\Models\ListingType;
use Illuminate\Http\Request;

class ActiveListingTypesController extends Controller
{
    public function get_active_listing_types(Request $request)
    {
        // $this->authorize('view-any', Size::class);

        $query = ListingType::whereIn('listing_types.id', function ($subquery) {
            $subquery->select('listing_type_id')
                ->from('listings')
                ->join('listing_listing_type', 'listing_listing_type.listing_id', '=', 'listings.id')
                ->where('listings.published', '=', 1);
        });

        $query = $query->select('listing_types.*')
            ->orderBy('listing_types.name', 'asc')
            ->paginate(1000);

        foreach ($query as $key => $row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
        }

        $listing_types = $query;

        return response()->json($listing_types);
    }
}
