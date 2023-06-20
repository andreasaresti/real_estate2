<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Customer;
use Illuminate\View\View;
use App\Models\SalesPeople;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SalesPeopleStoreRequest;
use App\Http\Requests\SalesPeopleUpdateRequest;
use App\Models\SalesRequest;
use App\Models\SalesRequestDistrict;
use App\Models\SalesRequestListing;
use App\Models\SalesRequestListingType;
use App\Models\SalesRequestMunicipality;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\FacadesDB;

class SalesPeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get(Request $request)
	{
		$result = array();
		$data = $request;
		$sql = 'SELECT sp.name AS dname, sp.id AS id, ag.phone AS phone, ag.email AS email, ag.name AS name, ag.image AS image  FROM agents ag JOIN sales_people sp ON sp.agent_id = ag.id JOIN customers cs ON cs.id = sp.customer_id ';
		if(isset($data['page_index'])){
			$sql .= "ORDER BY id DESC LIMIT 20 OFFSET ".(string) 20 * (intval($data['page_index'])-1);
		}else{
			$sql .= "ORDER BY id DESC LIMIT 20 OFFSET 0";
		}
		$result_agents = DB::select($sql);
		for($i=0;$i<count($result_agents);$i++){
			array_push($result,[ "phone"=> $result_agents[$i]->phone, "email"=> $result_agents[$i]->email,"dname"=>$result_agents[$i]->dname,"id"=>$result_agents[$i]->id, "name"=>$result_agents[$i]->name, "image"=>$result_agents[$i]->image]);

		}
		return response()->json($result);
	}

    public function store_inquiry(Request $request)
	{
        $cur_date = date('Y-m-d');
        $data = $request;
        
        $sources = DB::table('sources')->where('name', "website")->first();
        $cur_listing = DB::table('listings')->where('id', $data['listing_id'])->first();

        $sales_request = SalesRequest::create(array(
                                            'name' => $data['inquiry_fname'],
                                            'customer_id' => $data['customer_id'],
                                            'source_id' => $sources->id,
                                            'date' => $cur_date,
                                            'property_type_id' => $cur_listing->property_type_id,
                                            'minimum_budget' => $cur_listing->price * 0.8,
                                            'maximum_budget' => $cur_listing->price * 1.2,
                                            'description' => $data['inquiry_message'],
                                        ));
        

        if($data['listing_id'] != ''){
            $sales_request_listing = SalesRequestListing::create(array(
                'listing_id' => $data['listing_id'],
                'sales_request_id' => $sales_request->id,
                'status' => 'open',
                'emailed' => 0,
            )); 
        }
        $cur_types = DB::select('SELECT *  FROM listing_listing_type WHERE listing_id='.$data['listing_id']);
        for($i=0;$i<count($cur_types);$i++){
            $sales_request_listing = SalesRequestListingType::create(array(
                'listing_type_id' => $cur_types[$i]->listing_type_id,
                'sales_request_id' => $sales_request->id,
            ));
        }
        $cur_location = DB::select('SELECT mp.id AS municipality, ds.id AS district  FROM districts ds JOIN municipalities mp ON mp.district_id = ds.id JOIN locations ls ON ls.municipality_id = mp.id WHERE ls.id='.$cur_listing->location_id);
        $sales_request_district = SalesRequestDistrict::create(array(
            'district_id' => $cur_location[0]->district,
            'salesRequest_id' => $sales_request->id,
        ));
        $sales_request_municipality = SalesRequestMunicipality::create(array(
            'municipality_id' => $cur_location[0]->district,
            'salesRequest_id' => $sales_request->id,
        ));
        
        return "ok";
	}
   
    public function index(Request $request): View
    {
        $this->authorize('view-any', SalesPeople::class);

        $search = $request->get('search', '');

        $allSalesPeople = SalesPeople::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.all_sales_people.index',
            compact('allSalesPeople', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', SalesPeople::class);

        $customers = Customer::pluck('name', 'id');
        $agents = Agent::pluck('name', 'id');

        return view(
            'app.all_sales_people.create',
            compact('customers', 'agents')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalesPeopleStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', SalesPeople::class);

        $validated = $request->validated();

        $salesPeople = SalesPeople::create($validated);

        return redirect()
            ->route('all-sales-people.edit', $salesPeople)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, SalesPeople $salesPeople): View
    {
        $this->authorize('view', $salesPeople);

        return view('app.all_sales_people.show', compact('salesPeople'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, SalesPeople $salesPeople): View
    {
        $this->authorize('update', $salesPeople);

        $customers = Customer::pluck('name', 'id');
        $agents = Agent::pluck('name', 'id');

        return view(
            'app.all_sales_people.edit',
            compact('salesPeople', 'customers', 'agents')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SalesPeopleUpdateRequest $request,
        SalesPeople $salesPeople
    ): RedirectResponse {
        $this->authorize('update', $salesPeople);

        $validated = $request->validated();

        $salesPeople->update($validated);

        return redirect()
            ->route('all-sales-people.edit', $salesPeople)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        SalesPeople $salesPeople
    ): RedirectResponse {
        $this->authorize('delete', $salesPeople);

        $salesPeople->delete();

        return redirect()
            ->route('all-sales-people.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
