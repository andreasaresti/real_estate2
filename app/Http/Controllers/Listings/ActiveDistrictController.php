<?php

namespace App\Http\Controllers\Listings;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Listing;
use Illuminate\Http\Request;

class ActiveDistrictController extends Controller
{
    public function get_active_district(Request $request)
    {
        $query = District::whereIn('districts.id', function ($subquery) {
            $subquery->select('district_id')
                ->from('listings')
                ->join('locations', 'listings.location_id', '=', 'locations.id')
                ->join('municipalities', 'listings.location_id', '=', 'locations.id')
                ->where('listings.published', '=', 1);
        });
        $query = $query->select('districts.*')
            ->orderBy('districts.name', 'asc')
            ->distinct()
            ->paginate(1000);



        foreach ($query as $key => $row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;

            if($row->image != ''){
                $query[$key]->image = env('APP_IMG_URL') . '/storage/' . $row->image;;
            }

            $listingCount  = Listing::join('locations', 'locations.id', '=', 'listings.location_id')
                                        ->join('municipalities', 'locations.municipality_id', '=', 'municipalities.id')
                                        ->where('listings.published', '=', 1)
                                        ->where('municipalities.district_id', $row->id)->count();
            $query[$key]->listingCount = $listingCount;
        }

        $districts = $query;

        return response()->json($districts);
    }
}
