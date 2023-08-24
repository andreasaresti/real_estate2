<?php

namespace App\Http\Controllers\Listings;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class ActiveFeaturesController extends Controller
{
    public function get_active_features(Request $request)
    {
        // $this->authorize('view-any', Size::class);

        $query = Feature::orderBy('features.name', 'asc');
        $query = $query->whereIn('features.id', function ($subquery) {
            $subquery->select('feature_listing.feature_id')
                ->from('listings')
                ->join('feature_listing', 'feature_listing.listing_id', '=', 'listings.id')
                ->where('listings.published', 1);
        });

        $query = $query->select('features.*')
            ->paginate(1000);

        foreach ($query as $key => $row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
        }

        $features = $query;

        return response()->json($features);
    }
}
