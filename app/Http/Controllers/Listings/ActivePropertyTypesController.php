<?php

namespace App\Http\Controllers\Listings;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class ActivePropertyTypesController extends Controller
{
    public function get_active_property_types(Request $request)
    {
        // $this->authorize('view-any', Size::class);

        $query = PropertyType::whereIn('property_types.id', function ($subquery) {
            $subquery->select('listings.property_type_id')
                ->from('listings')
                ->where('listings.published', '=', 1);
        });

        $query = $query->select('property_types.*')
            ->orderBy('property_types.name', 'asc')
            ->paginate(1000);

        foreach ($query as $key => $row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
        }

        $listing_types = $query;

        return response()->json($listing_types);
    }
}
