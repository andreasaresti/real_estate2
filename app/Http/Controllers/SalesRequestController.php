<?php

namespace App\Http\Controllers;

use App\Models\Source;
use App\Models\Customer;
use Illuminate\View\View;
use App\Models\SalesPeople;
use App\Models\SalesRequest;
use Illuminate\Http\Request;
use App\Models\PropertyType;
use App\Models\SalesRequestStatus;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SalesRequestStoreRequest;
use App\Http\Requests\SalesRequestUpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\FacadesDB;

class SalesRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', SalesRequest::class);

        $search = $request->get('search', '');

        $salesRequests = SalesRequest::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.sales_requests.index',
            compact('salesRequests', 'search')
        );
    }

    public function get(Request $request)
    {
        session_start():
        $result = array();
		$data = $request;
		$location_data = explode(',', $data['location']);
        $listingtype_data = explode(',', $data['listingtype']);
        
		$sql = "SELECT	DISTINCT sr.id as id, sr.name as name, sr.date as date, sr.description as description  FROM sales_requests sr ";
		if(count($data['feature']) > 0 ){
			$sql .= " JOIN feature_sales_request fsr ON fsr.sales_request_id = sr.id ";
		}
		if(count($location_data) > 1){
            for($i=0;$i<count($location_data);$i=$i+2){
				if($location_data[$i+1] == "districts"){
					$sql .= " JOIN sales_request_districts srd ON srd.salesRequest_id = sr.id ";
				}else if($location_data[$i+1] == "municipalities"){
					$sql .= " JOIN sales_request_municipalities srm ON srm.salesRequest_id = sr.id ";
				}else if(strpos($data['location'],"locations")>0){
					$sql .= " JOIN sales_request_locations srl ON srl.salesRequest_id = sr.id ";
				}
			}
		}
        if(count($listingtype_data) > 0  && $data['listingtype'] !== "0"){
			$sql .= " JOIN sales_request_listing_types srlt ON srlt.sales_request_id = sr.id ";
		}
		$sql .= " WHERE sr.sales_people_id = ".$_SESSION["user_id"]." ";
        if($data['flag'] == "open"){
            $sql .= ' AND status = "open" ';
        }
        if($data['flag'] == "not_approved"){
            $sql .= ' AND accepted_status <> "open" ';
        }
		if(count($location_data) > 1){
			$sql .= " AND (";
			for($i=0;$i<count($location_data);$i=$i+2){
				if($location_data[$i+1] == "districts"){
					$sql .= " srd.district_id = ".$location_data[$i]." "; 
				}else if($location_data[$i+1] == "municipalities"){
					$sql .= " srm.municipality_id = ".$location_data[$i]." "; 
				}else if(strpos($data['location'],"locations")>0){
					$sql .= " srl.location_id = ".$location_data[$i]." "; 
				}
				$sql .= "OR";
			}
			$sql = substr($sql,0,strlen($sql)-2);
			$sql .= ")";
		}
		if(count($listingtype_data) > 0 && $data['listingtype'] !== "0"){
			$sql .= " AND (";
			for($i=0;$i<count($listingtype_data);$i++){
				$sql .= " srlt.listing_type_id = ".$listingtype_data[$i]." "; 
				$sql .= "OR";
			}
			$sql = substr($sql,0,strlen($sql)-2);
			$sql .= ")";
		}
		if(count($data['feature']) > 0 ){
			for($i=0;$i<count($data['feature']);$i++)
			{
				$sql .= " AND fsr.feature_id = ".$data['feature'][$i]." "; 
			}
		}

		if($data['type']>0){
			$sql .= " AND sr.property_type_id = '".$data['type']."' "; 
		}
		if($data['bedrooms']>0){
			$sql .= " AND sr.minimum_bedrooms <= '".$data['bedrooms']."' "; 
            //$sql .= " AND sr.maximum_bedrooms >= '".$data['bedrooms']."' "; 
		}
		if($data['bathrooms']>0){
			$sql .= " AND sr.minimum_bathrooms <= '".$data['bathrooms']."' "; 
            //$sql .= " AND sr.maximum_bathrooms >= '".$data['bathrooms']."' "; 
		}
        if($data['size']>0){
			$sql .= " AND sr.minimum_size <= '".$data['size']."' "; 
            $sql .= " AND sr.maximum_size >= '".$data['size']."' "; 
		}
        if($data['price']>0){
			$sql .= " AND sr.minimum_budget <= '".$data['price']."' "; 
            $sql .= " AND sr.maximum_budget >= '".$data['price']."' "; 
		}
		if(isset($data['string']) && $data['string'] !== ""){
			$sql .= " AND ( sr.description LIKE '%".$data['string']."%' OR sr.name LIKE '%".$data['string']."%') ";
		}
        //return $sql;
		$listings = DB::select($sql);		
		for($i=0;$i<count($listings);$i++){
			array_push($result,["id" =>$listings[$i]->id,"name" =>$listings[$i]->name,"date" =>$listings[$i]->date, "description"=>$listings[$i]->description]);
		}
		return response()->json($result);
    }
    public function cur_get(Request $request)
    {
        $listings = DB::select("SELECT	
                            sr.id as id, 
                            sr.name as name, 
                            sr.date as date, 
                            sr.description as description,
                            sr.minimum_budget as minimum_budget,
                            sr.maximum_budget as maximum_budget,
                            pt.name as property_type,
                            sr.minimum_size as minimum_size,
                            sr.minimum_bedrooms as minimum_bedrooms
                        FROM sales_requests sr 
                        JOIN property_types pt ON pt.id=sr.property_type_id  
                        WHERE sr.id = '".$request['index']."'");	
		return response()->json($listings[0]);
    }
    public function cur_get_list(Request $request)
    {
        // $listings = DB::select("SELECT l.name, l.id FROM listings l JOIN sales_requests sr 
        // ON sr.property_type_id = l.property_type_id 
        // AND sr.minimum_bathrooms < l.number_of_bathrooms 
        // AND sr.minimum_budget < l.price 
        // AND sr.minimum_size < l.area_size 
        // AND sr.minimum_bedrooms < l.number_of_bedrooms 
        // WHERE sr.id = '".$request['index']."'");	
        $listings = DB::select("SELECT l.name, l.id FROM listings l JOIN sales_request_listings srl ON srl.listing_id=l.id  WHERE srl.sales_request_id=".$request['index']." AND srl.status = 'open'");
		return response()->json($listings);
    }
    public function add_listing(Request $request)
    {
        $data = $request;
        if(!DB::table('sales_request_listings')->where('sales_request_id', $data['requestIndex'])->where('listing_id', $data['listingIndex'])->exists()){
		    $temp = DB::select('INSERT INTO sales_request_listings( sales_request_id, listing_id, status) 
                VALUES ('.$data['requestIndex'].','.$data['listingIndex'].',"open")');
            return "ok";
        }else{
            $temp = DB::table('sales_request_listings') ->where('sales_request_id', $data['requestIndex'])->where('listing_id', $data['listingIndex'])->delete();                
            return "del";
        }
    }
    public function update_listings_status(Request $request)
    {
        $data = $request;
        if(DB::table('sales_request_listings')->where('sales_request_id', $data['requestIndex'])->where('listing_id', $data['listingIndex'])->exists()){
            $temp = DB::table('sales_request_listings')->where('sales_request_id', $data['requestIndex'])->where('listing_id', $data['listingIndex'])->limit(1) 
                ->update( ['status' => $data['status']]);
            return "ok";
        }else{
            return "fail";
        }
    }
    public function accept(Request $request)
    {
        $data = $request;
        $temp = DB::table('sales_requests') ->where('id', $data['requestIndex'])->limit(1) 
                ->update( [ 'accepted_status' => "yes"]);
        return "ok";
    }
    public function colse_deal(Request $request)
    {
        $data = $request;
        if($data['status'] == "won"){
            $temp = DB::table('sales_requests') ->where('id', $data['request'])->limit(1) 
                ->update( ['sales_lost_reason_id' => NULL,'listing_id' => $data['listing_id'],'agreement_price' => (int)$data['price'],'status' => $data['status']]);
        }else{
            $temp = DB::table('sales_requests') ->where('id', $data['request'])->limit(1) 
                ->update( ['agreement_price' => NULL, 'sales_lost_reason_id' => $data['reasons'],'status' => $data['status']]);
        }
        return "ok";
    }
    public function update(Request $request)
    {
        $data = $request;
        $temp = DB::table('sales_requests') ->where('id', $data['requestIndex']) ->limit(1) 
            ->update( [ 'minimum_budget' => $data['bsize'],  
            'maximum_budget' => $data['tprice'],
            'minimum_size' => $data['bprice'],
            'maximum_size' => $data['tsize'],
            'minimum_bedrooms' => $data['bedrooms'],
            'minimum_bathrooms' => $data['bathrooms'],
            'property_type_id' => $data['type']]);
        $temp = DB::table('sales_request_municipalities') ->where('salesRequest_id', $data['requestIndex']) ->delete();
        $temp = DB::table('sales_request_locations') ->where('salesRequest_id', $data['requestIndex']) ->delete();
        $temp = DB::table('sales_request_districts') ->where('salesRequest_id', $data['requestIndex']) ->delete();
        $temp = DB::table('sales_request_listing_types') ->where('sales_request_id', $data['requestIndex']) ->delete();
        $temp = DB::table('feature_sales_request') ->where('sales_request_id', $data['requestIndex']) ->delete();
        $location_data = explode(',', $data['location']);
        for($i=0;$i<count($location_data);$i=$i+2){
            if($location_data[$i]>0){
                if($location_data[$i+1] == "districts"){
                    $temp = DB::select('INSERT INTO sales_request_districts( salesRequest_id, district_id) 
                        VALUES ('.$data['requestIndex'].','.$location_data[$i].')');
                }else if($location_data[$i+1] == "municipalities"){
                    $temp = DB::select('INSERT INTO sales_request_municipalities( salesRequest_id, municipality_id) 
                        VALUES ('.$data['requestIndex'].','.$location_data[$i].')');
                }else{
                    $temp = DB::select('INSERT INTO sales_request_locations( salesRequest_id, location_id) 
                        VALUES ('.$data['requestIndex'].','.$location_data[$i].')');
                }
            }
        }
        for($i=0;$i<count($data['feature']);$i++)
        {
            if($data['feature'][$i]>0){
                $temp = DB::select('INSERT INTO feature_sales_request( sales_request_id, feature_id) 
                    VALUES ('.$data['requestIndex'].','.$data['feature'][$i].')');
            }
        }
        
        $listing_type = explode(',', $data['status']);
        for($i=0;$i<count($listing_type);$i++)
        {
            if($listing_type[$i]>0){
                $temp = DB::select('INSERT INTO sales_request_listing_types( sales_request_id, listing_type_id) 
                        VALUES ('.$data['requestIndex'].','.$listing_type[$i].')');
            }
        }
        return "ok";
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', SalesRequest::class);

        $customers = Customer::pluck('name', 'id');
        $sources = Source::pluck('name', 'id');
        $allSalesPeople = SalesPeople::pluck('name', 'id');
        $propertyTypes = PropertyType::pluck('name', 'id');
        $salesRequestStatuses = SalesRequestStatus::pluck('name', 'id');

        return view(
            'app.sales_requests.create',
            compact(
                'customers',
                'sources',
                'allSalesPeople',
                'propertyTypes',
                'salesRequestStatuses'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalesRequestStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', SalesRequest::class);

        $validated = $request->validated();

        $salesRequest = SalesRequest::create($validated);

        return redirect()
            ->route('sales-requests.edit', $salesRequest)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, SalesRequest $salesRequest): View
    {
        $this->authorize('view', $salesRequest);

        return view('app.sales_requests.show', compact('salesRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, SalesRequest $salesRequest): View
    {
        $this->authorize('update', $salesRequest);

        $customers = Customer::pluck('name', 'id');
        $sources = Source::pluck('name', 'id');
        $allSalesPeople = SalesPeople::pluck('name', 'id');
        $propertyTypes = PropertyType::pluck('name', 'id');
        $salesRequestStatuses = SalesRequestStatus::pluck('name', 'id');

        return view(
            'app.sales_requests.edit',
            compact(
                'salesRequest',
                'customers',
                'sources',
                'allSalesPeople',
                'propertyTypes',
                'salesRequestStatuses'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(
    //     SalesRequestUpdateRequest $request,
    //     SalesRequest $salesRequest
    // ): RedirectResponse {
    //     $this->authorize('update', $salesRequest);

    //     $validated = $request->validated();

    //     $salesRequest->update($validated);

    //     return redirect()
    //         ->route('sales-requests.edit', $salesRequest)
    //         ->withSuccess(__('crud.common.saved'));
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        SalesRequest $salesRequest
    ): RedirectResponse {
        $this->authorize('delete', $salesRequest);

        $salesRequest->delete();

        return redirect()
            ->route('sales-requests.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
