<?php

namespace App\Http\Controllers\Listings;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\Location;
use App\Models\Feature;
use App\Models\FloorPlan;
use App\Models\ListingType;
use App\Models\PropertyType;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MapActiveListingsController extends Controller
{
    public function get_MapActiveListings(Request $request)
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
