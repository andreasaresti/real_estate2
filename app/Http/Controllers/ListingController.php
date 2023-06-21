<?php

namespace App\Http\Controllers;

use App\Models\FeatureListing;
use App\Models\Listing;
use App\Models\ListingTypeRelation;
use App\Models\NovaMenuMenus;
use App\Models\NovaMenuMenuItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\FacadesDB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ListingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function get(Request $request)
	{
		
		$result = array();
		$data = $request;

		// print_r($data);

		

		if($data['flag1']=="requestListingsList"){
			if($data['show_open_flage']){
				$sql = "SELECT	DISTINCT l.property_type_id, l.created_at, l.latitude, l.longitude, l.area_size, l.id, l.name, l.image ,l.price ,l.number_of_garages_or_parkingpaces, l.number_of_bedrooms ,l.number_of_bathrooms, ls.name as l_name FROM listings l JOIN locations ls ON ls.id = l.location_id  JOIN sales_request_listings srl ON srl.listing_id=l.id  WHERE srl.sales_request_id=".$data['requestIndex']." AND srl.status = 'open'";
			}else{
				$sql = "SELECT	DISTINCT srl.status, l.property_type_id, l.created_at, l.latitude, l.longitude, l.area_size, l.id, l.name, l.image ,l.price ,l.number_of_garages_or_parkingpaces, l.number_of_bedrooms ,l.number_of_bathrooms, ls.name as l_name FROM listings l JOIN locations ls ON ls.id = l.location_id  JOIN sales_request_listings srl ON srl.listing_id=l.id  WHERE srl.sales_request_id=".$data['requestIndex'];
			}
		}else{
			$location_data = explode(',', $data['location']);
			$listingType = explode(',', $data['listingType']);
			
			$sql = "SELECT	DISTINCT l.property_type_id, l.latitude, l.longitude,l.area_size, l.id, l.name, l.image ,l.price ,l.number_of_garages_or_parkingpaces, l.number_of_bedrooms ,l.number_of_bathrooms, ll.name as l_name FROM listings l JOIN property_types lt ON lt.id = l.property_type_id JOIN listing_listing_type ls ON ls.listing_id = l.id  JOIN locations ll ON ll.id = l.location_id ";
			if(isset($data['flag1']) && $data['flag1']=="requested"){
				$sql .= " JOIN sales_request_listings srl ON srl.listing_id=l.id ";
			}
			
			if(isset($data['flag1']) && is_array($data['feature']) && count($data['feature']) > 0 ){
				$sql .= " JOIN feature_listing fl ON l.id = fl.listing_id JOIN features ft ON ft.id =  fl.feature_id ";
			}
			if(isset($location_data) && is_array($location_data) && count($location_data) > 1){
				if(strpos($data['location'],"districts")>0){
					$sql .= " JOIN municipalities ml ON ml.id = ll.municipality_id JOIN districts dl ON dl.id = ml.district_id ";
				}else if(strpos($data['location'],"municipalities")>0){
					$sql .= " JOIN municipalities ml ON ml.id = ll.municipality_id ";
				}
			}
			$sql .= " WHERE published = 1 ";
			
			if(isset($location_data) && is_array($location_data) && count($location_data) > 1 && $location_data[0] != ''){
				
				$sql .= " AND (";
				for($i=0;$i<count($location_data);$i=$i+2){
					if($location_data[$i+1] == "districts"){
						$sql .= " dl.id = '".$location_data[$i]."' "; 
					}else if($location_data[$i+1] == "municipalities"){
						$sql .= " ml.id = '".$location_data[$i]."' "; 
					}else{
						$sql .= " ll.id = '".$location_data[$i]."' "; 
					}
					$sql .= "OR";
				}
				$sql = substr($sql,0,strlen($sql)-2);
				$sql .= ")";
			}
			
			if(isset($data['feature']) && is_array($data['feature']) && count($data['feature']) > 0 ){
				for($i=0;$i<count($data['feature']);$i++)
				{
					$sql .= " AND ft.id = ".$data['feature'][$i]." "; 
				}
			}
			if(isset($data['type']) && $data['type']>0){
				$sql .= " AND lt.id = '".$data['type']."' "; 
			}
			if(isset($listingType) && is_array($listingType) && count($listingType) > 0 && $listingType[0] !== "0" && $listingType[0] !== ""){
				// print_r($listingType);
				// return true;
				$sql .= " AND (";
				for($i=0;$i<count($listingType);$i++)
				{
					if($listingType[$i] != ''){
						if($i == 0 ){
						$sql .= " ls.listing_type_id =  '".$listingType[$i]."' "; 
					}else{
						$sql .= " OR ls.listing_type_id =  '".$listingType[$i]."' "; 
					}
					}
					
				}
				$sql .= " ) ";
			}
			
			if($data['flag1']=="requestList"){
				if($data['bedrooms']>0){
					$sql .= " AND l.number_of_bedrooms >= '".$data['bedrooms']."' "; 
				}
				if($data['bathrooms']>0){
					$sql .= " AND l.number_of_bathrooms >= '".$data['bathrooms']."' "; 
				}
			}else{
				if($data['bedrooms']>0){
					$sql .= " AND l.number_of_bedrooms = '".$data['bedrooms']."' "; 
				}
				if($data['bathrooms']>0){
					$sql .= " AND l.number_of_bathrooms = '".$data['bathrooms']."' "; 
				}
			}
			
			
			if(isset($data['string'])){
				$sql .= " AND ( l.description LIKE '%".$data['string']."%' OR l.name LIKE '%".$data['string']."%') ";
			}
			if(($data['bsize']!== 0 || $data['tsize']!== 1300)&& $data['bsize'] !== null){
				$sql .= " AND  l.area_size BETWEEN ".$data['bsize']." AND ". $data['tsize'] ." ";
			}
			if(($data['bprice']!== 0 || $data['tprice']!== 600000) && $data['tprice'] !== null){
				$sql .= " AND  l.price BETWEEN ".$data['bprice']." AND ". $data['tprice'] ." ";
			}
			if(isset($data['sortby'])){
				switch ($data['sortby']) {
					case 2:
						$sql .= " ORDER BY l.price ASC ";
						break;
					case 3:
						$sql .= " ORDER BY l.price DESC ";
						break;
					default:
						$sql .= " ORDER BY l.created_at DESC ";
						break;
				}
			}
		}
		
		$listings = DB::select($sql);
		$countlistings = count($listings);
		if(isset($data['page_index'])){
			$sql .= " LIMIT ".$data['paginSize']." OFFSET ".(string) (intval($data['paginSize'])) * (intval($data['page_index'])-1);
		}else{
			$sql .= " LIMIT ".$data['paginSize']." OFFSET 0";
		}
		$listings = DB::select($sql);
		$cur_date = date('Y-m-d H:i:s');
		for($i=0;$i<count($listings);$i++){
			if($data['flag1']=="requestListingsList" && !$data['show_open_flage']){
				array_push($result,["status" =>$listings[$i]->status,"countlistings" =>$countlistings, "property_type_id" =>$listings[$i]->property_type_id,"latitude" =>$listings[$i]->latitude,"longitude" =>$listings[$i]->longitude,"area_size" =>$listings[$i]->area_size, "id"=>$listings[$i]->id, "name"=> json_decode($listings[$i]->name), "image"=>  $listings[$i]->image ,"price"=> $listings[$i]->price, "bedrooms"=>$listings[$i]->number_of_bedrooms, "bathrooms"=>$listings[$i]->number_of_bathrooms , "address"=>json_decode($listings[$i]->l_name), "garages"=>$listings[$i]->number_of_garages_or_parkingpaces]);
			}else{
				array_push($result,["countlistings" =>$countlistings, "property_type_id" =>$listings[$i]->property_type_id,"latitude" =>$listings[$i]->latitude,"longitude" =>$listings[$i]->longitude,"area_size" =>$listings[$i]->area_size, "id"=>$listings[$i]->id, "name"=> json_decode($listings[$i]->name), "image"=>  $listings[$i]->image ,"price"=> $listings[$i]->price, "bedrooms"=>$listings[$i]->number_of_bedrooms, "bathrooms"=>$listings[$i]->number_of_bathrooms , "address"=>json_decode($listings[$i]->l_name), "garages"=>$listings[$i]->number_of_garages_or_parkingpaces]);
			}
		}
		session_start();
		$favoritelist = array();
		$favorites = DB::select('SELECT * FROM favorite_properties where customer_id='.$_SESSION["user_id"]);
		for($i=0;$i<count($favorites);$i++){
			array_push($favoritelist, $favorites[$i]->listing_id);
		}
		$reqestListings = array();
		if($data['flag1'] == "requestList"){
			$result_reqestListings = DB::select('SELECT * FROM sales_request_listings where sales_request_id='.$data['requestIndex']);
			for($i=0; $i<count($result_reqestListings); $i++){
				array_push($reqestListings, $result_reqestListings[$i]->listing_id);
			}
		}

		return response()->json(["list"=>$result,"favoritelist"=>$favoritelist,"reqestListings"=>$reqestListings]);
	}
	public function get_single_list_sales_people($index)
	{
		session_start():
		$result = array();
		if($index > 0){
			$results = DB::select('SELECT DISTINCT  sp.id AS id, cs.name AS name, cs.address AS address,  cs.image AS image, cs.mobile AS mobile, cs.phone AS phone, cs.email AS email FROM listings ls JOIN customers cs ON cs.id = ls.owner_id JOIN sales_people sp ON sp.customer_id=cs.id where ls.id="'.$index.'"');
			for($i=0;$i<count($results);$i++){	
				return ["id" =>$results[$i]->id,"name" =>$results[$i]->name,"address" =>$results[$i]->address,"image" =>$results[$i]->image,"mobile" =>$results[$i]->mobile,"phone" =>$results[$i]->phone,"email" =>$results[$i]->email];
			}
		}
		return ["id" =>"","name" =>"","image" =>"","mobile" =>"","phone" =>"","email" =>"","address" =>""];
	}
	public function cur_get($index)
	{
		session_start():
		$result = array();
		$image = array();
		$images = DB::select('SELECT * from media where model_id = '.$index.' and model_type like "%Listing%" order by "id" desc');
		for($i=0;$i<count($images);$i++){			
			if(count($images)>0){
				array_push($image,[$images[$i]->id."/".$images[$i]->file_name]);
			}
		}
		$listing = array();
		$listings = DB::select('SELECT * from listings where id = ? order by "id" desc',[$index]);
		for($i=0;$i<count($listings);$i++){	
			if(count($images)>0){
				array_push($listing,[$listings[$i]->price,$listings[$i]->number_of_bedrooms,$listings[$i]->number_of_bathrooms,$listings[$i]->address,json_decode($listings[$i]->description),json_decode($listings[$i]->name),$listings[$i]->ext_code,$images[0]->id."/".$images[0]->file_name]);
			}else{
				array_push($listing,[$listings[$i]->price,$listings[$i]->number_of_bedrooms,$listings[$i]->number_of_bathrooms,$listings[$i]->address,json_decode($listings[$i]->description),json_decode($listings[$i]->name),$listings[$i]->ext_code,""]);
			}
		}
		$feature = array();
		$features = DB::select('SELECT l.name, l.image FROM features l JOIN listings lt ON l.ext_code=lt.ext_code WHERE lt.id=?',[$index]);
		for($i=0;$i<count($features);$i++){
			array_push($feature,[json_decode($features[$i]->name),$features[$i]->image]);
		}
		array_push($result,["image"=>$image, "listing"=>$listing,"features"=>$feature]);
		return response()->json($result);
	}
	public function add(Request $request)//: JsonResponse
    {
		session_start():
		
		$data = $request;
		$cur_date = date('Y-m-d H:i:s');
		$newfile = null;
		if($data['main_image'] != ''){
			$newfile = date('Y-m-d').rand(1,99999999999).".png";
			file_put_contents(public_path('storage').'/'.$newfile, file_get_contents($data['main_image']));
		}
		
		$location_array = explode(',', $data['location']);
		$location_id = null;
		if(isset($location_array[1]) && is_numeric($location_array[1])){
			$location_id = $location_array[1];
		}

		$listing = Listing::create(array(
						'name' =>  array("en" => $data['title']), 
						'description' => array("en" => $data['description']),
						'price'=>$data['price'],
						'number_of_bedrooms'=>$data['bedrooms'],
						'number_of_bathrooms'=>$data['bathrooms'],
						'number_of_garages_or_parkingpaces'=>$data['garagesParkingpaces'],
						'year_built' => $data["year"],
						'address'=>$data['address'],
						'property_type_id'=>$data['type'],
						'status_id'=>$data['status'],
						'area_size'=>$data['area'],
						'latitude'=>$data['latitude'],
						'longitude'=>$data['longitude'],
						'delivery_time_id' => $data['deliveryTime'],
						'location_id' => $location_id,
						'owner_id' => $_SESSION["user_id"],
						'published'=>'0',
						'image' => $newfile
					));
		// echo 'id: '.$listing->id.'<br>';

		if($data['listingType'] != ''){
			$listing_type = DB::table('listing_listing_type')->insert(array(
				'listing_id' =>  $listing->id, 
				'listing_type_id' => $data['listingType']
			));
		}

		for($i=0;$i<count($data['feature']);$i++)
		{
			$feature_listing = DB::table('feature_listing')->insert([
				'listing_id' =>  $listing->id, 
				'feature_id' => $data['feature'][$i]
			]);
		}
		
		for($i = 0; $i < count($data['images']);$i++)
		{
			
			$image =$data['images'][$i];
			$image_parts = explode(";base64,", $image);
			$image_type_aux = explode("image/", $image_parts[0]);
			$image_type = $image_type_aux[1];
			$file = base64_decode($image_parts[1]);
			$preName = $i;
			$safeName = $preName.'.'.$image_type;

			$media_listing = Media::create(array(
											'model_type' =>  'App\Models\Listing', 
											'model_id' => $listing->id,
											'uuid' => rand(1,99999999999),
											'name' => 'temptempname',
											'size' => 520,
											'file_name' => 'temptempname',
											'collection_name' => 'images',
											'mime_type' => 'image/'.$image_type,
											'disk' => 'public',
											'conversions_disk' => 'public',
											'responsive_images' => array(),
											'manipulations' => array(),
											'custom_properties' => array(),
											'order_column' => $i + 1,
											'generated_conversions' => array('large-size' => true,"medium-size" => true, "thumb" => true)
										));
			echo 'media_listing: '.$media_listing->id.'<br>';
			$imageId =  $media_listing->id;
			
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
			
			Media::where('id', $media_listing->id)->update(array(
																'name' => $preName,
																'file_name' => $safeName
															));
		}
		

		return "ok";
    }
	public function get_param()//: JsonResponse
    {
		session_start():
		$result = array();
		$locations = array();
		$result_locations = DB::select('SELECT * FROM locations');
		for($i=0;$i<count($result_locations);$i++){
			array_push($locations,["id"=>$result_locations[$i]->id, "name"=>json_decode($result_locations[$i]->name)]);
		}
		$statuses = array();
		$result_statuses = DB::select('SELECT * FROM statuses');
		for($i=0;$i<count($result_statuses);$i++){
			array_push($statuses,["id"=>$result_statuses[$i]->id, "name"=>json_decode($result_statuses[$i]->name)]);
		}
		$features = array();
		$result_features = DB::select('SELECT * FROM features');
		for($i=0;$i<count($result_features);$i++){
			array_push($features,["id"=>$result_features[$i]->id, "name"=>json_decode($result_features[$i]->name)]);
		}
		$types = array();
		$result_types = DB::select('SELECT * FROM property_types');
		for($i=0;$i<count($result_types);$i++){
			array_push($types ,["id"=>$result_types[$i]->id, "name"=>json_decode($result_types[$i]->name)]);
		}
		$delivery_times = array();
		$result_delivery_times = DB::select('SELECT * FROM delivery_times');
		for($i=0;$i<count($result_delivery_times);$i++){
			array_push($delivery_times,["id"=>$result_delivery_times[$i]->id, "name"=>json_decode($result_delivery_times[$i]->name)]);
		}
		array_push($result,["locations"=>$locations,"statuses"=>$statuses,"features"=>$features,"types"=>$types,"delivery_times"=>$delivery_times]);
		return response()->json($result);
    }
	public function add_favorit($index)
	{
		session_start():
        if(!DB::table('favorite_properties')->where('customer_id', $_SESSION["user_id"])->where('listing_id', $index)->exists()){
		    $temp = DB::select('INSERT INTO favorite_properties( customer_id, listing_id) 
                VALUES ('.$_SESSION["user_id"].','.$index.')');
            return "ok";
        }else{
			DB::table('favorite_properties')->where('customer_id', $_SESSION["user_id"])->where('listing_id', $index)->delete();
            return "fail";
        }
	}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $Menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $Menu)
    {
        //return view('Menu.view', ['Menu' => $Menu]);
        // return $Menu;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $Menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $Menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $Menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $Menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $Menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $Menu)
    {
        //
    }
}
