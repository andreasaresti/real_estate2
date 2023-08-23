<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class webListingsRetrieveController extends Controller
{
    public function load_xml(Request $request)
    {
        $remote_url = 'https://sabbiancoproperties.com/?feed=estate_rss_v2&limit=' . $request->records_per_page . '&offset=' . $request->page;
        $xml=simplexml_load_file($remote_url) or die("Error: Cannot create object");
        foreach($xml->post as $row)
        {
            $district = '';
            $municipality = '';
            $location = '';
            // echo (string)$row->PropertyCity.'<br>';
            foreach(explode('>', (string)$row->PropertyCity) as $key=>$listing_location){
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
            }
        }
        return response()->json([
            'message' => 'Import Completed',
        ], 200);
    }
}
