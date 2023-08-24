<?php

namespace App\Http\Controllers\Listings;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\Location;
use Illuminate\Http\Request;

class ActiveLocationController extends Controller
{
    public function get_active_location(Request $request)
    {
        $query = Location::whereIn('locations.id', function ($subquery) {
            $subquery->select('location_id')
                ->from('listings')
                ->where('published', '=', 1);
        });
        if ($request->has('municipality') && $request->municipality != '') {
            $query = $query->where('municipality_id', '=', $request->municipality);
        }
        if ($request->has('district') && $request->district != '') {
            $query = $query->join('municipalities', 'municipalities.id', '=', 'locations.municipality_id')
                ->where('municipalities.district_id', '=', $request->district);
        }
        $query = $query->select('locations.*')
            ->orderBy('locations.name', 'asc')
            ->distinct()
            ->paginate(1000);

        foreach ($query as $key => $row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;

            $listingCount  = Listing::where('published', '=', 1)->where('location_id', $row->id)->count();
            $query[$key]->listingCount = $listingCount;

            if($row->image != ''){
                $query[$key]->image = env('APP_IMG_URL') . '/storage/' . $row->image;
            }
        }

        $locations = $query;

        return response()->json($locations);
    }
}
