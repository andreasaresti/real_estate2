<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\SalesRequestAppointment;
use App\Http\Requests\SalesRequestAppointmentStoreRequest;
use App\Http\Requests\SalesRequestAppointmentUpdateRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SendEmailController;

class SalesRequestAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', SalesRequestAppointment::class);

        $search = $request->get('search', '');

        $salesRequestAppointments = SalesRequestAppointment::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.sales_request_appointments.index',
            compact('salesRequestAppointments', 'search')
        );
    }

    public function get(Request $request)
    {
        $data = $request;
       // $result = array();
       if($data['show_open_flag']){
            $sql = "SELECT srp.id as id, l.name as name, srp.date as date, srp.status as status FROM sales_request_appointments srp JOIN listings l ON l.id = srp.listing_id WHERE srp.sales_request_id=".$data['requestIndex']." and srp.status ='open'";
       }else{
            $sql = "SELECT srp.id as id, l.name as name, srp.date as date, srp.status as status FROM sales_request_appointments srp JOIN listings l ON l.id = srp.listing_id WHERE srp.sales_request_id=".$data['requestIndex'];
       }
		$listings = \DB::select($sql);
		//$result = $listings;
		return response()->json($listings);
    }
    public function add(Request $request)
    {
        $data = $request;
        $listings = explode(",",$data['appointmentListings']);
        for($i=0;$i<count($listings);$i++){
            // if(!DB::table('sales_request_appointments')->where('sales_request_id', $data['requestIndex'])->where('listing_id', $listings[$i])->exists()){
                $temp = \DB::select('INSERT INTO sales_request_appointments( sales_request_id, listing_id, date,signed,status) 
                    VALUES ('.$data['requestIndex'].','.$listings[$i].',"'.$data['date'].'",0,"open")');
                $temp = \DB::table('sales_requests') ->where('id', $data['requestIndex']) ->limit(1) ->update( [ 'accepted_status' => "yes"]); 
            // }else{
            //     $temp = \DB::table('sales_request_appointments') ->where('sales_request_id', $data['requestIndex'])->where('listing_id', $listings[$i]) ->limit(1) 
            //     ->update( [ 'sales_request_id' => $data['requestIndex'],  
            //             'listing_id' => $listings[$i],
            //             'date' => $data['date'],
            //             'signed' => 0,
            //             'status' => "open"]);
            //     $temp = \DB::table('sales_requests') ->where('id', $data['requestIndex']) ->limit(1) ->update( [ 'accepted_status' => "yes"]); 
            // }
        }
        return "ok";
    }
    public function update_status(Request $request)
    {
        $data = $request;
        if(DB::table('sales_request_appointments')->where('id', $data['listingIndex'])->exists()){
            $temp = \DB::table('sales_request_appointments')->where('id', $data['listingIndex'])->limit(1) 
                ->update( ['status' => $data['status']]);
            return "ok";
        }else{
            return "fail";
        }
    }
    public function update(Request $request)
    {
        $data = $request;
        $sql = "SELECT cs.email FROM sales_requests sr JOIN customers cs ON cs.id = sr.customer_id WHERE sr.id=".$data['requestIndex'];
        $emails = \DB::select($sql);
        $lists = explode(",",$data['lists']);
        $image =$data['signatureImage'];
        $image_parts = explode(";base64,", $image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $file = base64_decode($image_parts[1]);
        $safeName = 'signed_'.time().".".$image_type;
        $success = file_put_contents(public_path('storage').'/'.$safeName, $file);
        for($i=0;$i<count($lists);$i++){
            $temp = SalesRequestAppointment::where('id', $lists[$i]) ->limit(1) 
            ->update( [ 'date_signed' => $data['date'],
                    'signed' => 1,
                    'status'=>"completed",
                    'signature' => $safeName]);
        }
        return "ok";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', SalesRequestAppointment::class);

        $listings = Listing::pluck('name', 'id');

        return view(
            'app.sales_request_appointments.create',
            compact('listings')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        SalesRequestAppointmentStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', SalesRequestAppointment::class);

        $validated = $request->validated();

        $salesRequestAppointment = SalesRequestAppointment::create($validated);

        return redirect()
            ->route('sales-request-appointments.edit', $salesRequestAppointment)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        SalesRequestAppointment $salesRequestAppointment
    ): View {
        $this->authorize('view', $salesRequestAppointment);

        return view(
            'app.sales_request_appointments.show',
            compact('salesRequestAppointment')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        SalesRequestAppointment $salesRequestAppointment
    ): View {
        $this->authorize('update', $salesRequestAppointment);

        $listings = Listing::pluck('name', 'id');

        return view(
            'app.sales_request_appointments.edit',
            compact('salesRequestAppointment', 'listings')
        );
    }

    /**
     * Update the specified resource in storage.
     */
   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        SalesRequestAppointment $salesRequestAppointment
    ): RedirectResponse {
        $this->authorize('delete', $salesRequestAppointment);

        $salesRequestAppointment->delete();

        return redirect()
            ->route('sales-request-appointments.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
