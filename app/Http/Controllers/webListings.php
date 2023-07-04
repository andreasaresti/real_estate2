<?php


namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\District;
use App\Models\Feature;
use App\Models\FeatureListing;
use App\Models\FloorPlan;
use App\Models\Listing;
use App\Models\ListingType;
use App\Models\Location;
use App\Models\Municipality;
use App\Models\PropertyType;
use App\Models\FavoriteProperty;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class webListings extends Controller
{
    // http://localhost:8000/api/activelocation
    // http://localhost:8000/api/activemunicipality
    // http://localhost:8000/api/activedistrict
    // http://localhost:8000/api/activefeatures
    // http://localhost:8000/api/activelistings

    public function get_similar_listings(Request $request){
    }
    public function create_listing(Request $request){
    }
    public function get_countries(Request $request){
        $query = Country::select('countries.*')
                ->orderBy('countries.name', 'asc')
                ->paginate(1000);

        foreach ($query as $key=>$row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
        }

        $features = $query;

        return response()->json($features);
    }
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

        foreach ($query as $key=>$row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
        }

        $listing_types = $query;

        return response()->json($listing_types);
    }
    public function get_active_listing_types(Request $request)
    {
        // $this->authorize('view-any', Size::class);

        $query = ListingType::whereIn('listing_types.id', function ($subquery) {
            $subquery->select('listings.id')
            ->from('listings')
            ->join('listing_listing_type', 'listing_listing_type.listing_id', '=', 'listings.id')
            ->where('listings.published', '=', 1);
        });
        
        $query = $query->select('listing_types.*')
                ->orderBy('listing_types.name', 'asc')
                ->paginate(1000);

        foreach ($query as $key=>$row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
        }

        $listing_types = $query;

        return response()->json($listing_types);
    }
    public function get_active_features(Request $request)
    {
        // $this->authorize('view-any', Size::class);

        $query = Feature::whereIn('features.id', function ($subquery) {
            $subquery->select('listings.id')
            ->from('listings')
            ->join('feature_listing', 'feature_listing.listing_id', '=', 'listings.id')
            ->where('listings.published', '=', 1);
        });
        
        $query = $query->select('features.*')
                ->orderBy('features.name', 'asc')
                ->paginate(1000);

        foreach ($query as $key=>$row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
        }

        $features = $query;

        return response()->json($features);
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

        

        foreach ($query as $key=>$row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
        }

        $municipality = $query;

        return response()->json($municipality);
    }
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
        $select_values_array[] = 'listings.*';

        if ($request->has('customer_id')) {
            $select_values_array[] = 'favorite_properties.listing_id as favorite_properties_listing_id';
            $query = $query->leftJoin('favorite_properties', function ($join) use ($request) {
                $join->on('listings.id', '=', 'favorite_properties.listing_id')
                    ->where('favorite_properties.customer_id', '=', $request->customer_id);
            });
        }

        if ($request->has('search_term') && $request->search_term != '') {
            $search = $request->search_term;
            $query = $query
                        ->where('listings.id', 'LIKE', '%' . $search . '%')
                        ->orWhere('listings.ext_code', 'LIKE', '%' . $search . '%')
                        ->orWhere('listings.name', 'LIKE', '%' . $search . '%');
        }

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
            $query = $query->where('listings.id', $request->id);
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
                    ->select($select_values_array)               
                    ->orderBy($orderby, $orderbytype)
                    ->paginate($perPage, ['/*'], 'page', $page);

                    $listing_markers = [];
                    $listing_markers[] = ["id" => "marker-1",
                        "center" => [40.94401669296697, -74.16938781738281],
                        "icon" => "<i class='fa fa-home'></i>",
                        "title" => "Real House Luxury Villa",
                        "desc" => "Est St, 77 - Central Park South, NYC",
                        "price" => "€ 230,000",
                        "image" => "images/feature-properties/fp-1.jpg",
                        "link" => "single-property-1.html"];
                    $listing_markers[] = ["id" => "marker-2",
                        "center" => [40.77055783505125, -74.26002502441406],
                        "icon" => "<i class='fa fa-home'></i>",
                        "title" => "Real House Luxury Villa",
                        "desc" =>"Est St, 77 - Central Park South, NYC",
                        "price" => "€ 230,000",		
                        "image" => "images/feature-properties/fp-2.jpg",
                        "link" => "single-property-1.html"];
                        
                    $listing_markers[] = ["id" => "marker-3",
                        "center" => [40.7427837, -73.11445617675781],
                        "icon" => "<i class='fa fa-home'></i>",
                        "title" => "Real House Luxury Villa",
                        "desc" =>"Est St, 77 - Central Park South, NYC",
                        "price" => "€ 230,000",		
                        "image" => "images/feature-properties/fp-3.jpg",
                        "link" => "single-property-1.html"];
                        
                    $listing_markers[] = ["id" => "marker-4",
                        "center" => [40.70437865245596, -73.98674011230469],
                        "icon" => "<i class='fa fa-home'></i>",
                        "title" => "Real House Luxury Villa",
                        "desc" =>"Est St, 77 - Central Park South, NYC",
                        "price" => "€ 230,000",		
                        "image" => "images/feature-properties/fp-4.jpg",
                        "link" => "single-property-1.html"];
                        
                    $listing_markers[] = ["id" => "marker-5",
                        "center" => [40.641311, -73.778139],
                        "icon" => "<i class='fa fa-home'></i>",
                        "title" => "Real House Luxury Villa",
                        "desc" =>"Est St, 77 - Central Park South, NYC",
                        "price" => "€ 230,000",		
                        "image" => "images/feature-properties/fp-5.jpg",
                        "link" => "single-property-1.html"];
            
                    $listing_markers[] = ["id" => "marker-6",
                        "center" => [41.080938, -73.535957],
                        "icon" => "<i class='fas fa-dumbbell'></i>",
                        "title" => "Gym in Town",
                        "desc" =>"Est St, 77 - Central Park South, NYC",
                        "price" => "€ 230,000",
                        "image" => "images/popular-listings/6.jpeg",
                        "link" => "single-property-1.html"];
                        
                    $listing_markers[] = ["id" => "marker-7",
                        "center" => [41.079386, -73.519478],
                        "icon" => "<i class='fa fa-home'></i>",
                        "title" => "Real House Luxury Villa",
                        "desc" =>"Est St, 77 - Central Park South, NYC",
                        "price" => "€ 230,000",		
                        "image" => "images/feature-properties/fp-6.jpg",
                        "link" => "single-property-1.html"];
                        
                    $listing_markers[] = ["id" => "marker-8",
                        "center" => [52.368630, 4.895782],
                        "icon" => "<i class='fa fa-home'></i>",
                        "title" => "Real House Luxury Villa",
                        "desc" =>"Est St, 77 - Central Park South, NYC",
                        "price" => "€ 230,000",		
                        "image" => "images/feature-properties/fp-7.jpg",
                        "link" => "single-property-1.html"];
                        
                    $listing_markers[] = ["id" => "marker-9",
                        "center" => [52.350179, 4.634857],
                        "icon" => "<i class='fa fa-home'></i>",
                        "title" => "Real House Luxury Villa",
                        "desc" =>"Est St, 77 - Central Park South, NYC",
                        "price" => "€ 230,000",		
                        "image" => "images/feature-properties/fp-8.jpg",
                        "link" => "single-property-1.html"];
                        
                        
                    $listing_markers[] = ["id" => "marker-10",
                        "center" => [40.641311, -74.878139],
                        "icon" => "<i class='fa fa-home'></i>",
                        "title" => "Real House Luxury Villa",
                        "desc" =>"Est St, 77 - Central Park South, NYC",
                        "price" => "€ 230,000",		
                        "image" => "images/feature-properties/fp-9.jpg",
                        "link" => "single-property-1.html"];
            
                    $listing_markers[] = ["id" => "marker-11",
                        "center" => [40.641311, -75.458139],
                        "icon" => "<i class='fa fa-building'></i>",
                        "title" => "Real House Luxury Villa",
                        "desc" =>"Est St, 77 - Central Park South, NYC",
                        "price" => "€ 230,000",		
                        "image" => "images/feature-properties/fp-1.jpg",
                        "link" => "single-property-1.html"];
            
                    $listing_markers[] = ["id" => "marker-12",
                        "center" => [41.100000, -74.558139],
                        "icon" => "<i class='fa fa-home'></i>",
                        "title" => "Real House Luxury Villa",
                        "desc" =>"Est St, 77 - Central Park South, NYC",
                        "price" => "€ 230,000",		
                        "image" => "images/feature-properties/fp-2.jpg",
                        "link" => "single-property-1.html"];
                        
                    $listing_markers[] = ["id" => "marker-13",
                        "center" => [41.149000, -74.558139],
                        "icon" => "<i class='fa fa-home'></i>",
                        "title" => "Real House Luxury Villa",
                        "desc" =>"Est St, 77 - Central Park South, NYC",
                        "price" => "€ 230,000",		
                        "image" => "images/feature-properties/fp-3.jpg",
                        "link" => "single-property-1.html"];
                        
                    $listing_markers[] = ["id" => "marker-14",
                        "center" => [41.149000, -75.348139],
                        "icon" => "<i class='fa fa-home'></i>",
                        "title" => "Real House Luxury Villa",
                        "desc" =>"Est St, 77 - Central Park South, NYC",
                        "price" => "€ 230,000",		
                        "image" => "images/feature-properties/fp-4.jpg",
                        "link" => "single-property-1.html"];
                        
                    $listing_markers[] = ["id" => "marker-15",
                        "center" => [41.299000, -73.498139],
                        "icon" => "<i class='fa fa-building'></i>",
                        "title" => "Real House Luxury Villa",
                        "desc" =>"Est St, 77 - Central Park South, NYC",
                        "price" => "€ 230,000",		
                        "image" => "images/feature-properties/fp-5.jpg",
                        "link" => "single-property-1.html"];
                        
                    $listing_markers[] = ["id" => "marker-16",
                        "center" => [41.278000, -74.608139],
                        "icon" => "<i class='fa fa-building'></i>",
                        "title" => "Real House Luxury Villa",
                        "desc" =>"Est St, 77 - Central Park South, NYC",
                        "price" => "€ 230,000",		
                        "image" => "images/feature-properties/fp-6.jpg",
                        "link" => "single-property-1.html"];
                        
                    $listing_markers[] = ["id" => "marker-17",
                        "center" => [41.278000, -72.708139],
                        "icon" => "<i class='fa fa-building'></i>",
                        "title" => "Real House Luxury Villa",
                        "desc" =>"Est St, 77 - Central Park South, NYC",
                        "price" => "€ 230,000",		
                        "image" => "images/feature-properties/fp-7.jpg",
                        "link" => "single-property-1.html"];
                        
                    $listing_markers[] = ["id" => "marker-18",
                        "center" => [40.980000, -75.968139],
                        "icon" => "<i class='fa fa-building'></i>",
                        "title" => "Real House Luxury Villa",
                        "desc" =>"Est St, 77 - Central Park South, NYC",
                        "price" => "€ 230,000",		
                        "image" => "images/feature-properties/fp-8.jpg",
                        "link" => "single-property-1.html"];
                        
                    $listing_markers[] = ["id" => "marker-19",
                        "center" => [40.94401669296697, -74.909999],
                        "icon" => "<i class='fa fa-building'></i>",
                        "title" => "Real House Luxury Villa",
                        "desc" =>"Est St, 77 - Central Park South, NYC",
                        "price" => "€ 230,000",		
                        "image" => "images/feature-properties/fp-9.jpg",
                        "link" => "single-property-1.html"];

                        $listing_markers[] = ["id" => "marker-17",
                        "center" => [41.278000, -72.708139],
                        "icon" => "<i class='fa fa-building'></i>",
                        "title" => "Real House Luxury Villa",
                        "desc" =>"Est St, 77 - Central Park South, NYC",
                        "price" => "€ 230,000",		
                        "image" => "images/feature-properties/fp-7.jpg",
                        "link" => "single-property-1.html"];
                        
                    $listing_markers[] = ["id" => "marker-18",
                        "center" => [40.980000, -75.968139],
                        "icon" => "<i class='fa fa-building'></i>",
                        "title" => "Real House Luxury Villa",
                        "desc" =>"Est St, 77 - Central Park South, NYC",
                        "price" => "€ 230,000",		
                        "image" => "images/feature-properties/fp-8.jpg",
                        "link" => "single-property-1.html"];
                        
                    $listing_markers[] = ["id" => "marker-19",
                        "center" => [40.94401669296697, -74.909999],
                        "icon" => "<i class='fa fa-building'></i>",
                        "title" => "Real House Luxury Villa",
                        "desc" =>"Est St, 77 - Central Park South, NYC",
                        "price" => "€ 230,000",		
                        "image" => "images/feature-properties/fp-9.jpg",
                        "link" => "single-property-1.html"];

        foreach ($query as $key=>$row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
            $description_array = $row->description;
            $query[$key]->displaydescription = $description_array;
            $query[$key]->lisingmarker = $listing_markers[$key];

            $post = Listing::with('media')->find($row->id);
            $media = $post->media;
            
            $images_array = [];
            foreach ($media as $m) {
                $images_array[] = env('APP_URL').'/storage/'.$m->id.'/'.$m->file_name;
            }
            $query[$key]->images = $images_array;

            $features = DB::table('feature_listing')->where('listing_id', $row->id)->pluck('feature_id');
            $features_array = Feature::whereIn('id', $features)->orderBy('name', 'asc')->get();
            $features = [];
            for($i = 0; $i < count($features_array); $i++){
                $name_array = $features_array[$i]->name;
                $features[] = $name_array;
            }
            $query[$key]->features = $features;

            $floor_plan_array = FloorPlan::where('listing_id', $row->id)->get();
            for($i = 0; $i < count($floor_plan_array); $i++){
                $name_array = $floor_plan_array[$i]->name;
                $description_array = $floor_plan_array[$i]->description;
                $floor_plan_array[$i]->displayname = $name_array;
                $floor_plan_array[$i]->displaydescription = $description_array;
            }
            $query[$key]->floor_plans = $floor_plan_array;

            $listing_types = DB::table('listing_listing_type')->where('listing_id', $row->id)->pluck('listing_type_id');
            $listing_types_array = ListingType::whereIn('id', $listing_types)->orderBy('name', 'asc')->get();
            $listing_types = [];
            for($i = 0; $i < count($listing_types_array); $i++){
                $name_array = $listing_types_array[$i]->name;
                $listing_types[] = $name_array;
            }
            $query[$key]->listing_types = $listing_types;

            $property_type = PropertyType::where('id', $row->property_type_id)->first();
            $query[$key]->property_type = $property_type->name;

            $location = Location::where('id', $row->location_id)->first();
            $query[$key]->location_name = $location->name;

            if($row->image != ''){
                $query[$key]->image = env('APP_URL').'/storage/'.$row->image;
            }

            $query[$key]->in_favoriteproperties = 0;
            if(isset($query[$key]->favorite_properties_listing_id) && $query[$key]->favorite_properties_listing_id == $query[$key]->id){
                $query[$key]->in_favoriteproperties = 1;
            }
        }
        $products = $query; 

        return response()->json($products);
    }
    public function add_remove_to_favorites(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => [
                'required','integer',
                Rule::exists('customers', 'id'),
            ],
            'listing_id' => [
                'required','integer',
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
        } 
        else {
            FavoriteProperty::create([
                                'customer_id' => $request->customer_id, 
                                'listing_id' => $request->listing_id
                            ]);
        }

        return response()->json([
            'message' => 'Favorite Listing updated successfully'
        ], 201);
    }
    public function get_pagination(Request $request)
    {
        // Simulating a collection of items
        $items = Collection::make(range(1, $request->total));

        // Current page number
        $page = $request->current_page;

        // Number of items per page
        $perPage = $request->per_page;

        // Create a paginator instance
        $paginator = new LengthAwarePaginator(
            $items->forPage($page, $perPage),
            $items->count(),
            $perPage,
            $page,
            ['path' => url('/')] // Replace with your desired URL path
        );

        // Set the number of pages to show before and after the current page
        $paginator->withPath('');
        

        // Get the pagination array
        $paginationArray = $paginator->toArray();
        foreach($paginationArray['links'] as $key => $link){
            if($link['label'] == 'pagination.previous'){
                $paginationArray['links'][$key]['label'] = 'Previous';
            }
            if($link['label'] == 'pagination.next'){
                $paginationArray['links'][$key]['label'] = 'Next';
            }
        }
        return response()->json($paginationArray);
    }
}
