<?php

namespace App\Http\Controllers\Listings;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\FloorPlan;
use App\Models\Listing;
use App\Models\ListingType;
use App\Models\Location;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GetSimilarListingsController extends Controller
{
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
                $images_array[] = env('APP_IMG_URL') . '/storage/' . $m->id . '/' . $m->file_name;
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
                $query[$key]->image = env('APP_IMG_URL') . '/storage/' . $row->image;
            }

            $query[$key]->in_favoriteproperties = 0;
            if (isset($query[$key]->favorite_properties_listing_id) && $query[$key]->favorite_properties_listing_id == $query[$key]->id) {
                $query[$key]->in_favoriteproperties = 1;
            }
        }
        $products = $query;

        return response()->json($products);
    }
}
