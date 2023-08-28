<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use App\Models\District;
use App\Models\Feature;
use App\Models\Listing;
use App\Models\ListingType;
use App\Models\Location;
use App\Models\Municipality;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class webListingsAddListingsController extends Controller
{
    public function import_listings(Request $request)
    {
        $listings_array = DB::table('import_listings')
                            ->select("id","developer")
                            ->where('developer', 'REGEXP', '[0-9]+')
                            ->get();
        foreach($listings_array as $listing){
            $string = $listing->developer;

            $pattern = '/[0-9 ]+/';
            preg_match_all($pattern, $string, $matches);

            $numericSubstrings = $matches[0];

            $developer_phone = '';

            foreach($numericSubstrings as $numeric_string){
                $numeric_string = str_replace(' ', '', $numeric_string);
                if(strlen($numeric_string) >= 8 && strlen($numeric_string) > strlen($developer_phone)){
                    $developer_phone = $numeric_string;
                }
            }

            DB::table('import_listings')
                            ->where("id",$listing->id)
                            ->update(['developer_phone' => $developer_phone]);
        }

        // $affectedRows = DB::insert("INSERT IGNORE INTO customers(ext_code, type, name, email) 
        // SELECT developer_phone, 'individual', developer, NULL FROM import_listings t1 WHERE developer_phone IS NOT NULL AND developer_phone <> '' GROUP BY developer_phone");


        // $affectedRows = DB::insert("INSERT IGNORE INTO customers(ext_code, type, name, email) 
        SELECT developer, 'individual', developer, NULL FROM import_listings t1 WHERE developer_phone IS NULL OR developer_phone = '' GROUP BY developer");

        return true;
        
        $affectedRows = DB::update("UPDATE import_listings SET municipality = district WHERE municipality = ''");
        $affectedRows = DB::update("UPDATE import_listings t1 SET t1.location = t1.municipality WHERE t1.location = ''");
        $affectedRows = DB::update("UPDATE import_listings t1 SET t1.district = 'Limassol District' WHERE t1.district IN ('Agios Ioannis', 'Agios Sylas', 'Arakapas', 'Asomatos Lemesou', 'Avdimou', 'Ayia Fyla', 'Ayios Spyridonas', 'Ayios Tychonas', 'Ayios Tychonas Tourist Area', 'Kolossi', 'Ekali', 'Episkopi Lemesou', 'Erimi', 'Fasoula Lemesou')");
        $affectedRows = DB::update("UPDATE import_listings t1 SET t1.district = 'Limassol District' WHERE t1.district IN ('Limassol - Agia Zoni', 'Limassol - Agios Nikolaos', 'Limassol - Kapsalos', 'Limassol - Katholiki', 'Limassol - Neapolis', 'Limassol - Petrou Kai Pavlou', 'Limassol City Center', 'Limassol District','Limassol Marina')");
        $affectedRows = DB::update("UPDATE import_listings t1 SET t1.district = 'Limassol District' WHERE t1.district IN ('Foinikaria','Mathikoloni','Mesa Geitonia','Monagrouli','Moni','Mouttagiaka','Omonia')");
        $affectedRows = DB::update("UPDATE import_listings t1 SET t1.district = 'Limassol District' WHERE t1.district IN ('Paramytha','Parekklisia','Pelendri','Palodia','Panthea','Agios Athanasios','Agios Amvrosios Lemesou')");
        $affectedRows = DB::update("UPDATE import_listings t1 SET t1.district = 'Limassol District' WHERE t1.district IN ('Polemidia','Pyrgos Lemesou','Pyrgos Lemesou Tourist Area','Souni','Trachoni')");
        $affectedRows = DB::update("UPDATE import_listings t1 SET t1.district = 'Limassol District' WHERE t1.district IN ('Agios Georgios','Apostolos Andreas','Tsirion','Yermasoyia','Yermasoyia Tourist Area','Ypsonas','Zakaki')");
        $affectedRows = DB::update("UPDATE import_listings t1 SET t1.district = 'Larnaka District' WHERE t1.district IN ('Vergina','Kiti','Ayios Theodoros','Larnaca District','Larnaka - Agios Nikolaos','Larnaka - Faneromenis','Larnaka - Nea Marina','Livadia Larnakas','Vergina', 'Vergina')");
        $affectedRows = DB::update("UPDATE import_listings t1 SET t1.district = 'Nicosia District' WHERE t1.district IN ('Nicosia - Agioi Omologites','Nicosia - Kaimakli','Aglantzia')");
        $affectedRows = DB::update("UPDATE import_listings t1 SET t1.district = 'Paphos District' WHERE t1.district IN ('Paphos City Center','Tremithousa','Tsada' )");
        $affectedRows = DB::update("UPDATE import_listings t1 SET t1.district = 'Famagusta District' WHERE t1.district IN ('Protaras')");
        
        $listings_array = DB::table('import_listings')
                            ->select('*')
                            ->where('imported', 0)
                            ->get();
        foreach($listings_array as $listing){
                
                $location_id = null;
                $location = Location::where('ext_code', $listing->location)->first();
                if($location){
                    $location_id = $location->id;
                }
                $property_type_id = null;
                $property_type = PropertyType::where('ext_code', $listing->property_status)->first();
                if($property_type){
                    $property_type_id = $property_type->id;
                }

                $garage = null;
                $size = null;
                $bathrooms = null;
                if($listing->garage != ''){
                    $garage = $listing->garage;
                }
                if($listing->size != ''){
                    $size = $listing->size;
                }
                if($listing->bathrooms != ''){
                    $bathrooms = $listing->bathrooms;
                }
                
                DB::beginTransaction();
                try {
                    $data = [
                        'id' => $listing->property_id,
                        'ext_code' => $listing->property_id,
                        'name' => $listing->title,
                        'description' => $listing->content,
                        'price' => $listing->price,
                        'area_size' => $size,
                        'number_of_bathrooms' => $bathrooms,
                        'published' => 1,
                        'number_of_garages_or_parkingpaces' => $garage,
                        'address' => $listing->address,
                        'location_id' => $location_id,
                        'property_type_id' => $property_type_id,
                        'latitude' => $listing->coordinate1,
                        'longitude' => $listing->coordinate2
                    ];
                    Listing::create($data);
                    Listing::where('ext_code', $listing->property_id)->update(['id' => $listing->property_id]);
                    DB::table('import_listings')->where('id', $listing->id)->update(['imported' => 1]);

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                }
        }

        $affectedRows = DB::update("INSERT IGNORE INTO feature_listing(listing_id, feature_id) 
        SELECT t1.property_id, t2.id FROM import_features t1 INNER JOIN features t2 ON t1.name=t2.ext_code");

        $affectedRows = DB::update("INSERT IGNORE INTO listing_listing_type(listing_id, listing_type_id) 
        SELECT t1.property_id, t2.id FROM import_property_types t1 INNER JOIN listing_types t2 ON t1.name=t2.ext_code");

        $affectedRows = DB::update("UPDATE import_property_images t1 
        INNER JOIN (SELECT id FROM import_property_images GROUP BY property_id) t2 ON t1.id=t2.id 
        SET t1.is_main=1");
        


        echo 'added listings<br>';

        return true;
    }
    
}












