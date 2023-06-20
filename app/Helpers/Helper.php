<?php
namespace App\Helpers;

use App\Models\Customer;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Helper {
	
	public static function get_request_list($u_id, $flag)
	{
		$result = array();
		if($flag == "open"){
			$sql = "SELECT	
						sr.id as id, 
						sr.name as name, 
						sr.date as date, 
						sr.description as description 
					FROM sales_requests sr 
					JOIN sales_people sp ON sp.id=sr.sales_people_id  
					WHERE sr.sales_people_id = '".$u_id."' AND  accepted_status = 'yes' and sr.active = 1";
			$sql .= " AND status = 'open'" ;
			$listings = DB::select($sql);
			if(count($listings)>0){			
				$result = $listings;
			}
		}
		if($flag == "not_approved"){
			$sql = "SELECT	
							sr.id as id, 
							sr.name as name, 
							sr.date as date, 
							sr.description as description  
						FROM sales_requests sr 
						JOIN sales_people sp ON sp.id=sr.sales_people_id  
						WHERE sr.sales_people_id = '".$u_id."' AND  accepted_status = 'no' and sr.active = 1";
			$sql .= " AND accepted_status <> 'open'" ;
			$listings = DB::select($sql);
			if(count($listings)>0){			
				$result = $listings;
			}
		}

		return $result;
	}
	public static function get_listing_count($data)
	{
		$cur_date = date('Y-m-d H:i:s');
		$result = array();
		$sql = "SELECT	DISTINCT l.created_at, l.latitude, l.longitude, l.area_size, l.id, l.name, l.image ,l.price ,l.number_of_garages_or_parkingpaces, l.number_of_bedrooms ,l.number_of_bathrooms, l.address FROM listings l WHERE published = 1 ";
		if($data == "requested"){
			$sql = "SELECT	DISTINCT l.created_at, l.latitude, l.longitude, l.area_size, l.id, l.name, l.image ,l.price ,l.number_of_garages_or_parkingpaces, l.number_of_bedrooms ,l.number_of_bathrooms, l.address FROM listings l JOIN sales_request_listings srl ON srl.listing_id=l.id  WHERE published = 1 ";
		}
		$listings = DB::select($sql);
		return count($listings);
	}
    public static function search_listing($data)
	{
		$cur_date = date('Y-m-d H:i:s');
		$result = array();
		$sql = "SELECT	DISTINCT l.property_type_id, l.created_at, l.latitude, l.longitude, l.area_size, l.id, l.name, l.image ,l.price ,l.number_of_garages_or_parkingpaces, l.number_of_bedrooms ,l.number_of_bathrooms, ls.name as l_name FROM listings l JOIN locations ls ON ls.id = l.location_id  WHERE published = 1 ";
		if($data == "requested"){
			$sql = "SELECT	DISTINCT l.property_type_id, l.created_at, l.latitude, l.longitude, l.area_size, l.id, l.name, l.image ,l.price ,l.number_of_garages_or_parkingpaces, l.number_of_bedrooms ,l.number_of_bathrooms, ls.name as l_name FROM listings l JOIN locations ls ON ls.id = l.location_id  JOIN sales_request_listings srl ON srl.listing_id=l.id  WHERE published = 1 ";
		}
		if(isset($data['page_index'])){
			$sql .= "ORDER BY id DESC LIMIT 30 OFFSET ".(string) 30 * intval($data['page_index']);
		}else{
			$sql .= "ORDER BY id DESC LIMIT 30 OFFSET 0";
		}
		$listings = DB::select($sql);
		for($i=0;$i<count($listings);$i++){			
			array_push($result,["property_type_id" =>$listings[$i]->property_type_id,"latitude" =>$listings[$i]->latitude,"longitude" =>$listings[$i]->longitude,"area_size" =>$listings[$i]->area_size,"id"=>$listings[$i]->id, "name"=> json_decode($listings[$i]->name), "image"=>  $listings[$i]->image ,"price"=> $listings[$i]->price, "bedrooms"=>$listings[$i]->number_of_bedrooms, "bathrooms"=>$listings[$i]->number_of_bathrooms , "address"=>json_decode($listings[$i]->l_name), "garages"=>$listings[$i]->number_of_garages_or_parkingpaces]);
		}
		if(count($result) == 0){
			array_push($result,["property_type_id"=>"", "latitude" =>"","longitude" =>"","area_size" =>"","id"=>"", "name"=> json_decode('{"en":""}'), "image"=>"" ,"price"=> "", "bedrooms"=>"", "bathrooms"=>"" , "address"=>json_decode('{"en":""}'), "garages"=>""]);
		}
		return $result;
	}
	public static function get_property_types()//: JsonResponse
    {
		$types = array();
		$result_types = DB::select('SELECT * FROM property_types');
		for($i=0;$i<count($result_types);$i++){
			array_push($types ,["id"=>$result_types[$i]->id, "name"=>json_decode($result_types[$i]->name)]);
		}
		if(count($types) == 0){
			array_push($types,["id"=> "","name"=>json_decode('{"en":""}')]);
		}
		return $types;
    }
	public static function get_listing_types()//: JsonResponse
    {
		$types = array();
		$result_types = DB::select('SELECT * FROM listing_types');
		for($i=0;$i<count($result_types);$i++){
			array_push($types ,["id"=>$result_types[$i]->id, "name"=>json_decode($result_types[$i]->name)]);
		}
		if(count($types) == 0){
			array_push($types,["id"=> "","name"=>json_decode('{"en":""}')]);
		}
		return $types;
    }
	public static function get_features()//: JsonResponse
    {
		$features = array();
		$result_features = DB::select('SELECT * FROM features');
		for($i=0;$i<count($result_features);$i++){
			array_push($features,["id"=>$result_features[$i]->id, "name"=>json_decode($result_features[$i]->name)]);
		}
		if(count($features) == 0){
			array_push($features,["id"=> "","name"=>json_decode('{"en":""}')]);
		}
		return $features;
    }
	public static function get_locations()//: JsonResponse
    {
		$districts = array();
		$result_districts = DB::select('SELECT * FROM districts');
		for($i=0;$i<count($result_districts);$i++){
			$result_municipalities = DB::select('SELECT * FROM municipalities where district_id ="'.$result_districts[$i]->id.'"');
			$municipalities = array();
			for($j=0;$j<count($result_municipalities);$j++){
				$result_locations = DB::select('SELECT * FROM locations where municipality_id ="'.$result_municipalities[$j]->id.'"');
				$locations = array();
				for($k=0;$k<count($result_locations);$k++){
					array_push($locations,["name"=>json_decode($result_locations[$k]->name),"id"=>$result_locations[$k]->id]);
				}
				array_push($municipalities,["id"=>$result_municipalities[$j]->id,"name"=>json_decode($result_municipalities[$j]->name),"locations"=>$locations]);
			}
			array_push($districts,["id"=>$result_districts[$i]->id,"name"=>json_decode($result_districts[$i]->name),"municipality"=>$municipalities]);
		}
		if(count($districts) == 0){
			array_push($districts,["id"=>"","municipality"=> [],"name"=>json_decode('{"en":""}')]);
		}
		return $districts;
    }
	public static function get_customers()//: JsonResponse
    {
		$customers = array();
		$result_customers = DB::select('SELECT * FROM customers');
		for($i=0;$i<count($result_customers);$i++){
			array_push($customers,["id"=>$result_customers[$i]->id, "name"=>$result_customers[$i]->name]);
		}
		if(count($customers) == 0){
			array_push($customers,["id"=> "","name"=>""]);
		}
		return $customers;
    }
	public static function get_delivery_times()//: JsonResponse
    {
		$delivery_times = array();
		$result_delivery_times = DB::select('SELECT * FROM delivery_times');
		for($i=0;$i<count($result_delivery_times);$i++){
			array_push($delivery_times,["id"=>$result_delivery_times[$i]->id, "name"=>json_decode($result_delivery_times[$i]->name)]);
		}
		if(count($delivery_times) == 0){
			array_push($delivery_times,["id"=> "","name"=>json_decode('{"en":""}')]);
		}
		return $delivery_times;
    }
	public static function get_statuses()//: JsonResponse
    {
		$statuses = array();
		$result_statuses = DB::select('SELECT * FROM statuses');
		for($i=0;$i<count($result_statuses);$i++){
			array_push($statuses,["id"=>$result_statuses[$i]->id, "name"=>json_decode($result_statuses[$i]->name)]);
		}
		if(count($statuses) == 0){
			array_push($statuses,["id"=> "","name"=>json_decode('{"en":""}')]);
		}
		return $statuses;
    }
	public static function get_single_list($index)
	{
		$result = array();
		$image = array();
		$listing = array();
		$varient = array();
		$feature = array();
		if($index > 0){
			$images = DB::select('SELECT * from media where model_id = '.$index.' and model_type like "%Listing%" order by "id" desc');
			for($i=0;$i<count($images);$i++){			
				if(count($images)>0){
					array_push($image,["file_name" => $images[$i]->id."/".$images[$i]->file_name]);
				}
			}
			$listings = DB::select('SELECT l.description, l.year_built, l.created_at, l.latitude, l.longitude, l.area_size, l.id, l.name, l.image ,l.price ,l.number_of_garages_or_parkingpaces, l.number_of_bedrooms ,l.number_of_bathrooms, ls.name as l_name FROM listings l JOIN locations ls ON ls.id = l.location_id where l.id = ? ',[$index]);
			for($i=0;$i<count($listings);$i++){	
				array_push($listing,["latitude" =>$listings[$i]->latitude,"longitude" =>$listings[$i]->longitude,"area_size" =>$listings[$i]->area_size,"year_built" =>$listings[$i]->year_built,"price" =>$listings[$i]->price,"number_of_garages_or_parkingpaces" =>$listings[$i]->number_of_garages_or_parkingpaces,"number_of_bedrooms" =>$listings[$i]->number_of_bedrooms,"number_of_bathrooms" =>$listings[$i]->number_of_bathrooms,"address" =>json_decode($listings[$i]->l_name),"description" =>json_decode($listings[$i]->description),"name" =>json_decode($listings[$i]->name),"image_name" =>$listings[$i]->image]);
			}
			
			$varients = DB::select('SELECT  st.name as status, pt.name as type  FROM listings l JOIN property_types pt ON pt.id = l.property_type_id JOIN statuses st ON st.id=l.status_id WHERE l.id = ? ORDER BY "id" DESC',[$index]);
			for($i=0;$i<count($varients);$i++){	
				array_push($varient,["status" => json_decode($varients[$i]->status),"type" => json_decode($varients[$i]->type)]);
			}
			
			$features = DB::select('SELECT DISTINCT f.image as image, f.name as name  FROM listings l JOIN feature_listing fl ON fl.listing_id = l.id JOIN features f ON f.id=fl.feature_id WHERE l.id = ? ORDER BY "id" DESC',[$index]);
		
			for($i=0;$i<count($features);$i++){	
				array_push($feature,["name" => json_decode($features[$i]->name),"image" => $features[$i]->image]);
			}
		}
		if(count($image) == 0){
			array_push($image,["file_name" => ""]);
		}
		if(count($feature) == 0){
			array_push($feature,["name" => json_decode('{"en":""}'),"image" => ""]);
		}
		if(count($varient) == 0){
			array_push($varient,["status" => json_decode('{"en":""}'),"type" => json_decode('{"en":""}')]);
		}
		if(count($listing) == 0){
			array_push($listing,["latitude" =>"","longitude" =>"","area_size" =>"","year_built" =>"","price" =>"", "number_of_garages_or_parkingpaces" =>"","number_of_bedrooms" =>"","number_of_bathrooms" =>"","address" =>json_decode('{"en":""}'),"description" =>json_decode('{"en":""}'),"name" =>json_decode('{"en":""}'),"image_name" =>null]);
		}
		array_push($result,["image"=>$image, "listing"=>$listing,"varient"=>$varient,"feature"=>$feature]);
		return $result;
	}
	public static function get_similar_list($index)
	{
		$result = array();
		if($index > 0){
			$search = DB::select('SELECT l.price ,l.property_type_id, ml.district_id, ltr.listing_type_id  FROM listings l JOIN locations ls ON ls.id = l.location_id JOIN municipalities ml ON ml.id=ls.municipality_id JOIN listing_listing_type ltr ON ltr.listing_id = l.id  WHERE l.id = ?',[$index]);
			for($j=0;$j<count($search);$j++){
				$listings = DB::select('SELECT l.property_type_id, l.id, l.description, l.year_built, l.created_at, l.latitude, l.longitude, l.area_size, l.id, l.name, l.image ,l.price ,l.number_of_garages_or_parkingpaces, l.number_of_bedrooms ,l.number_of_bathrooms, ls.name as l_name FROM listings l JOIN locations ls ON ls.id = l.location_id JOIN municipalities ml ON ml.id=ls.municipality_id JOIN listing_listing_type ltr ON ltr.listing_id = l.id  
				WHERE ml.district_id = "'.$search[$j]->district_id.'" AND ltr.listing_type_id = "'.$search[$j]->listing_type_id.'" AND l.property_type_id = "'.$search[$j]->property_type_id.'" AND l.id <>'.$index.' AND l.price BETWEEN  '.($search[$j]->price*0.8).' AND '.($search[$j]->price*1.2));
				for($i=0;$i<count($listings);$i++){	
					array_push($result,["id" =>$listings[$i]->id,"property_type_id" =>$listings[$i]->property_type_id, "latitude" =>$listings[$i]->latitude,"longitude" =>$listings[$i]->longitude,"area_size" =>$listings[$i]->area_size,"year_built" =>$listings[$i]->year_built,"price" =>$listings[$i]->price,"garages" =>$listings[$i]->number_of_garages_or_parkingpaces,"bedrooms" =>$listings[$i]->number_of_bedrooms,"bathrooms" =>$listings[$i]->number_of_bathrooms,"address" =>json_decode($listings[$i]->l_name),"description" =>json_decode($listings[$i]->description),"name" =>json_decode($listings[$i]->name),"image" =>$listings[$i]->image]);
				}
			}
		}
		if(count($result) == 0){
			//array_push($result,["id" =>"","property_type_id" =>"", "latitude" =>"","longitude" =>"","area_size" =>"","year_built" =>"","price" =>"","garages" =>"","bedrooms" =>"","bathrooms" =>"","address" =>"","description" =>"","name" =>"","image" =>""]);
		}
		return $result;
	}
	public static function get_single_list_sales_people($index)
	{
		$result = array();
		if($index > 0){
			$results = DB::select('SELECT DISTINCT  sp.id AS id, ag.name AS name, ag.address AS address,  ag.image AS image, ag.phone AS phone, ag.email AS email FROM listings ls JOIN customers cs ON cs.id = ls.owner_id JOIN sales_people sp ON sp.customer_id=cs.id JOIN agents ag ON ag.id = sp.agent_id where ls.id="'.$index.'"');
			for($i=0;$i<count($results);$i++){	
				return ["id" =>$results[$i]->id,"name" =>$results[$i]->name,"address" =>$results[$i]->address,"image" =>$results[$i]->image,"phone" =>$results[$i]->phone,"email" =>$results[$i]->email];
			}
		}
		return ["id" =>"","name" =>"","image" =>"","phone" =>"","email" =>"","address" =>""];
	}
	public static function get_menu()
	{
		$result = array();
		$menus = DB::select('SELECT * from nova_menu_menu_items where parent_id IS NULL order by "order" desc');
		for($j=0;$j<count($menus);$j++){
			if(!($menus[$j]->parent_id)){
				$tt = Helper::get_submenu($menus[$j]->id);
				array_push($result,["name"=> $menus[$j]->name,"url"=>$menus[$j]->value,"sub"=> $tt]);
			}
		}
		if(count($result) == 0){
			array_push($result,["name"=> "","url"=>"","sub"=> []]);
		}
		return $result;
	}
	public static function get_submenu($parent_id){
		$result = array();
		$submenu = DB::select('SELECT * from nova_menu_menu_items where  parent_id = ? order by "order" desc',[$parent_id]);
		for($j=0;$j<count($submenu);$j++){
			$tt = Helper::get_submenu($submenu[$j]->id);
			array_push($result,["name"=> $submenu[$j]->name,"url"=>$submenu[$j]->value,"sub"=> $tt]);
		}
		return $result;
	}
	public static function get_proDetail($email){
		if(DB::table('customers')->where('email', $email)->exists()){
			$result = DB::table('customers')->where('email', $email)->orderBy('created_at', 'desc')->first();
			return ["notes"=>$result->notes, "mobile"=>$result->mobile,"postal_code"=>$result->postal_code,"company_name"=>$result->company_name,"image"=>$result->image, "district" =>$result->district,"country" => $result->country,"name" => $result->name,"email" =>$result->email,"address" => $result->address,"phone" => $result->phone,"city" => $result->city];
		}else{
			return ["notes"=>"","mobile"=>"","postal_code"=>"","company_name"=>"","image"=>"", "district" =>"","country" => "","name" => "","email" =>"","address" => "","phone" => "","city" => ""];
		}
	}
	public static function get_agents($page_index)
    {
		$agents = array();
		$sql = 'SELECT sp.name AS dname, sp.id AS id, ag.phone AS phone, ag.email AS email, ag.name AS name, ag.image AS image  FROM agents ag JOIN sales_people sp ON sp.agent_id = ag.id JOIN customers cs ON cs.id = sp.customer_id ';
		if(isset($page_index)){
			$sql .= " ORDER BY id DESC LIMIT 20 OFFSET ".(string) 20 * intval($page_index);
		}else{
			$sql .= " ORDER BY id DESC LIMIT 20 OFFSET 0";
		}
		$result_agents = DB::select($sql);
		for($i=0;$i<count($result_agents);$i++){
			array_push($agents,["phone"=> $result_agents[$i]->phone, "email"=> $result_agents[$i]->email,"dname"=>$result_agents[$i]->dname,"id"=>$result_agents[$i]->id, "name"=>$result_agents[$i]->name, "image"=>$result_agents[$i]->image]);
		}
		if(count($agents) == 0){
			array_push($agents,[ "phone"=> "", "email"=> "","id"=> "","name"=>"", "image"=>"", "dname"=>""]);
		}
		return $agents;
    }
	public static function get_single_agencies($index)
    {
		$agents = array();
		if($index > 0){
			$sql = 'SELECT sp.name AS dname, sp.id AS id, ag.comments AS comments,  ag.phone AS phone, ag.email AS email, ag.name AS name, ag.image AS image  FROM agents ag JOIN sales_people sp ON sp.agent_id = ag.id JOIN customers cs ON cs.id = sp.customer_id where sp.id="'.$index.'"';
			$result_agents = DB::select($sql);
			for($i=0;$i<count($result_agents);$i++){
				array_push($agents,["comments"=> $result_agents[$i]->comments, "phone"=> $result_agents[$i]->phone, "email"=> $result_agents[$i]->email,"dname"=>$result_agents[$i]->dname,"id"=>$result_agents[$i]->id, "name"=>$result_agents[$i]->name, "image"=>$result_agents[$i]->image]);
			}
		}
		if(count($agents) == 0){
			array_push($agents,["comments"=>"",  "phone"=> "", "email"=> "","id"=> "","name"=>"", "image"=>"", "dname"=>""]);
		}
		return $agents;
    }
	public static function get_single_sales_people_listing($index)
	{
		$result = array();
		if($index > 0){
			$listings = DB::select('SELECT l.latitude, l.longitude, l.area_size, l.id, l.name, l.image ,l.price ,l.number_of_garages_or_parkingpaces, l.number_of_bedrooms ,l.number_of_bathrooms, l.address  FROM listings l JOIN sales_people sp ON sp.customer_id = l.owner_id where sp.id="'.$index.'"');
			for($i=0;$i<count($listings);$i++){	
				array_push($result,["latitude" =>$listings[$i]->latitude,"longitude" =>$listings[$i]->longitude,"area_size" =>$listings[$i]->area_size,"id"=>$listings[$i]->id, "name"=> json_decode($listings[$i]->name), "image"=> $listings[$i]->image,"price"=> $listings[$i]->price, "bedrooms"=>$listings[$i]->number_of_bedrooms, "bathrooms"=>$listings[$i]->number_of_bathrooms, "address"=>$listings[$i]->address, "garages"=>$listings[$i]->number_of_garages_or_parkingpaces]);
			}
		}
		if(count($result) == 0){
			array_push($result,["latitude" =>"","longitude" =>"","area_size" =>"","id"=>"", "name"=> json_decode('{"en":""}'), "image"=>  "" ,"price"=> "", "bedrooms"=>"", "bathrooms"=>"" , "address"=>"", "garages"=>""]);
		}
		return $result;
	}
	public static function get_single_request($index)
	{
		$result = array();
		if($index > 0){
			$location = array();
			$locations = DB::select("SELECT l.id as id FROM locations l JOIN sales_request_locations srl ON srl.location_id = l.id WHERE srl.salesRequest_id =".$index);
			for($i=0;$i<count($locations);$i++){					
				array_push($location,$locations[$i]->id);
			}
			$district = array();
			$districts = DB::select("SELECT l.id as id FROM districts l JOIN sales_request_districts srl ON srl.district_id = l.id WHERE srl.salesRequest_id =".$index);
			for($i=0;$i<count($districts);$i++){					
				array_push($district,$districts[$i]->id);
			}
			$municipality = array();
			$municipalities = DB::select("SELECT l.id as id FROM municipalities l JOIN sales_request_municipalities srl ON srl.municipality_id = l.id WHERE srl.salesRequest_id =".$index);
			for($i=0;$i<count($municipalities);$i++){					
				array_push($municipality,$municipalities[$i]->id);
			}
			$listingType = array();
			$listingTypes = DB::select("SELECT l.id as id FROM listing_types l JOIN sales_request_listing_types srl ON srl.listing_type_id = l.id WHERE srl.sales_request_id =".$index);
			for($i=0;$i<count($listingTypes);$i++){					
				array_push($listingType,$listingTypes[$i]->id);
			}
			$feature = array();
			$features = DB::select("SELECT l.id as id FROM features l JOIN feature_sales_request srl ON srl.feature_id = l.id WHERE srl.sales_request_id =".$index);
			for($i=0;$i<count($features);$i++){					
				array_push($feature,$features[$i]->id);
			}
			$customer = array();
			$customers = DB::select("SELECT cs.name,cs.email , cs.address , cs.mobile, cs.phone FROM customers cs JOIN sales_requests sr ON sr.customer_id = cs.id WHERE sr.id = ".$index);
			if(count($customers)>0){					
				$customer = ["name" =>$customers[0]->name,"email" =>$customers[0]->email,"address" =>$customers[0]->address,"phone" =>$customers[0]->phone,"mobile" =>$customers[0]->mobile];
			}
			$sql = "SELECT	DISTINCT sr.status as status, sr.minimum_size as minimum_size,sr.maximum_size as maximum_size,sr.minimum_bathrooms as minimum_bathrooms, sr.minimum_bedrooms as minimum_bedrooms,  sr.maximum_budget as maximum_budget, sr.minimum_budget as minimum_budget, su.name as source, sp.name as sales_people,pt.id as property_type, cu.name as customer, sr.name as name, sr.date as date, sr.description as description  FROM sales_requests sr ";
			$sql .= " JOIN customers cu ON sr.customer_id = cu.id ";
			$sql .= " JOIN property_types pt ON sr.property_type_id = pt.id ";
			$sql .= " JOIN sources su ON sr.source_id = su.id ";
			$sql .= " JOIN sales_people sp ON sr.sales_people_id = sp.id ";
			$sql .= " WHERE sr.id=".$index;
			$listings = DB::select($sql);
			for($i=0;$i<count($listings);$i++){					
				$result = ["listing_type"=>$listingType,"customer" =>$customer,"feature" =>$feature,"municipality" =>$municipality,"district" =>$district,"location" =>$location,"minimum_bathrooms" =>$listings[$i]->minimum_bathrooms,"minimum_bedrooms" =>$listings[$i]->minimum_bedrooms,"minimum_size" =>$listings[$i]->minimum_size,"maximum_size" =>$listings[$i]->maximum_size,"maximum_budget" =>$listings[$i]->maximum_budget,"minimum_budget" =>$listings[$i]->minimum_budget,"source" =>$listings[$i]->source,"sales_people" =>$listings[$i]->sales_people,"property_type" =>$listings[$i]->property_type,"name" =>$listings[$i]->name,"date" =>$listings[$i]->date, "description"=>$listings[$i]->description, "status"=>$listings[$i]->status];
			}
		}
		if(count($result) == 0){
			$result =  ["listing_type"=>[], "customer" =>[],"feature" =>[],"municipality" =>[],"district" =>[],"location" =>[],"minimum_bathrooms" =>"","maximum_bathrooms" =>"","minimum_bedrooms" =>"","maximum_bedrooms" =>"","minimum_size" =>"","maximum_size" =>"","maximum_budget" =>"","minimum_budget" =>"","source" =>"","sales_people" =>"","property_type" =>[],"name" =>"","date" =>"", "description"=>"","status"=>""];
		}
		return $result;
	}
	public static function get_request_view_listing($index)
	{
		 $result = array();
		$sql = "SELECT	DISTINCT srl.status as status, l.property_type_id, l.created_at, l.latitude, l.longitude, l.area_size, l.id, l.name, l.image ,l.price ,l.number_of_garages_or_parkingpaces, l.number_of_bedrooms ,l.number_of_bathrooms, ls.name as l_name FROM listings l JOIN locations ls ON ls.id = l.location_id  JOIN sales_request_listings srl ON srl.listing_id=l.id  WHERE srl.status='open' and srl.sales_request_id=".$index;
		$sql .= " ORDER BY id DESC LIMIT 30 OFFSET 0";
		$listings = DB::select($sql);
		for($i=0;$i<count($listings);$i++){			
			array_push($result,["status"=>$listings[$i]->status, "property_type_id" =>$listings[$i]->property_type_id,"latitude" =>$listings[$i]->latitude,"longitude" =>$listings[$i]->longitude,"area_size" =>$listings[$i]->area_size,"id"=>$listings[$i]->id, "name"=> json_decode($listings[$i]->name), "image"=>  $listings[$i]->image ,"price"=> $listings[$i]->price, "bedrooms"=>$listings[$i]->number_of_bedrooms, "bathrooms"=>$listings[$i]->number_of_bathrooms , "address"=>json_decode($listings[$i]->l_name), "garages"=>$listings[$i]->number_of_garages_or_parkingpaces]);
		}
		if(count($result) == 0){
			array_push($result,["status"=>"", "property_type_id"=>"", "latitude" =>"","longitude" =>"","area_size" =>"","id"=>"", "name"=> json_decode('{"en":""}'), "image"=>"" ,"price"=> "", "bedrooms"=>"", "bathrooms"=>"" , "address"=>json_decode('{"en":""}'), "garages"=>""]);
		}
		return $result;
	}
	public static function get_banner_details($index)
	{
		if($index==''){
			$index = -1;
		}
		$banner_details = [];
		$sql = "SELECT	* FROM banners  WHERE  id=".$index." AND active=1 LIMIT 1";
		$banner_rows = DB::select($sql);
		if(count($banner_rows) == 1){
			$newarray = json_decode($banner_rows[0]->title,true);
            $first_key = array_key_first($newarray);
            $banner_title = $newarray[$first_key];

			$newarray = json_decode($banner_rows[0]->description,true);
            $first_key = array_key_first($newarray);
            $banner_description = $newarray[$first_key];


			$banner_details['name'] = $banner_rows[0]->name;
			$banner_details['title'] = $banner_title;
			$banner_details['image'] = $banner_rows[0]->image;
			$banner_details['description'] = $banner_description;
			$banner_details['banner_images'] = [];

			$sql = "SELECT	* FROM banner_images  WHERE  active = 1 AND  banner_id = ".$index." ORDER BY sort_order ASC";
			$banner_rows = DB::select($sql);
			for($i=0;$i<count($banner_rows);$i++){	
				$newarray = json_decode($banner_rows[$i]->name,true);
				$first_key = array_key_first($newarray);
				$banner_name = $newarray[$first_key];

				$newarray = json_decode($banner_rows[$i]->description,true);
				$first_key = array_key_first($newarray);
				$banner_description = $newarray[$first_key];

				$newarray = json_decode($banner_rows[$i]->button_text,true);
				$first_key = array_key_first($newarray);
				$banner_button_text = $newarray[$first_key];


				$banner_image = [];		
				$banner_image['id'] = $banner_rows[$i]->id;		
				$banner_image['image'] = $banner_rows[$i]->image;		
				$banner_image['name'] = $banner_name;		
				$banner_image['description'] = $banner_description;		
				$banner_image['button_text'] = $banner_button_text;		
				$banner_image['link'] = $banner_rows[$i]->link;		
				$banner_image['language_id'] = $banner_rows[$i]->language_id;		
				$banner_image['active'] = $banner_rows[$i]->active;

				$banner_details['banner_images'][] = $banner_image;
			}
		}
		return $banner_details;
	}
	public static function get_request_view_listing_count($index)
	{
		$sql = "SELECT	DISTINCT l.property_type_id, l.created_at, l.latitude, l.longitude, l.area_size, l.id, l.name, l.image ,l.price ,l.number_of_garages_or_parkingpaces, l.number_of_bedrooms ,l.number_of_bathrooms, ls.name as l_name FROM listings l JOIN locations ls ON ls.id = l.location_id  JOIN sales_request_listings srl ON srl.listing_id=l.id  WHERE  srl.status='open' and srl.sales_request_id=".$index;
		$listings = DB::select($sql);
		return count($listings);
	}
	public static function get_appointments($index)
	{
		$result = array();
		if($index > 0){
			$location = array();
			$sql = "SELECT srp.id as id, l.name as name, srp.date as date, srp.status as status FROM sales_request_appointments srp JOIN listings l ON l.id = srp.listing_id WHERE srp.sales_request_id=".$index;
			$listings = DB::select($sql);
			$result = $listings;
		}
		if(count($result) == 0){
			$result =  [];
		}
		return $result;
	}
	public static function get_reasons()//: JsonResponse
    {
		$result = "";
		$reasons = DB::select('SELECT * FROM sales_lost_reasons');
		for($i=0;$i<count($reasons);$i++){
			if($i == 0){
				$result = $reasons[$i]->id.",".$reasons[$i]->name;
			}else{
				$result .= ",".$reasons[$i]->id.",".$reasons[$i]->name;
			}
		}
		return $result;
    }
	public static function get_favorites()//: JsonResponse
    {
		$result = array();
		if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
			$list = DB::select('SELECT * FROM favorite_properties where customer_id='.$_SESSION["user_id"]);
			for($i=0;$i<count($list);$i++){
				array_push($result, $list[$i]->listing_id);
			}
		}
		
		return $result;
    }
	public static function get_favoritList()//: JsonResponse
    {
		$result = array();
		if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] != ''){
			$result = DB::select('SELECT * FROM  listings ls JOIN favorite_properties fp ON fp.listing_id=ls.id where fp.customer_id='.$_SESSION["user_id"]);
		}
		return $result;
    }
}