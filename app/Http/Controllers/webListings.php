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
                $images = "|".env('APP_IMG_URL') . '/storage/' . $row->image;
            }

            foreach ($media as $m) {
                $images .= "|".env('APP_IMG_URL') . '/storage/' . $m->id . '/' . $m->file_name;
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

            
            array_push($data,$posts);
        }
        $products['post'] = $data;

        return response()->xml($products);
    }
    
    
}