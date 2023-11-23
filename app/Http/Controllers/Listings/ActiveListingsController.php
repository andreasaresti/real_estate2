<?php

namespace App\Http\Controllers\Listings;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\FloorPlan;
use App\Models\Listing;
use App\Models\ListingType;
use App\Models\Location;
use App\Models\PropertyType;
use App\Models\SearchHash;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ActiveListingsController extends Controller
{

    public function download_listing_pdf(Request $request)
    {
        $query = Listing::where('published', '=', 1);
        $query = $row = $query->where('listings.id', $request->id)->with("media")->first();

        $row->displayname = $row->name;
        $row->displaydescription = $row->description;

        $media = $row->media;

        $images_array = [];
        foreach ($media as $m) {
            $images_array[] = env('APP_IMG_URL') . '/storage/' . $m->id . '/' . $m->file_name;
        }

        $row->images = $images_array;
        $row->price = number_format($row->price);

        $features = DB::table('feature_listing')->where('listing_id', $row->id)->pluck('feature_id');
        $features_array = Feature::whereIn('id', $features)->orderBy('name', 'asc')->get();
        $features = [];
        for ($i = 0; $i < count($features_array); $i++) {
            $name_array = $features_array[$i]->name;
            $features[] = $name_array;
        }
        $row->features = $features;

        $floor_plan_array = FloorPlan::where('listing_id', $row->id)->get();
        for ($i = 0; $i < count($floor_plan_array); $i++) {
            $name_array = $floor_plan_array[$i]->name;
            $description_array = $floor_plan_array[$i]->description;
            $floor_plan_array[$i]->displayname = $name_array;
            $floor_plan_array[$i]->displaydescription = $description_array;
        }
        $row->floor_plans = $floor_plan_array;

        $listing_types = DB::table('listing_listing_type')->where('listing_id', $row->id)->pluck('listing_type_id');
        $listing_types_array = ListingType::whereIn('id', $listing_types)->orderBy('name', 'asc')->get();
        $listing_types = [];
        for ($i = 0; $i < count($listing_types_array); $i++) {
            $name_array = $listing_types_array[$i]->name;
            $listing_types[] = $name_array;
        }
        $row->listing_types = $listing_types;

        $row->property_type = '';
        $property_type = PropertyType::where('id', $row->property_type_id)->first();
        if ($property_type) {
            $row->property_type = $property_type->name;
        }

        $row->location_name = '';
        $location = Location::where('id', $row->location_id)->first();
        if ($location) {
            $row->location_name = $location->name;
        }


        if ($row->image != '') {
            $row->image = env('APP_IMG_URL') . '/storage/' . $row->image;
        }

        $row->in_favoriteproperties = 0;
        if (isset($row->favorite_properties_listing_id) && $row->favorite_properties_listing_id == $row->id) {
            $row->in_favoriteproperties = 1;
        }

        set_time_limit(0);
        $pdf = PDF::loadView('api.listingPDF', ["data" => $row]);

        return $pdf->download('sabbianco - ' . $row->id . '.pdf');


        //  echo sys_get_temp_dir();

        return view("api.listingPDF", ["data" => $row]);
        // $pdf = PDF::loadView('api.listingPDF', $pdfData);
        // return $pdf->download('test.pdf');
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


        if ($request->has('number_of_bedrooms') && $request->number_of_bedrooms != '') {
            $query = $query->where('number_of_bedrooms', '>=', $request->number_of_bedrooms);
        }

        if ($request->has('number_of_bathrooms') && $request->number_of_bathrooms != '') {
            $query = $query->where('number_of_bathrooms', '>=', $request->number_of_bathrooms);
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

        if ($request->has('radius') && $request->radius[0] != '' && $request->radius[1] != '' && $request->set != 0) {
            $query = $query->whereRaw('(sqrt(pow( ? - latitude, 2) + pow( ? - longitude, 2))) < 0.0090437 * ?', [$request->radius[0], $request->radius[1], $request->set]);
        } else {
            if ($request->has('locations') && count($request->locations) > 0) {
                $query = $query->whereIn('location_id', $request->locations);
            }
            if ($request->has('municipalities') && count($request->municipalities) > 0) {
                $query = $query->whereIn('listings.id', function ($subquery) use ($request) {
                    $subquery->select('listings.id')
                        ->from('listings')
                        ->join('locations', 'listings.location_id', '=', 'locations.id')
                        ->whereIn('locations.municipality_id', $request->municipalities);
                });
            }
            if ($request->has('districts') && count($request->districts) > 0) {
                $query = $query->whereIn('listings.id', function ($subquery) use ($request) {
                    $subquery->select('listings.id')
                        ->from('listings')
                        ->join('locations', 'listings.location_id', '=', 'locations.id')
                        ->join('municipalities', 'locations.municipality_id', '=', 'municipalities.id')
                        ->whereIn('municipalities.district_id', $request->districts);
                });
            }
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
        if ($request->has('markers') && !empty($request->markers)) {

            $boundry = 'MULTIPOLYGON((';
            foreach ($request->markers as $poly) {
                $boundry .= "(";
                foreach ($poly as $p) {
                    $boundry .= number_format($p['lng'], 12, '.', '',) . " " . number_format($p['lat'], 12, '.', '',) . ",";
                }
                $boundry = substr($boundry, 0, -1) . "),";
            };
            $boundry = substr($boundry, 0, -1) . "))";
            $query = $query->whereRaw('ST_CONTAINS(ST_GEOMFROMTEXT(\'' . $boundry . '\'),Point(longitude,latitude))');

            $hash = SearchHash::where("hash", md5(json_encode($request->markers)))->first();
            if (!$hash) {
                $hash = new SearchHash;
                $hash->hash = md5(json_encode($request->markers));
                $hash->info = json_encode($request->markers);
                $hash->save();
            } else $hash->touch();
        }
        $querymarkers = $query
            ->select($select_values_array)
            ->orderBy($orderby, $orderbytype)
            ->limit(200)
            ->get();
        $listing_markers = [];
        if ($request->has('retrieve_markers') && $request->retrieve_markers == '1') {
            foreach ($querymarkers as $key => $row) {
                if ($row->image != '') {
                    $querymarkers[$key]->image = env('APP_IMG_URL') . '/storage/' . $row->image;
                }
                $querymarkers[$key]->location_name = '';
                $location = Location::where('id', $row->location_id)->first();
                if ($location) {
                    $querymarkers[$key]->location_name = $location->name;
                }
                $name_array = $row->name;
                $querymarkers[$key]->displayname = $name_array;
                $listing_marker  = [];
                $listing_marker['id'] = $row->id;
                $listing_marker['center'] = [$querymarkers[$key]->latitude, $querymarkers[$key]->longitude];
                $listing_marker['title'] = $querymarkers[$key]->displayname;
                $listing_marker['icon'] = "<i class='fa fa-home'></i>";
                $listing_marker['desc'] = $querymarkers[$key]->location_name;
                $listing_marker['price'] = "€" . number_format($row->price);
                $listing_marker['image'] = $querymarkers[$key]->image;
                $listing_marker['link'] = 'page/listing-details?index=' . $row->id;

                $listing_markers[]  = $listing_marker;
            }
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
                $images_array[] = env('APP_IMG_URL') . '/storage/' . $m->id . '/' . $m->file_name;
            }
            $query[$key]->images = $images_array;
            $query[$key]->price = number_format($row->price);

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
            if ($property_type) {
                $query[$key]->property_type = $property_type->name;
            }


            $query[$key]->location_name = '';
            $location = Location::where('id', $row->location_id)->first();
            if ($location) {
                $query[$key]->location_name = $location->name;
            }


            if ($row->image != '') {
                $query[$key]->image = env('APP_IMG_URL') . '/storage/' . $row->image;
            }

            $query[$key]->in_favoriteproperties = 0;
            if (isset($query[$key]->favorite_properties_listing_id) && $query[$key]->favorite_properties_listing_id == $query[$key]->id) {
                $query[$key]->in_favoriteproperties = 1;
            }
        }

        // Combine paginated data and additional data
        $responseData = [
            'items' => $query,
            'listing_markers' => $listing_markers,
        ];
        if (isset($hash)) $responseData['hash'] = $hash->hash; //intval($hash->id, 36);

        return response()->json($responseData);

        $products = $query;



        return response()->json($products);
    }
}
