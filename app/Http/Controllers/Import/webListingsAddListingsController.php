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
                            ->select('*')
                            ->where('imported', 0)
                            ->get();

        foreach($listings_array as $listing){
            if($listing->property_number == ''){
                $property_number = (int)str_replace('est-', "", $listing->property_id);
                DB::table('import_listings')->where('id', $listing->id)->update(['property_number' => $property_number]);
            }
            if($listing->property_number != ''){
                $developer_id = null;
                $developer = Developer::where('ext_code', $listing->developer)->first();
                if($developer){
                    $developer_id = $developer->id;
                }
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
                        'id' => $listing->property_number,
                        'ext_code' => $listing->property_number,
                        'name' => $listing->title,
                        'description' => $listing->content,
                        'price' => $listing->price,
                        'area_size' => $size,
                        'number_of_bathrooms' => $bathrooms,
                        'published' => 1,
                        'number_of_garages_or_parkingpaces' => $garage,
                        'address' => $listing->address,
                        'developer_id' => $listing->address,
                        'developer_id' => $developer_id,
                        'location_id' => $location_id,
                        'property_type_id' => $property_type_id,
                        'latitude' => $listing->coordinate1,
                        'longitude' => $listing->coordinate2
                    ];
                    Listing::create($data);
                    Listing::where('ext_code', $listing->property_number)->update(['id' => $listing->property_number]);
                    $features_array = DB::table('import_listings')
                                ->join('import_features', 'import_features.property_id', '=', 'import_listings.property_id')
                                ->join('features', 'import_features.name', '=', 'features.ext_code')
                                ->select('features.id')
                                ->where('import_listings.property_number', $listing->property_number)
                                ->get();
                    foreach($features_array as $feature){
                        $feature_query = DB::table('feature_listing')->insert(['listing_id'=>$listing->property_number,'feature_id'=>$feature->id]);
                    }
                    $listing_types_array = DB::table('import_listings')
                                ->join('import_property_types', 'import_property_types.property_id', '=', 'import_listings.property_id')
                                ->join('listing_types', 'import_property_types.name', '=', 'listing_types.ext_code')
                                ->select('listing_types.id')
                                ->where('import_listings.property_number', $listing->property_number)
                                ->get();
                    foreach($listing_types_array as $listing_type){
                        $listing_type_query = DB::table('listing_listing_type')->insert(['listing_id'=>$listing->property_number,'listing_type_id'=>$listing_type->id]);
                    }
                    $feature_query = DB::table('import_listings')->where('property_id', $listing->property_id)->update(['imported'=>1]);
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                }
                
                

                
            }
            
        }

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
        // $affectedRows = DB::insert("INSERT IGNORE INTO UPDATE import_listings t1 SET t1.district = 'Famagusta District' WHERE t1.district IN ('Protaras')");
        // $affectedRows = DB::update("UPDATE import_listings t1 SET t1.district = 'Limassol District' WHERE t1.district IN ()");

        // DB::table('import_listings')->where('id', $postId)->update(['title' => $newTitle]);->insert($property_features);
        echo 'we are here<br>';

        // DB::table('import_listings')->insert($property_features);
        // $districts_array =DB::select("SELECT * FROM import_listings GROUP BY district");

        $districts_array = DB::table('import_listings')
                            ->select('district')
                            ->groupBy('district')
                            ->get();
        foreach($districts_array as $row){
            if($row->district != ''){
                $import_features_query = DB::table('import_listings')->where('district', $row->district)->first();
                if($import_features_query){
                    DB::beginTransaction();

                    try {
                        $data = ['ext_code'=>$row->district,'name'=>$row->district,'country'=>'CY', 'latitude' => $import_features_query->coordinate1, 'longitude' => $import_features_query->coordinate2];
                        District::create($data);
                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollback();
                    }
                }  
            }
        }
        $municipality_array = DB::table('import_listings')
                            ->select('municipality')
                            ->groupBy('municipality')
                            ->get();
        foreach($municipality_array as $row){
            if($row->municipality != ''){
                $import_query = DB::table('import_listings')->where('municipality', $row->municipality)->first();
                $district_query = DB::table('districts')->where('ext_code', $import_query->district)->first();
                if($import_features_query){
                    DB::beginTransaction();

                    try {
                        $data = ['ext_code'=>$row->municipality,'name'=>$row->municipality,'district_id'=>$district_query->id, 'latitude' => $import_query->coordinate1, 'longitude' => $import_query->coordinate2];
                        Municipality::create($data);
                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollback();
                    }
                }  
            }
        }
        $location_array = DB::table('import_listings')
                            ->select('location')
                            ->groupBy('location')
                            ->get();
        foreach($location_array as $row){
            
            if($row->location != ''){
                // echo 'here1<br>';
                $import_query = DB::table('import_listings')->where('location', $row->location)->first();
                $location_query = DB::table('municipalities')->where('ext_code', $import_query->municipality)->first();
                if($import_query){
                    DB::beginTransaction();

                    try {
                        $data = ['ext_code'=>$row->location,'name'=>$row->location,'municipality_id'=>$location_query->id, 'latitude' => $import_query->coordinate1, 'longitude' => $import_query->coordinate2];
                        Location::create($data);
                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollback();
                    }
                }  
            }
        }

        $features_array = DB::table('import_features')
                            ->select('name')
                            ->groupBy('name')
                            ->get();
        foreach($features_array as $row){
            if($row->name != ''){
                DB::beginTransaction();

                try {
                    $data = ['ext_code'=>$row->name,'name'=>$row->name];
                    Feature::create($data);
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                }
            }            
        }

        $property_types_array = DB::table('import_property_types')
                            ->select('name')
                            ->groupBy('name')
                            ->get();
        foreach($property_types_array as $row){
            if($row->name != ''){
                DB::beginTransaction();
                try {
                    $data = ['ext_code'=>$row->name,'name'=>$row->name];
                    ListingType::create($data);
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                }
            }            
        }

        $property_types_array = DB::table('import_listings')
                            ->select('developer')
                            ->groupBy('developer')
                            ->get();
        foreach($property_types_array as $row){
            if($row->developer != ''){
                DB::beginTransaction();
                try {
                    $data = ['ext_code'=>$row->developer,'name'=>$row->developer];
                    Developer::create($data);
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                }
            }            
        }
        

        // echo '<pre>';
        // print_r($listings_array);
        // echo '</pre>';
        
        return true;
    }
    
}












