<?php

namespace App\Http\Controllers\Listings;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\Municipality;
use Illuminate\Http\Request;

class ActiveMunicipalityController extends Controller
{
    public function get_active_municipality(Request $request)
    {
        $query = Municipality::whereIn('municipalities.id', function ($subquery) {
            $subquery->select('municipality_id')
                ->from('listings')
                ->join('locations', 'listings.location_id', '=', 'locations.id')
                ->where('published', '=', 1);
        });
        if ($request->has('district') && $request->district != '') {
            $query = $query->where('municipalities.district_id', '=', $request->district);
        }
        $query = $query->select('municipalities.*')
            ->orderBy('municipalities.name', 'asc')
            ->distinct()
            ->paginate(1000);



        foreach ($query as $key => $row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;

            if($row->image != ''){
                $query[$key]->image = env('APP_IMG_URL') . '/storage/' . $row->image;;
            }

            $listingCount  = Listing::join('locations', 'locations.id', '=', 'listings.location_id')
                                        ->where('listings.published', '=', 1)
                                        ->where('locations.municipality_id', $row->id)->count();
            $query[$key]->listingCount = $listingCount;
        }

        $municipality = $query;

        return response()->json($municipality);
    }
}
