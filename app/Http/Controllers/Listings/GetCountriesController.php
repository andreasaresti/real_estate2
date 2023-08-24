<?php

namespace App\Http\Controllers\Listings;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class GetCountriesController extends Controller
{
    public function get_countries(Request $request)
    {
        $query = Country::select('countries.*')
            ->orderBy('countries.name', 'asc')
            ->paginate(1000);

        foreach ($query as $key => $row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
        }

        $features = $query;

        return response()->json($features);
    }
}
