<?php


namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Feature;
use App\Models\FeatureListing;
use App\Models\Listing;
use App\Models\Location;
use App\Models\Municipality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class webListings extends Controller
{
    // http://localhost:8000/api/activelocation
    // http://localhost:8000/api/activemunicipality
    // http://localhost:8000/api/activedistrict
    // http://localhost:8000/api/activefeatures
    // http://localhost:8000/api/activelistings

    public function get_active_features(Request $request)
    {
        // $this->authorize('view-any', Size::class);

        $query = Feature::join('feature_listing', 'features.id', '=', 'feature_listing.feature_id')
                            ->join('listings', 'listings.id', '=', 'feature_listing.listing_id')
                            ->where('listings.published', true);
        $query = $query->select('features.*')
                ->orderBy('features.sequence', 'desc')
                ->orderBy('features.name', 'desc')
                ->distinct()
                ->paginate(1000);

        foreach ($query as $key=>$row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
        }

        $sizes = $query;

        return response()->json($sizes);
    }
    public function get_active_district(Request $request)
    {
        

        $query = District::whereIn('districts.id', function ($subquery) {
                                $subquery->select('location_id')
                                ->from('listings')
                                ->join('locations', 'listings.location_id', '=', 'locations.id')
                                ->join('municipalities', 'listings.location_id', '=', 'locations.id')
                                ->where('listings.published', '=', 1);
                            });
        if ($request->has('district')) {
            $query = $query->where('municipalities.district_id', '=', $request->district);
        }
        $query = $query->select('districts.*')
                ->orderBy('districts.name', 'asc')
                ->distinct()
                ->paginate(1000);

        

        foreach ($query as $key=>$row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
        }

        $districts = $query;

        return response()->json($districts);
    }
    public function get_active_municipality(Request $request)
    {
        // http://localhost:8000/api/activelocation
        // http://localhost:8000/api/activemunicipality

        $query = Municipality::whereIn('municipalities.id', function ($subquery) {
                                $subquery->select('municipality_id')
                                ->from('listings')
                                ->join('locations', 'listings.location_id', '=', 'locations.id')
                                ->where('published', '=', 1);
                            });
        if ($request->has('district')) {
            $query = $query->where('municipalities.district_id', '=', $request->district);
        }
        $query = $query->select('municipalities.*')
                ->orderBy('municipalities.name', 'asc')
                ->distinct()
                ->paginate(1000);

        

        foreach ($query as $key=>$row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
        }

        $municipality = $query;

        return response()->json($municipality);
    }
    public function get_active_location(Request $request)
    {
        // $this->authorize('view-any', Size::class);

        $query = Location::whereIn('locations.id', function ($subquery) {
            $subquery->select('location_id')
            ->from('listings')
            ->where('published', '=', 1);
        });
        if ($request->has('municipality')) {
            $query = $query->where('municipality_id', '=', $request->municipality);
        }
        if ($request->has('district')) {
            $query = $query->join('municipalities', 'municipalities.id', '=', 'locations.municipality_id')
                        ->where('municipalities.district_id', '=', $request->district);
        }
        $query = $query->select('locations.*')
                ->orderBy('locations.name', 'asc')
                ->distinct()
                ->paginate(1000);

        

        foreach ($query as $key=>$row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
        }

        $locations = $query;

        return response()->json($locations);
    }
    public function get_active_listings(Request $request)
    {
        // $request = $_REQUEST;
        

        $perPage = 20;
        $page = 1;
        $orderby = 'listings.id';
        $orderbytype = 'desc';

        if ($request->has('page') && is_numeric($request->page)) {
            $page = $request->page;
        }
        if ($request->has('per_page') && is_numeric($request->per_page)) {
            $perPage = $request->per_page;
        }
        
        $query = Listing::where('published', '=', 1);

        if ($request->has('features')) {
            foreach($request->features as $feature){
                $query = $query->whereIn('listings.id', function ($subquery) use ($feature) {
                    $subquery->select('listing_id')
                        ->from('feature_listing')
                        ->where('feature_listing.feature_id', $feature);
                });
            }
        }
        if ($request->has('id') && $request->id != '') {
            $query = $query->where('id', $request->id);
        }
        if ($request->has('locations') && count($request->locations) > 0) {
            $query = $query->whereIn('location_id', $request->locations);
        }

        if ($request->has('number_of_bedrooms') && $request->number_of_bedrooms != '') {
            $query = $query->where('number_of_bedrooms', $request->number_of_bedrooms);
        }

        if ($request->has('number_of_bathrooms') && $request->number_of_bathrooms != '') {
            $query = $query->where('number_of_bathrooms', $request->number_of_bathrooms);
        }
        if ($request->has('min_area_size') && $request->min_area_size != '') {
            $query = $query->where('area_size', '>=', $request->min_area_size);
        }
        if ($request->has('max_area_size') && $request->max_area_size != '') {
            $query = $query->where('area_size', '<=', $request->max_area_size);
        }
        if ($request->has('min_price') && $request->min_price != '') {
            $query = $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price != '') {
            $query = $query->where('price', '<=', $request->max_price);
        }

        if ($request->has('municipalities') && count($request->municipalities) > 0) {
            $query = $query->whereIn('listings.id', function ($subquery) use($request){
                $subquery->select('listings.id')
                ->from('listings')
                ->join('locations', 'listings.location_id', '=', 'locations.id')
                ->whereIn('locations.municipality_id', $request->municipalities);
            });
        }
        if ($request->has('listing_types') && count($request->listing_types) > 0) {
            $query = $query->whereIn('listings.id', function ($subquery) use($request){
                $subquery->select('listing_id')
                ->from('listing_listing_type')
                ->whereIn('listing_type_id', $request->listing_types);
            });
        }

        if ($request->has('customer_id') && $request->customer_id != '' && $request->has('show_favorites') &&  $request->show_favorites == 1) {
            $query = $query->whereIn('listings.id', function ($subquery) use($request){
                $subquery->select('listing_id')
                ->from('favorite_properties')
                ->where('customer_id', $request->customer_id);
            });
        }
        if ($request->has('sales_request_id') && $request->sales_request_id != '') {
            $query = $query->whereIn('listings.id', function ($subquery) use($request){
                $subquery->select('listing_id')
                ->from('sales_request_listings')
                ->where('sales_request_id', $request->sales_request_id);
            });
        }

        $query = $query
                    ->select('listings.*')                
                    ->orderBy($orderby, $orderbytype)
                    ->paginate($perPage, ['/*'], 'page', $page);

        foreach ($query as $key=>$row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
            $description_array = $row->description;
            $query[$key]->displaydescription = $description_array;

            $post = Listing::with('media')->find($row->id);
            $media = $post->media;
            
            $images_array = [];
            foreach ($media as $m) {
                $images_array[] = env('APP_URL').'/storage/'.$m->id.'/'.$m->file_name;
            }
            $query[$key]->images = $images_array;

            $features = DB::table('feature_listing')->where('listing_id', $row->id)->pluck('feature_id');
            // print_r($features);
            // return true;
            $features_array = Feature::whereIn('id', $features)->orderBy('name', 'asc')->get();;
            // print_r($features);
            // return true;
            $features = [];
            for($i = 0; $i < count($features_array); $i++){
                $name_array = $features_array[$i]->name;
                $features[] = $name_array;
            }
            $query[$key]->features = $features;
        }

        $products = $query; 

        return response()->json($products);
    }
}
