<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class webListingsAddListings12 extends Controller
{
    public function add_listings(Request $request)
    {
        $import_listings = DB::table('import_listings')->insert($listing_array);

        return true;
        echo 'we add listings in database<br>';
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
                                ->update(["image"=>'/'.$imageId.'/conversions'.'/'.$preName.'-thumb.jpg']);
                }
            }
            */
        }
        return response()->json([
            'message' => 'Import Completed',
        ], 200);
    }
}