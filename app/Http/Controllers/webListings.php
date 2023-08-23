<?php


namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\Country;
use App\Models\District;
use App\Models\Feature;
use App\Models\FeatureListing;
use App\Models\FloorPlan;
use App\Models\Listing;
use App\Models\ListingType;
use App\Models\ListingListingType;
use App\Models\Location;
use App\Models\Municipality;
use App\Models\PropertyType;
use App\Models\FavoriteProperty;
use App\Models\DeliveryTime;
use App\Models\Agent;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Mail;
use App\Mail\SendMail;

class webListings extends Controller
{
    public function add_media(Request $request){
        $validator = Validator::make($request->all(), [
            'model_type' => 'required|string',
            'model_id' => 'required|integer',
            'image' => 'required|string',
        ]);
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $image = $request->image;
        $image_parts = explode(";base64", $image);
        $image_type_aux = explode('image/', $image_parts[0]);
        $image_type = $image_type_aux[1];
        $file = base64_decode($image_parts[1]);
        $safeName = 'signed_' . time() . "." . $image_type;
        $preName = 'signed_' . time();


        $model_type = str_replace("/", "\\", $request->model_type);
        
       
        $media_listing = Media::create(array(
            'model_type' =>  $model_type, 
            'model_id' => $request->model_id,
            'uuid' => rand(1,99999999999),
            'name' => $safeName,
            'size' => 520,
            'file_name' => $safeName,
            'collection_name' => 'images',
            'mime_type' => 'image/'.$image_type,
            'disk' => 'public',
            'conversions_disk' => 'public',
            'responsive_images' => array(),
            'manipulations' => array(),
            'custom_properties' => array(),
            'generated_conversions' => array('large-size' => true,"medium-size" => true, "thumb" => true)
        ));

        $imageId =  $media_listing->id;
        
        $success = file_put_contents(public_path('storage') . '/' . $safeName, $file);
        if (!file_exists(public_path('storage').'/'.$imageId)) 
        {     
            mkdir(public_path('storage').'/'.$imageId, 0777, true);
        }
        file_put_contents(public_path('storage').'/'.$imageId.'/'.$safeName, $file);
        if (!file_exists(public_path('storage').'/'.$imageId.'/conversions')) 
        {     
            mkdir(public_path('storage').'/'.$imageId.'/conversions', 0777, true);
        }
        file_put_contents(public_path('storage').'/'.$imageId.'/conversions'.'/'.$preName.'-large-size.jpg', $file);
        file_put_contents(public_path('storage').'/'.$imageId.'/conversions'.'/'.$preName.'-medium-size.jpg', $file);
        file_put_contents(public_path('storage').'/'.$imageId.'/conversions'.'/'.$preName.'-thumb.jpg', $file);


        return response()->json([
            'message' => 'Media added successfully',
            'media' => $media_listing,
        ], 201);
    }
    public function get_similar_listings(Request $request){
        $validator = Validator::make($request->all(), [
            'listing_id' => 'nullable|integer|exists:listings,id',
        ]);
        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $mainList = Listing::where('id', '=', $request->listing_id)->first();
       
        $query = Listing::where('published', '=', 1);
        $select_values_array[] = 'listings.*';
        $query = $query->where('location_id', $mainList->location_id);
        $query = $query->where('price', '>=', $mainList->price*0.8);
        $query = $query->where('price', '<=', $mainList->price*1.2);
        $query = $query->where('property_type_id', '<=', $mainList->property_type_id);
        
        $query = $query->select($select_values_array)->get();

        foreach ($query as $key => $row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
            $description_array = $row->description;
            $query[$key]->displaydescription = $description_array;

            $post = Listing::with('media')->find($row->id);
            $media = $post->media;

            $images_array = [];
            foreach ($media as $m) {
                $images_array[] = env('APP_URL') . '/storage/' . $m->id . '/' . $m->file_name;
            }
            $query[$key]->images = $images_array;

            $features = DB::table('feature_listing')->where('listing_id', $row->id)->pluck('feature_id');
            $features_array = Feature::whereIn('id', $features)->orderBy('name', 'asc')->get();
            $features = [];
            for ($i = 0; $i < count($features_array); $i++) {
                $name_array = $features_array[$i]->name;
                $features[] = $name_array;
            }
            $query[$key]->features = $features;

            $floor_plan_array = FloorPlan::where('listing_id', $row->id)->get();
            for ($i = 0; $i < count($floor_plan_array); $i++) {
                $name_array = $floor_plan_array[$i]->name;
                $description_array = $floor_plan_array[$i]->description;
                $floor_plan_array[$i]->displayname = $name_array;
                $floor_plan_array[$i]->displaydescription = $description_array;
            }
            $query[$key]->floor_plans = $floor_plan_array;

            $listing_types = DB::table('listing_listing_type')->where('listing_id', $row->id)->pluck('listing_type_id');
            $listing_types_array = ListingType::whereIn('id', $listing_types)->orderBy('name', 'asc')->get();
            $listing_types = [];
            for ($i = 0; $i < count($listing_types_array); $i++) {
                $name_array = $listing_types_array[$i]->name;
                $listing_types[] = $name_array;
            }
            $query[$key]->listing_types = $listing_types;

            $property_type = PropertyType::where('id', $row->property_type_id)->first();
            $query[$key]->property_type = $property_type->name;

            $location = Location::where('id', $row->location_id)->first();
            $query[$key]->location_name = $location->name;

            if ($row->image != '') {
                $query[$key]->image = env('APP_URL') . '/storage/' . $row->image;
            }

            $query[$key]->in_favoriteproperties = 0;
            if (isset($query[$key]->favorite_properties_listing_id) && $query[$key]->favorite_properties_listing_id == $query[$key]->id) {
                $query[$key]->in_favoriteproperties = 1;
            }
        }
        $products = $query;

        return response()->json($products);
    }
    public function create_listing(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer',
            'map' => 'nullable|string',
            'price_prefix' => 'nullable|string',
            'price_postfix' => 'nullable|string',
            'area_size' => 'required|integer',
            'area_size_prefix' => 'nullable|string',
            'area_size_postfix' => 'nullable|string',
            'number_of_bedrooms' => 'nullable|integer',
            'number_of_bathrooms' => 'nullable|integer',
            'number_of_garages_or_parkingpaces' => 'nullable|integer',
            'year_built' => 'nullable|integer',
            'address' => 'required|string',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'virtual_tour' => 'nullable|string',
            'energy_class' => 'nullable|string',
            'energy_performance' => 'nullable|string',
            'epc_current_rating' => 'nullable|string',
            'epc_potential_rating' => 'nullable|string',
            'location_id' => 'required|integer|exists:locations,id',
            'property_type_id' => 'required|integer|exists:property_types,id',
            'delivery_time_id' => 'required|integer|exists:delivery_times,id',
            'owner_id' => 'required|integer|exists:customers,id',
            'listing_type_id' => 'required|integer|exists:listing_types,id',
            'images' => 'nullable|array',
            'features' => 'nullable|array',
            'features.*' => 'exists:features,id',
        ]);
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $image = $request->image;
        $image_parts = explode(";base64", $image);
        $image_type_aux = explode('image/', $image_parts[0]);
        $image_type = $image_type_aux[1];
        $file = base64_decode($image_parts[1]);
        $safeName = 'listing_' . time() . "." . $image_type;
        file_put_contents(public_path('storage') . '/' . $safeName, $file);
        
        $listing = Listing::create([
            'name' => $request->name,
            'image' => $safeName,
            'description' => $request->description,
            'price' => $request->price,
            'map' => $request->map,
            'price_prefix' => $request->price_prefix,
            'price_postfix' => $request->price_postfix,
            'area_size' => $request->area_size,
            'area_size_prefix' => $request->area_size_prefix,
            'area_size_postfix' => $request->area_size_postfix,
            'number_of_bedrooms' => $request->number_of_bedrooms,
            'number_of_bashrooms' => $request->number_of_bashrooms,
            'number_of_garages_or_parkingpaces' => $request->number_of_garages_or_parkingpaces,
            'year_built' => $request->year_built,
            'published' => 0,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            '360_virtual_tour' => $request->virtual_tour,
            'energy_class' => $request->energy_class,
            'energy_performance' => $request->energy_performance,
            'epc_current_rating' => $request->epc_current_rating,
            'epc_potential_rating' => $request->epc_potential_rating,
            'location_id' => $request->location_id,
            'property_type_id' => $request->property_type_id,
            'delivery_time_id' => $request->delivery_time_id,
            'owner_id' => $request->owner_id,
        ]);
        
        
        foreach ($request->features as $key => $row) {
            $temp = FeatureListing::create([
                'listing_id' => $listing->id,
                'feature_id' => $row,
            ]);
        }
        $temp = ListingListingType::create([
            'listing_id' => $listing->id,
            'listing_type_id' => $request->listing_type_id,
        ]);
            
        foreach ($request->images as $key => $row) {
            $image = $row;
            $image_parts = explode(";base64", $image);
            $image_type_aux = explode('image/', $image_parts[0]);
            $image_type = $image_type_aux[1];
            $file = base64_decode($image_parts[1]);
            $safeName = 'signed_' . time() . "." . $image_type;
            $preName = 'signed_' . time();


            $model_type = str_replace("/", "\\", "App/Models/Listing");
            
        
            $media_listing = Media::create(array(
                'model_type' =>  $model_type, 
                'model_id' => $listing->id,
                'uuid' => rand(1,99999999999),
                'name' => $safeName,
                'size' => 520,
                'file_name' => $safeName,
                'collection_name' => 'images',
                'mime_type' => 'image/'.$image_type,
                'disk' => 'public',
                'conversions_disk' => 'public',
                'responsive_images' => array(),
                'manipulations' => array(),
                'custom_properties' => array(),
                'generated_conversions' => array('large-size' => true,"medium-size" => true, "thumb" => true)
            ));

            $imageId =  $media_listing->id;
            
            $success = file_put_contents(public_path('storage') . '/' . $safeName, $file);
            if (!file_exists(public_path('storage').'/'.$imageId)) 
            {     
                mkdir(public_path('storage').'/'.$imageId, 0777, true);
            }
            file_put_contents(public_path('storage').'/'.$imageId.'/'.$safeName, $file);
            if (!file_exists(public_path('storage').'/'.$imageId.'/conversions')) 
            {     
                mkdir(public_path('storage').'/'.$imageId.'/conversions', 0777, true);
            }
            file_put_contents(public_path('storage').'/'.$imageId.'/conversions'.'/'.$preName.'-large-size.jpg', $file);
            file_put_contents(public_path('storage').'/'.$imageId.'/conversions'.'/'.$preName.'-medium-size.jpg', $file);
            file_put_contents(public_path('storage').'/'.$imageId.'/conversions'.'/'.$preName.'-thumb.jpg', $file);

        }

        //sendmail
        $WebListingEmail = env("Web_Listing_Email");

        $testMailData = [
            'title' => 'Add a New Listing',
            'body' => 'User adds a new listing '
        ];

        Mail::to($WebListingEmail)->send(new SendMail($testMailData));
        
        return response()->json([
            'message' => 'Listings added successfully',
            'listing' => $listing,
        ], 201);
    }
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
                $query[$key]->image = ('APP_URL') . '/storage/' . $row->image;;
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
                $query[$key]->image = env('APP_URL') . '/storage/' . $row->image;;
            }

            $listingCount  = Listing::join('locations', 'locations.id', '=', 'listings.location_id')
                                        ->where('listings.published', '=', 1)
                                        ->where('locations.municipality_id', $row->id)->count();
            $query[$key]->listingCount = $listingCount;
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

        foreach ($query as $key => $row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;

            $listingCount  = Listing::where('published', '=', 1)->where('location_id', $row->id)->count();
            $query[$key]->listingCount = $listingCount;

            if($row->image != ''){
                $query[$key]->image = env('APP_URL') . '/storage/' . $row->image;
            }
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
        if ($request->has('orderbyName') && $request->orderbyName !== "") {
            $orderby = $request->orderbyName;
        }
        if ($request->has('orderbyType') && $request->orderbyType !== "") {
            $orderbytype = $request->orderbyType;
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

        if ($request->has('property_type_array') && count($request->property_type_array) > 0) {
            $query = $query->whereIn('property_type_id', $request->property_type_array);
        }
        if ($request->has('features')) {
            foreach ($request->features as $feature) {
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
        if ($request->has('owner_id') && $request->owner_id > 0) {
            $query = $query->where('owner_id', $request->owner_id);
        }
        if ($request->has('featured') && $request->featured == 1) {
            $query = $query->where('featured', $request->featured);
        }
        if ($request->has('popular') && $request->popular == 1) {
            $query = $query->where('popular', $request->popular);
        }
        if ($request->has('municipalities') && count($request->municipalities) > 0) {
            $query = $query->whereIn('listings.id', function ($subquery) use ($request) {
                $subquery->select('listings.id')
                    ->from('listings')
                    ->join('locations', 'listings.location_id', '=', 'locations.id')
                    ->whereIn('locations.municipality_id', $request->municipalities);
            });
        }
        if ($request->has('listing_types') && count($request->listing_types) > 0) {
            $query = $query->whereIn('listings.id', function ($subquery) use ($request) {
                $subquery->select('listing_id')
                    ->from('listing_listing_type')
                    ->whereIn('listing_type_id', $request->listing_types);
            });
        }

        if ($request->has('customer_id') && $request->customer_id != '' && $request->has('show_favorites') && $request->show_favorites == 1) {
            $query = $query->whereIn('listings.id', function ($subquery) use ($request) {
                $subquery->select('listing_id')
                    ->from('favorite_properties')
                    ->where('customer_id', $request->customer_id);
            });
        }
        if ($request->has('sales_request_id') && $request->sales_request_id != '') {
            $query = $query->whereIn('listings.id', function ($subquery) use ($request) {
                $subquery->select('listing_id')
                    ->from('sales_request_listings')
                    ->where('sales_request_id', $request->sales_request_id);
            });
        }

        $query = $query
            ->select($select_values_array)
            ->orderBy($orderby, $orderbytype)
            ->paginate($perPage, ['/*'], 'page', $page);

        foreach ($query as $key => $row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
            $description_array = $row->description;
            $query[$key]->displaydescription = $description_array;
            

            $post = Listing::with('media')->find($row->id);
            $media = $post->media;

            $images_array = [];
            foreach ($media as $m) {
                $images_array[] = env('APP_URL') . '/storage/' . $m->id . '/' . $m->file_name;
            }
            $query[$key]->images = $images_array;

            $features = DB::table('feature_listing')->where('listing_id', $row->id)->pluck('feature_id');
            $features_array = Feature::whereIn('id', $features)->orderBy('name', 'asc')->get();
            $features = [];
            for ($i = 0; $i < count($features_array); $i++) {
                $name_array = $features_array[$i]->name;
                $features[] = $name_array;
            }
            $query[$key]->features = $features;

            $floor_plan_array = FloorPlan::where('listing_id', $row->id)->get();
            for ($i = 0; $i < count($floor_plan_array); $i++) {
                $name_array = $floor_plan_array[$i]->name;
                $description_array = $floor_plan_array[$i]->description;
                $floor_plan_array[$i]->displayname = $name_array;
                $floor_plan_array[$i]->displaydescription = $description_array;
            }
            $query[$key]->floor_plans = $floor_plan_array;

            $listing_types = DB::table('listing_listing_type')->where('listing_id', $row->id)->pluck('listing_type_id');
            $listing_types_array = ListingType::whereIn('id', $listing_types)->orderBy('name', 'asc')->get();
            $listing_types = [];
            for ($i = 0; $i < count($listing_types_array); $i++) {
                $name_array = $listing_types_array[$i]->name;
                $listing_types[] = $name_array;
            }
            $query[$key]->listing_types = $listing_types;

            $query[$key]->property_type = '';
            $property_type = PropertyType::where('id', $row->property_type_id)->first();
            if($property_type){
                $query[$key]->property_type = $property_type->name;
            }
            

            $query[$key]->location_name = '';
            $location = Location::where('id', $row->location_id)->first();
            if($location){
                $query[$key]->location_name = $location->name;
            }
            

            if ($row->image != '') {
                $query[$key]->image = env('APP_URL') . '/storage/' . $row->image;
            }

            $query[$key]->in_favoriteproperties = 0;
            if (isset($query[$key]->favorite_properties_listing_id) && $query[$key]->favorite_properties_listing_id == $query[$key]->id) {
                $query[$key]->in_favoriteproperties = 1;
            }
            $listing_markers = [
                    "id" => "marker-1",
                    "center" => [34.7130838, 33.0879427],//[40.94401669296697, -74.16938781738281],
                    "icon" => "<i class='fa fa-home'></i>",
                    "title" => "Real House Luxury Villa",
                    "desc" => "Est St, 77 - Central Park South, NYC",
                    "price" => "€ 230,000",
                    "image" => "images/feature-properties/fp-1.jpg",
                    "link" => "single-property-1.html"
                ];
            $listing_markers['id'] = $row->id;
            $listing_markers['center'] = [$query[$key]->latitude,$query[$key]->longitude];
            $listing_markers['title'] = $query[$key]->displayname;
            $listing_markers['icon'] = "<i class='fa fa-home'></i>";
            $listing_markers['desc'] = $location->name;
            $listing_markers['price'] = "€".$row->price;
            $listing_markers['image'] = $query[$key]->image;
            $listing_markers['link'] = 'page/listing-details?index='.$row->id;
            $query[$key]->listingmarker = $listing_markers;
        }

        $products = $query;

        return response()->json($products);
    }
    public function add_remove_to_favorites(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => [
                'required',
                'integer',
                Rule::exists('customers', 'id'),
            ],
            'listing_id' => [
                'required',
                'integer',
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
        } else {
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
        $paginator1 = $paginator->onEachSide(1);


        // Get the pagination array
        $paginationArray = $paginator1->toArray();
        foreach ($paginationArray['links'] as $key => $link) {
            if ($link['label'] == 'pagination.previous') {
                $paginationArray['links'][$key]['label'] = 'Previous';
            }
            if ($link['label'] == 'pagination.next') {
                $paginationArray['links'][$key]['label'] = 'Next';
            }
        }
        return response()->json($paginationArray);
    }
    public function get_delivery_times(Request $request)
    {

        $query = DeliveryTime::select('delivery_times.*')
            ->orderBy('delivery_times.sequence', 'asc')
            ->distinct()
            ->paginate(1000);

        foreach ($query as $key => $row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
        }

        $result = $query;

        return response()->json($result);
    }
    public function save_position(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required',
            'longitude' => 'required',
            'index' => 'required',
            'flag' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        }
        if($request->flag == "listings"){
            Listing::where('id',$request->index)->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
        }
        if($request->flag == "locations"){
            Location::where('id',$request->index)->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
        }
        if($request->flag == "agencies"){
            Agent::where('id',$request->index)->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
        }
        if($request->flag == "municipalities"){
            Municipality::where('id',$request->index)->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
        }
        if($request->flag == "districts"){
            District::where('id',$request->index)->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
        }
        

        return response()->json(['success' => 'Product created successfully.']);
    }
    public function get_agencies(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'nullable|integer|exists:agencies,id',
            'perpage' => 'nullable|integer',
            'page' => 'nullable|integer',
        ]);

        $perPage = 20;
        if ($request->has('perpage') && $request->perpage != '') {
            $perPage = $request->perpage;
        }
        $page = 1;
        if ($request->has('page') && $request->page != '') {
            $page = $request->page;
        }

        $query = Agent::where('active', '=', 1);
       
        if ($request->has('id') && $request->id != '') {
            $query = $query->where('id', $request->id);
        }

        $query = $query
            ->select('*')
            ->orderBy('name', 'asc')
            ->paginate($perPage, ['/*'], 'page', $page);
        
        foreach ($query as $key => $row) {            
            if($row->image != ''){
                $query[$key]->image = env('APP_URL') . '/storage/' . $row->image;
            }
            else{
                $query[$key]->image = '';
            }
            if($row->country != ''){
                $query_country = Country::where('code', $row->country)->first();
                $query[$key]->country = $query_country->name;

            }
            else{
                $query[$key]->country = '';

            }
        }

        $result = $query;

        return response()->json($result);
    }
    public function get_active_listings_report(Request $request)
    {
        // $request = $_REQUEST;

        $query = Listing::where('published', '=', 1);
       
        if($request->offset  == ""){
            $offset = 0;
        }else{
            $offset = $request->offset;
        }
        if($request->limit  == ""){
            $limit = 0;
        }else{
            $limit = $request->limit;
        }
        $query = $query->skip($offset)->take($limit)->get();
        $data = array();
        foreach ($query as $key => $row) {
            $posts = array();
            $name_array = $row->name;
            $posts['Title'] = $name_array;
            $description_array = $row->description;
            $posts['Content'] =  $description_array;
            
            $post = Listing::with('media')->find($row->id);
            $media = $post->media;

            $images = "";
            if ($row->image != '') {
                $images = "|".env('APP_URL') . '/storage/' . $row->image;
            }

            foreach ($media as $m) {
                $images .= "|".env('APP_URL') . '/storage/' . $m->id . '/' . $m->file_name;
            }
            $posts['ImageURL'] = substr($images,1);

            $features = DB::table('feature_listing')->where('listing_id', $row->id)->pluck('feature_id');
            $features_array = Feature::whereIn('id', $features)->orderBy('name', 'asc')->get();
            $features = "";
            for ($i = 0; $i < count($features_array); $i++) {
                $name_array = $features_array[$i]->name;
                $features .= "|".$name_array;
            }
            $posts['PropertyFeatures'] = substr($features,1);

            $features = DB::table('feature_listing')->where('listing_id', $row->id)->pluck('feature_id');
            $features_array = Feature::whereIn('id', $features)->orderBy('name', 'asc')->get();
            $features = "";
            for ($i = 0; $i < count($features_array); $i++) {
                $name_array = $features_array[$i]->name;
                $features .= "|".$name_array;
            }
            $posts['PropertyFeatures'] = substr($features,1);

            $listing_types = DB::table('listing_listing_type')->where('listing_id', $row->id)->pluck('listing_type_id');
            $listing_types_array = ListingType::whereIn('id', $listing_types)->orderBy('name', 'asc')->get();
            $listing_types = "";
            for ($i = 0; $i < count($listing_types_array); $i++) {
                $name_array = $listing_types_array[$i]->name;
                $listing_types .= "|".$name_array;
            }
            $posts['PropertyType'] = substr($listing_types,1);

            $location = Location::where('id', $row->location_id)->first();
            $municipality = Municipality::where('id', $location->municipality_id)->first();
            $district = District::where('id', $municipality->district_id)->first();
            $country = Country::where('code', $district->country)->first();
            $posts['PropertyCity'] = $location->name;
            $posts['Address'] = $district->name.", ". $location->name.", ".$location->name. ", ".$country->name;

            $property_type = PropertyType::where('id', $row->property_type_id)->first();
            $posts['PropertyStatus'] = $property_type->name;

            $posts['REAL_HOMES_property_price'] = $row->price;
            $posts['REAL_HOMES_property_size'] = $row->area_size;
            $posts['REAL_HOMES_property_bedrooms'] = $row->number_of_bedrooms;
            $posts['REAL_HOMES_property_bathrooms'] = $row->number_of_bathrooms;
            $posts['REAL_HOMES_property_garage'] = $row->number_of_garages_or_parkingpaces;
            $posts['REAL_HOMES_property_id'] = $row->ext_code;
           
            $posts['Сoordinates'] = $row->latitude . "," . $row->longitude;

            if($row->developer_id > 0){
                $developers = Developer::where('id', $row->developer_id)->first();
                $posts['Developer'] = $developers->name;
            }else{
                $posts['Developer'] = "";
            }
            array_push($data,$posts);
        }
        $products['post'] = $data;

        return response()->xml($products);
    }
    public function load_xml(Request $request)
    {
        $remote_url = 'https://sabbiancoproperties.com/?feed=estate_rss_v2&limit=' . $request->records_per_page . '&offset=' . $request->page;
        $xml=simplexml_load_file($remote_url) or die("Error: Cannot create object");
        foreach($xml->post as $row)
        {

            $district = '';
            $municipality = '';
            $location = '';
            foreach(explode('|', (string)$row->PropertyCity) as $key=>$listing_location){
                if($key == 0){
                    $district = trim($listing_location);
                }
                else if($key == 1){
                    $municipality = trim($listing_location);
                }
                else if($key == 2){
                    $location = trim($listing_location);
                }
            }


            $listing_array = [];
            list($coordinate1, $coordinate2) = explode(",",$row->Сoordinates);
            $listing_array['title'] = (string)$row->Title;
            $listing_array['content'] = (string)$row->Content;
            $listing_array['property_status'] = (string)$row->PropertyStatus;
            $listing_array['price'] = (string)$row->REAL_HOMES_property_price;
            $listing_array['size'] = (string)$row->REAL_HOMES_property_size;
            $listing_array['bedrooms'] = (string)$row->REAL_HOMES_property_bedrooms;
            $listing_array['bathrooms'] = (string)$row->REAL_HOMES_property_bathrooms;
            $listing_array['garage'] = (string)$row->REAL_HOMES_property_garage;
            $listing_array['property_id'] = (string)$row->REAL_HOMES_property_id;
            $listing_array['address'] = (string)$row->Address;
            $listing_array['developer'] = (string)$row->Developer;            
            $listing_array['developer'] = (string)$row->Developer;            
            $listing_array['district'] = $district;
            $listing_array['municipality'] = $municipality;
            $listing_array['location'] = $location;
            $listing_array['coordinate1'] = $coordinate1;
            $listing_array['coordinate2'] = $coordinate2;

            DB::beginTransaction();

            try {
                $import_listings = DB::table('import_listings')->insert($listing_array);
                if($import_listings){
                    $property_type_array = explode('|', (string)$row->PropertyType);
                    $property_types = [];
                    foreach($property_type_array as $property_type){
                        $property_types[] = ['property_id' => (string)$row->REAL_HOMES_property_id, 'name' => $property_type];
                    }
                    if(count($property_types) > 0){
                        DB::table('import_property_types')->insert($property_types);
                    }
                    $images_array = explode('|', (string)$row->ImageURL);
                    $property_images = [];
                    foreach($images_array as $image){
                        $property_images[] = ['property_id' => (string)$row->REAL_HOMES_property_id, 'url' => $image];
                    }
                    if(count($property_images) > 0){
                        DB::table('import_property_images')->insert($property_images);
                    }
                    $features_array = explode('|', (string)$row->PropertyFeatures);
                    $property_features = [];
                    foreach($features_array as $feature){
                        $property_features[] = ['property_id' => (string)$row->REAL_HOMES_property_id, 'name' => $feature];
                    }
                    if(count($property_features) > 0){
                        DB::table('import_features')->insert($property_features);
                    }
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                // Handle the exception, possibly a duplicate entry error
                // return response()->json([
                //     'message' => 'Error occurred',
                //     'error' => $e->getMessage(),
                // ], 500);
            }
            

            

            
/*

            // print_r($row);
            return true;
            
            $name["en"] = trim($row->Title);
            $description["en"] = trim($row->Content);

            $developer_id = null;
            if($row->Developer !== null || $row->Developer !== ""){
                $temp = trim($row->Developer);
                if(!Developer::where("name",$temp)->exists()){
                    $result = Developer::insert(["name"=>$temp]);
                }
                $result = Developer::where("name", $temp)->first();
                $developer_id = $result->id;
            }
            
            $address = explode(",",trim($row->Address));
            $country = "";
            if(count($address) == 1){
                $location = trim($address[0]);
                $municipality = trim($address[0]);
                $district = trim($address[0]);
            }else if(count($address) == 2){
                $location = trim($address[0]);
                $municipality = trim($address[0]);
                $district = trim($address[1]);
            }else if(count($address) == 3){
                $location = trim($address[0]);
                $municipality = trim($address[1]);
                $district = trim($address[2]);
            }else{
                $location = trim($address[0]);
                $municipality = trim($address[1]);
                $district = trim($address[2]);
                $country = trim($address[3]);
                for($i=0;$i<count($address);$i++){
                    if(strpos($address[$i],"District")>0){
                        $district = trim($address[$i]);
                        $country = trim($address[$i+1]);
                        $municipality = trim($address[$i-1]);
                        $location = trim($address[0]);
                        for($j=1;$j<$i-1;$j++){
                            $location .= ", ".trim($address[$j]);
                        }
                    }
                }
            }
            if(Country::where("name",$country)->exists()){
                $result = Country::where("name",$country)->first();
                $country_code = $result->code;
            }else{
                $country_code = "";
            }
            
            if(!District::where("ext_code",$district)->exists()){
                $temp = '{"en":"'.$district.'"}';
                $result = District::insert(["ext_code"=>$district,
                                            "country"=>$country_code,
                                            "name"=>$temp,
                                            "latitude"=>$Сoordinates[0],
                                            "longitude"=>$Сoordinates[1]]);
            }
            $result = District::where("ext_code", $district)->first();
            $district_id = $result->id;
            
            if(!Municipality::where("ext_code",$municipality)->exists()){
                $temp = '{"en":"'.$municipality.'"}';
                $result = Municipality::insert(["ext_code"=>$municipality,
                                            "district_id"=>$district_id,
                                            "name"=>$temp,
                                            "latitude"=>$Сoordinates[0],
                                            "longitude"=>$Сoordinates[1]]);
            }
            $result = Municipality::where("ext_code", $municipality)->first();
            $municipality_id = $result->id;
            
            if(!Location::where("ext_code",$location)->exists()){
                $temp = '{"en":"'.$location.'"}';
                $result = Location::insert(["ext_code"=>$location,
                                            "municipality_id"=>$municipality_id,
                                            "name"=>$temp,
                                            "latitude"=>$Сoordinates[0],
                                            "longitude"=>$Сoordinates[1]]);
            }
            $result = Location::where("ext_code", $location)->first();
            $location_id = $result->id;
            
            if(!PropertyType::where("ext_code",$row->PropertyStatus)->exists()){
                $temp = '{"en":"'.$row->PropertyStatus.'"}';
                $result = PropertyType::insert(["ext_code"=>$row->PropertyStatus,
                                            "name"=>$temp]);
            }
            $result = PropertyType::where("ext_code",$row->PropertyStatus)->first();
            $property_type_id = $result->id;

            if(Listing::where("ext_code",$row->REAL_HOMES_property_id)->exists()){
                $result = Listing::where("ext_code",$row->REAL_HOMES_property_id)
                                ->update(["ext_code"=>$row->REAL_HOMES_property_id,
                                        "price"=>intval($row->REAL_HOMES_property_price),  
                                        "number_of_bedrooms"=>intval($row->REAL_HOMES_property_bedrooms), 
                                        "number_of_bathrooms"=>intval($row->REAL_HOMES_property_bathrooms), 
                                        "number_of_garages_or_parkingpaces"=>intval($row->REAL_HOMES_property_garage), 
                                        "name"=>json_encode($name), 
                                        "description"=>json_encode($description),
                                        "area_size"=>intval($row->REAL_HOMES_property_size),
                                        "address"=>$row->Address,
                                        "latitude"=>$Сoordinates[0],
                                        "longitude"=>$Сoordinates[1],
                                        "location_id"=>$location_id,
                                        "property_type_id"=>$property_type_id,
                                        "developer_id"=>$developer_id]);
            }else{
                $result = Listing::insert(["ext_code"=>$row->REAL_HOMES_property_id,
                                        "price"=>intval($row->REAL_HOMES_property_price),  
                                        "number_of_bedrooms"=>intval($row->REAL_HOMES_property_bedrooms), 
                                        "number_of_bathrooms"=>intval($row->REAL_HOMES_property_bathrooms), 
                                        "number_of_garages_or_parkingpaces"=>intval($row->REAL_HOMES_property_garage), 
                                        "name"=>json_encode($name), 
                                        "description"=>json_encode($description),
                                        "area_size"=>intval($row->REAL_HOMES_property_size),
                                        "address"=>$row->Address,
                                        "latitude"=>$Сoordinates[0],
                                        "longitude"=>$Сoordinates[1],
                                        "location_id"=>$location_id,
                                        "property_type_id"=>$property_type_id,
                                        "developer_id"=>$developer_id]);
            }
            $result = Listing::where("ext_code",$row->REAL_HOMES_property_id)->first();
            $listing_id = $result->id;

            $featuresArray = explode("|",$row->PropertyFeatures);
            for($i=0;$i<count($featuresArray);$i++){
                if(!Feature::where("ext_code",$featuresArray[$i])->exists()){
                    $temp = '{"en":"'.$featuresArray[$i].'"}';
                    $result = Feature::insert(["ext_code"=>$featuresArray[$i],
                                                "name"=>$temp]);
                }
                $result = Feature::where("ext_code",$featuresArray[$i])->first();
                $feature_id = $result->id;
                $features = DB::table('feature_listing')->insert(["listing_id"=>$listing_id,
                                                                "feature_id"=>$feature_id]);
            }

            $listingTypesArray = explode("|",$row->PropertyType);
            for($i=0;$i<count($listingTypesArray);$i++){
                if(!ListingType::where("ext_code",$listingTypesArray[$i])->exists()){
                    $temp = '{"en":"'.$listingTypesArray[$i].'"}';
                    $result = ListingType::insert(["ext_code"=>$listingTypesArray[$i],
                                                "name"=>$temp]);
                }
                $result = ListingType::where("ext_code",$listingTypesArray[$i])->first();
                $listing_type_id = $result->id;
                $listing_type = DB::table('listing_listing_type')->insert(["listing_id"=>$listing_id,
                                                                "listing_type_id"=>$listing_type_id]);
            }

            $imageArray = explode("|",$row->ImageURL);
        
            $result = Media::where('model_id',$listing_id)->delete();

            for($i=0;$i<count($imageArray);$i++){
                $ext = explode(".", basename($imageArray[$i]));
                $image = 'data:image/'.$ext[1].';base64,'.base64_encode(file_get_contents($imageArray[$i]));
                $image_parts = explode(";base64", $image);
                $image_type_aux = explode('image/', $image_parts[0]);
                $image_type = $image_type_aux[1];
                $file = base64_decode($image_parts[1]);
                $safeName = 'signed_' . time() . "." . $image_type;
                $preName = 'signed_' . time();
        
                $model_type = str_replace("/", "\\", "App/Models/Listing");
               
                $media_listing = Media::create(array(
                    'model_type' =>  $model_type, 
                    'model_id' => $listing_id,
                    'uuid' => rand(1,99999999999),
                    'name' => $safeName,
                    'size' => 520,
                    'file_name' => $safeName,
                    'collection_name' => 'images',
                    'mime_type' => 'image/'.$image_type,
                    'disk' => 'public',
                    'conversions_disk' => 'public',
                    'responsive_images' => array(),
                    'manipulations' => array(),
                    'custom_properties' => array(),
                    'generated_conversions' => array('large-size' => true,"medium-size" => true, "thumb" => true)
                ));
                
                $imageId =  $media_listing->id;
                
                $success = file_put_contents(public_path('storage') . '/' . $safeName, $file);
                if (!file_exists(public_path('storage').'/'.$imageId)) 
                {     
                    mkdir(public_path('storage').'/'.$imageId, 0777, true);
                }
                file_put_contents(public_path('storage').'/'.$imageId.'/'.$safeName, $file);
                if (!file_exists(public_path('storage').'/'.$imageId.'/conversions')) 
                {     
                    mkdir(public_path('storage').'/'.$imageId.'/conversions', 0777, true);
                }
                file_put_contents(public_path('storage').'/'.$imageId.'/conversions'.'/'.$preName.'-large-size.jpg', $file);
                file_put_contents(public_path('storage').'/'.$imageId.'/conversions'.'/'.$preName.'-medium-size.jpg', $file);
                file_put_contents(public_path('storage').'/'.$imageId.'/conversions'.'/'.$preName.'-thumb.jpg', $file);
                if($i==0){
                    $result = Listing::where("ext_code",$row->REAL_HOMES_property_id)
                                ->where("id",$listing_id)
                                ->update(["image"=>$imageId.'/conversions'.'/'.$preName.'-thumb.jpg']);
                }
            }
            */
        }
        return response()->json([
            'message' => 'Import Completed',
        ], 200);
    }
    public function get_listings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'listings' => 'required|array',
        ]);
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        $products = array();
        $listings =  $request->listings;
        foreach ($listings as $listing_id) {

            $query = Listing::where('id', '=', $listing_id)->first();;
    
            $name_array = $query->name;
            $query->displayname = $name_array;
            $description_array = $query->description;
            $query->displaydescription = $description_array;
            

            $post = Listing::with('media')->find($query->id);
            $media = $post->media;

            $images_array = [];
            foreach ($media as $m) {
                $images_array[] = env('APP_URL') . '/storage/' . $m->id . '/' . $m->file_name;
            }
            $query->images = $images_array;

            $features = DB::table('feature_listing')->where('listing_id', $query->id)->pluck('feature_id');
            $features_array = Feature::whereIn('id', $features)->orderBy('name', 'asc')->get();
            $features = [];
            for ($i = 0; $i < count($features_array); $i++) {
                $name_array = $features_array[$i]->name;
                $features[] = $name_array;
            }
            $query->features = $features;

            $floor_plan_array = FloorPlan::where('listing_id', $query->id)->get();
            for ($i = 0; $i < count($floor_plan_array); $i++) {
                $name_array = $floor_plan_array[$i]->name;
                $description_array = $floor_plan_array[$i]->description;
                $floor_plan_array[$i]->displayname = $name_array;
                $floor_plan_array[$i]->displaydescription = $description_array;
            }
            $query->floor_plans = $floor_plan_array;

            $listing_types = DB::table('listing_listing_type')->where('listing_id', $query->id)->pluck('listing_type_id');
            $listing_types_array = ListingType::whereIn('id', $listing_types)->orderBy('name', 'asc')->get();
            $listing_types = [];
            for ($i = 0; $i < count($listing_types_array); $i++) {
                $name_array = $listing_types_array[$i]->name;
                $listing_types[] = $name_array;
            }
            $query->listing_types = $listing_types;

            $property_type = PropertyType::where('id', $query->property_type_id)->first();
            $query->property_type = $property_type->name;

            $location = Location::where('id', $query->location_id)->first();
            $query->location_name = $location->name;

            if ($query->image != '') {
                $query->image = env('APP_URL') . '/storage/' . $query->image;
            }

            $query->in_favoriteproperties = 0;
            if (isset($query->favorite_properties_listing_id) && $query->favorite_properties_listing_id == $query->id) {
                $query->in_favoriteproperties = 1;
            }
            $listing_markers = [
                    "id" => "marker-1",
                    "center" => [34.7130838, 33.0879427],//[40.94401669296697, -74.16938781738281],
                    "icon" => "<i class='fa fa-home'></i>",
                    "title" => "Real House Luxury Villa",
                    "desc" => "Est St, 77 - Central Park South, NYC",
                    "price" => "€ 230,000",
                    "image" => "images/feature-properties/fp-1.jpg",
                    "link" => "single-property-1.html"
                ];
            $listing_markers['id'] = $query->id;
            $listing_markers['center'] = [$query->latitude,$query->longitude];
            $listing_markers['title'] = $query->displayname;
            $listing_markers['icon'] = "<i class='fa fa-home'></i>";
            $listing_markers['desc'] = $location->name;
            $listing_markers['price'] = "€".$query->price;
            $listing_markers['image'] = $query->image;
            $listing_markers['link'] = 'page/listing-details?index='.$query->id;
            $query->listingmarker = $listing_markers;
            array_push($products, $query);
        }
        return response()->json($products);
    }
}