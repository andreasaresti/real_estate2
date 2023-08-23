<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Customer;
use App\Models\SalesRequestNote;
use App\Models\SalesRequestListing;
use App\Models\SalesRequest;
use App\Models\SalesRequestAppointment;
use App\Models\SalesRequestDistrict;
use App\Models\SalesRequestListingType;
use App\Models\SalesRequestLocation;
use App\Models\SalesRequestMunicipality;
use App\Models\SalesLostReason;
use App\Models\SalesRequestNoteType;
use App\Models\FeatureSalesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\ResponsiveImages\ResponsiveImage;
use PDF;
use Mail;
use App\Mail\SendMail;

class webSalesRequestController extends Controller
{
    public function close_deal(Request $request)
    {
        // $this->authorize('create', Customer::class);
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:sales_requests,id',
            'status' => 'required|in:won,lost',
            'listing_id' => 'nullable|integer|required_if:status,won|exists:listings,id',
            'agreement_price' => 'nullable|integer|required_if:status,won',
            'sales_lost_reason_id' => 'nullable|integer|required_if:status,lost|exists:sales_lost_reasons,id',
        ]);
        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        SalesRequest::where('id', $request->id)->update([
            'status' => $request->status,
            'listing_id' => $request->listing_id,
            'agreement_price' => $request->agreement_price,
            'sales_lost_reason_id' => $request->sales_lost_reason_id,
        ]);

        return response()->json([
            'message' => 'Sales Request updated successfully'
        ], 201);
    }
    public function add_note(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sales_request_id' => 'required|integer|exists:sales_requests,id',
            'sales_request_note_type_id' => 'required|integer|exists:sales_request_note_types,id',
            'description' => 'required|string'
        ]);
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $note = SalesRequestNote::create([
            'sales_request_id' => $request->sales_request_id,
            'sales_request_note_type_id' => $request->sales_request_note_type_id,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Note created successfully',
            'note' => $note,
        ], 201);
    }
    public function get_notes(Request $request)
    {
        $perPage = 20;
        $page = 1;
        $orderby = 'sales_request_notes.id';
        $orderbytype = 'desc';

        $validator = Validator::make($request->all(), [
            'sales_request_id' => 'required|integer|exists:sales_requests,id',
            'sales_request_note_type_id' => 'nullable|integer|exists:sales_request_note_types,id',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $query = SalesRequestNote::where('sales_request_id', $request->sales_request_id);
        ;
        if ($request->has('sales_request_note_type_id') && $request->sales_request_note_type_id != '') {
            $query = $query->where('sales_request_note_type_id', $request->sales_request_note_type_id);
        }

        $query = $query
            ->select('sales_request_notes.*')
            ->orderBy($orderby, $orderbytype)
            ->paginate($perPage, ['/*'], 'page', $page);

        $sales_request_notes = $query;

        return response()->json($sales_request_notes);
    }
    public function add_appointments(Request $request)
    {
        foreach ($request->listings as $listing_id) {
            $validator = Validator::make($request->all(), [
                'listings' => 'required|array|exists:listings,id',
                'sales_request_id' => 'required|integer|exists:sales_requests,id',
                'date' => 'required|date',
                'status' => 'required|string',
            ]);
            // Check if the validation fails
            if ($validator->fails()) {
                // Return the validation errors
                return response()->json([
                    'errors' => $validator->errors(),
                ], 422);
            }
        }

        $appointment_array = [];

        foreach ($request->listings as $listing_id) {
            $appointment = SalesRequestAppointment::create([
                'sales_request_id' => $request->sales_request_id,
                'listing_id' => $listing_id,
                'date' => $request->date,
                'status' => $request->status,
            ]);
            array_push($appointment_array, $appointment);
        }

        return response()->json([
            'message' => 'Appointment created successfully.',
            'appointment' => $appointment_array,
        ], 201);
    }
    public function get_appointments(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sales_request_id' => 'required|integer|exists:sales_requests,id',
            'listing_id' => 'nullable|integer|exists:listings,id',
            'status' => 'nullable|string',
            'signed' => 'nullable|integer',
        ]);
        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $perPage = 20;
        $page = 1;
        $orderby = 'sales_request_appointments.id';
        $orderbytype = 'desc';

        $query = SalesRequestAppointment::where('sales_request_id', $request->sales_request_id);
        if ($request->has('listing_id') && $request->listing_id != '') {
            $query = $query->where('listing_id', $request->listing_id);
        }
        if ($request->has('status') && $request->status != '') {
            $query = $query->where('status', $request->status);
        }
        if ($request->has('signed') && $request->signed != '') {
            $query = $query->where('signed', $request->signed);
        }

        $query = $query
            ->select('sales_request_appointments.*')
            ->orderBy($orderby, $orderbytype)
            ->paginate($perPage, ['/*'], 'page', $page);

        foreach ($query as $key => $row) {
            $listing = Listing::find($row->listing_id);
            $query[$key]->listing_name = $listing->name;
            $query[$key]->image = '';
            if ($listing->image != '') {
                $query[$key]->image = env('APP_URL') . '/storage/' . $listing->image;
            }

        }
        $sales_request_appointments = $query;
        return response()->json($sales_request_appointments);
    }
    public function get_listings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sales_request_id' => 'required|integer|exists:sales_requests,id',
            'listing_id' => 'nullable|integer|exists:listings,id',
            'status' => 'nullable|string',
            'emailed' => 'nullable|integer',
            'active' => 'nullable|integer',
        ]);


        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $perPage = 20;
        $page = 1;
        $orderby = 'sales_request_listings.id';
        $orderbytype = 'desc';

        $query = SalesRequestListing::where('sales_request_id', $request->sales_request_id);

        if ($request->has('listing_id') && $request->listing_id != '') {
            $query = $query->where('listing_id', $request->listing_id);
        }
        if ($request->has('status') && $request->status != '') {
            $query = $query->where('status', $request->status);
        }
        if ($request->has('emailed') && $request->emailed != '') {
            $query = $query->where('emailed', $request->emailed);
        }
        if ($request->has('active') && $request->active != '') {
            $query = $query->where('active', $request->active);
        }

        $query = $query
            ->select('sales_request_listings.*')
            ->orderBy($orderby, $orderbytype)
            ->paginate($perPage, ['/*'], 'page', $page);

        foreach ($query as $key => $row) {
            $listing = Listing::find($row->listing_id);
            $query[$key]->listing_name = $listing->name;
            $query[$key]->image = '';
            if ($listing->image != '') {
                $query[$key]->image = env('APP_URL') . '/storage/' . $listing->image;
            }

        }

        $sales_request_listings = $query;
        return response()->json($sales_request_listings);
    }
    public function get_sales_request_detail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:sales_requests,id',
        ]);


        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $query = SalesRequest::where('id', $request->id);

        $query = $query
            ->select('sales_requests.*')
            ->first();

        $customer = Customer::where('id', $query->customer_id)->first();
        $query->customer_name = $customer->name;
        $query->customer_surname = $customer->surname;
        $query->customer_email = $customer->email;
        $query->customer_phone = $customer->phone;
        $query->customer_address = $customer->address;

        $resultDistricts = SalesRequestDistrict::where('salesRequest_id', $request->id)->get();
        $districts = array();
        foreach ($resultDistricts as $row) {
            array_push($districts, $row->district_id);
        }
        $query->districts = $districts;

        $resultMunicipalities = SalesRequestMunicipality::where('salesRequest_id', $request->id)->get();
        $Municipalities = array();
        foreach ($resultMunicipalities as $row) {
            array_push($Municipalities, $row->municipality_id);
        }
        $query->municipalities = $Municipalities;

        $resultLocations = SalesRequestLocation::where('salesRequest_id', $request->id)->get();
        $locations = array();
        foreach ($resultLocations as $row) {
            array_push($locations, $row->location_id);
        }
        $query->locations = $locations;

        $resultListingTypes = SalesRequestListingType::where('sales_request_id', $request->id)->get();
        $listingTypes = array();
        foreach ($resultListingTypes as $row) {
            array_push($listingTypes, $row->listing_type_id);
        }
        $query->listingTypes = $listingTypes;

        $resultfeatures = FeatureSalesRequest::where('sales_request_id', $request->id)->get();
        $features = array();
        foreach ($resultfeatures as $row) {
            array_push($features, $row->feature_id);
        }
        $query->features = $features;

        $sales_request_detail = $query;
        return response()->json($sales_request_detail);
    }
    public function add_listing(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sales_request_id' => 'required|integer|exists:sales_requests,id',
            'listing_id' => 'required|integer|exists:listings,id',
        ]);
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $listing = SalesRequestListing::create([
            'sales_request_id' => $request->sales_request_id,
            'listing_id' => $request->listing_id,
        ]);

        return response()->json([
            'message' => 'Listing added successfully',
            'list' => $listing,
        ], 201);
    }
    public function delete_listing(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sales_request_id' => 'required|integer|exists:sales_requests,id',
            'listing_id' => 'required|integer|exists:listings,id',
        ]);
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $listing = SalesRequestListing::where('sales_request_id', $request->sales_request_id)
            ->where('listing_id' , $request->listing_id) ->delete();

        return response()->json([
            'message' => 'Listing added successfully',
            'list' => $listing,
        ], 201);
    }
    public function change_listing_type(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:sales_request_listings,id',
            'status' => 'required|string|in:open,not_interested',
        ]);
        // Check if the validation errors
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        SalesRequestListing::where('id', $request->id)->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Sales Request Listings updated successfully'
        ], 201);
    }
    public function add_sales_request(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'date' => 'required|date',
            'customer_id' => 'required|integer|exists:customers,id',
            'source_id' => 'required|integer|exists:sources,id',
            'property_type_id' => 'required|integer|exists:property_types,id',
            'minimum_budget' => 'nullable|integer',
            'maximum_budget' => 'nullable|integer',
            'minimum_size' => 'nullable|integer',
            'maximum_size' => 'nullable|integer',
            'minimum_bedrooms' => 'nullable|integer',
            'minimum_bashrooms' => 'nullable|integer',
            'description' => 'nullable|string',
            'sales_request_districts' => 'nullable|array|exists:districts,id',
            'sales_request_listing_types' => 'nullable|array|exists:listing_types,id',
            'sales_request_locations' => 'nullable|array|exists:locations,id',
            'sales_request_municipalities' => 'nullable|array|exists:municipalities,id',
        ]);
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $salesRequest = SalesRequest::create([
            'name' => $request->name,
            'date' => $request->date,
            'customer_id' => $request->customer_id,
            'source_id' => $request->source_id,
            'property_type_id' => $request->property_type_id,
            'minimum_budget' => $request->minimum_budget,
            'maximum_budget' => $request->maximum_budget,
            'minimum_size' => $request->minumum_size,
            'maximum_size' => $request->maximum_size,
            'minimum_bedrooms' => $request->minimum_bedrooms,
            'minimum_bashrooms' => $request->minimum_bashrooms,
            'description' => $request->description
        ]);
        if ($request->has('sales_request_districts') && count($request->sales_request_districts) > 0) {
            foreach ($request->sales_request_districts as $districtid) {
                SalesRequestDistrict::create([
                    'salesRequest_id' => $salesRequest->id,
                    'district_id' => $districtid,
                ]);
            }
        }
        if ($request->has('sales_request_municipalities') && count($request->sales_request_municipalities) > 0) {
            foreach ($request->sales_request_municipalities as $municipalityid) {
                SalesRequestMunicipality::create([
                    'salesRequest_id' => $salesRequest->id,
                    'municipality_id' => $municipalityid,
                ]);
            }
        }
        if ($request->has('sales_request_locations') && count($request->sales_request_locations) > 0) {
            foreach ($request->sales_request_locations as $locationid) {
                SalesRequestLocation::create([
                    'salesRequest_id' => $salesRequest->id,
                    'location_id' => $locationid,
                ]);
            }
        }
        if ($request->has('sales_request_listing_types') && count($request->sales_request_listing_types) > 0) {
            foreach ($request->sales_request_listing_types as $listingtype) {
                SalesRequestListingType::create([
                    'sales_request_id' => $salesRequest->id,
                    'listing_type_id' => $listingtype,
                ]);
            }
        }


        return response()->json([
            'message' => 'Sales Request added successfully',
            'salesRequest' => $salesRequest,
        ], 201);
    }
    public function get_sales_request(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'accepted_status' => 'nullable|string|in:yes,no',
            'sales_people_id' => 'required|integer|exists:sales_people,id',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $perPage = 20;
        $page = 1;
        $orderby = 'sales_requests.id';
        $orderbytype = 'desc';

        $query = SalesRequest::where('sales_people_id', $request->sales_people_id)
            ->where('status', 'open')
            ->where('active', '1');

        if ($request->has('accepted_status') && $request->accepted_status != '') {
            $query = $query->where('accepted_status', $request->accepted_status);
        }

        $query = $query
            ->select('sales_requests.*')
            ->orderBy($orderby, $orderbytype)
            ->paginate($perPage, ['/*'], 'page', $page);

        $sales_requests = $query;

        return response()->json($sales_requests);
    }
    public function accept_sales_request(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:sales_requests,id',
            'accepted_status' => 'nullable|in:yes,no',
        ]);
        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        $accepted_status = 'yes';
        if ($request->has('accepted_status') && $request->accepted_status != '') {
            $accepted_status = $request->accepted_status;
        }

        SalesRequest::where('id', $request->id)->update([
            'accepted_status' => $accepted_status,
        ]);

        return response()->json([
            'message' => 'Sales Request updated successfully'
        ], 201);
    }
    public function sign_appointment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|array|exists:sales_request_appointments,id',
            'signature' => 'required|string',
        ]);
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $image = $request->signature;
        $image_parts = explode(";base64", $image);
        $image_type_aux = explode('image/', $image_parts[0]);
        $image_type = $image_type_aux[1];
        $file = base64_decode($image_parts[1]);
        $safeName = 'signed_' . time() . "." . $image_type;
        $success = file_put_contents(public_path('storage') . '/' . $safeName, $file);

        $signappointment_array = [];
        foreach ($request->id as $id) {
            $signappointment = SalesRequestAppointment::where('id', $id)->update([
                'signed' => 1,
                'date_signed' => date("Y-m-d H:i:s"),
                'signature' => $safeName,
            ]);
            array_push($signappointment_array, $signappointment);
        }
        $sendData = SalesRequestAppointment::join('listings', 'listings.id', '=', 'sales_request_appointments.listing_id')
                                            ->join('customers', 'customers.id', '=', 'listings.owner_id')
                                            ->where('sales_request_appointments.id', $id)->get();
        $sendData2 = SalesRequestAppointment::join('sales_requests', 'sales_requests.id', '=', 'sales_request_appointments.sales_request_id')
                                            ->join('customers', 'customers.id', '=', 'sales_requests.customer_id')
                                            ->where('sales_request_appointments.id', $id)->get();
        $sendData3 = SalesRequestAppointment::join('sales_requests', 'sales_requests.id', '=', 'sales_request_appointments.sales_request_id')
                                            ->join('sales_people', 'sales_people.id', '=', 'sales_requests.sales_people_id')
                                            ->join('customers', 'customers.id', '=', 'sales_people.customer_id')
                                            ->where('sales_request_appointments.id', $id)->get();
        
        $pdfData = [
            'signature' => public_path('storage/'.$safeName),
            'appointment_data' => $sendData[0]->date_signed,
            'request_date'  => $sendData[0]->date,
            'customer_name' => $sendData2[0]->name,
            'salesperson_name'=> $sendData3[0]->name
        ];

        $pdf = PDF::loadView('emails.templatePDF', $pdfData);

        $WebListingEmail = env("Web_Listing_Email");

        $data["email"]= $sendData[0]->email;
        $data["client_name"]= $sendData[0]->name;
        $data["subject"]="sign";
        $data["title"] = "Sign";
        $data["body"] = "The request signed.";

        Mail::send('emails.templateMail', $data, function($message)use($data,$pdf) {
            $message->to($data["email"], $data["client_name"])
            ->subject($data["subject"])
            ->attachData($pdf->output(), "sign.pdf");
        });

        return response()->json([
            'message' => 'Appointment updated successfully',
        ], 201);
    }
    public function update_sales_request(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:sales_requests,id',
            'name' => 'nullable|string',
            'date' => 'nullable|date',
            'customer_id' => 'required|integer|exists:customers,id',
            'source_id' => 'required|integer|exists:sources,id',
            'property_type_id' => 'required|integer|exists:property_types,id',
            'minimum_budget' => 'nullable|integer',
            'maximum_budget' => 'nullable|integer',
            'minimum_size' => 'nullable|integer',
            'maximum_size' => 'nullable|integer',
            'minimum_bedrooms' => 'nullable|integer',
            'minimum_bashrooms' => 'nullable|integer',
            'description' => 'nullable|string',
            'sales_request_districts' => 'nullable|array|exists:districts,id',
            'sales_request_listing_types' => 'nullable|array|exists:listing_types,id',
            'sales_request_locations' => 'nullable|array|exists:locations,id',
            'sales_request_municipalities' => 'nullable|array|exists:municipalities,id',
            'sales_request_feature' => 'nullable|array|exists:features,id',
        ]);
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        SalesRequest::where('id', $request->id)->update([
            // 'name' => $request->name,
            // 'date' => $request->date,
            'customer_id' => $request->customer_id,
            'source_id' => $request->source_id,
            'property_type_id' => $request->property_type_id,
            'minimum_budget' => $request->minimum_budget,
            'maximum_budget' => $request->maximum_budget,
            'minimum_size' => $request->minimum_size,
            'maximum_size' => $request->maximum_size,
            'minimum_bedrooms' => $request->minimum_bedrooms,
            'minimum_bathrooms' => $request->minimum_bashrooms,
            // 'description' => $request->description
        ]);

        SalesRequestDistrict::where('salesRequest_id', $request->id)->delete();
        SalesRequestMunicipality::where('salesRequest_id', $request->id)->delete();
        SalesRequestLocation::where('salesRequest_id', $request->id)->delete();
        SalesRequestListingType::where('sales_request_id', $request->id)->delete();
        FeatureSalesRequest::where('sales_request_id', $request->id)->delete();

        if ($request->has('sales_request_feature') && count($request->sales_request_feature) > 0) {
            foreach ($request->sales_request_feature as $featureid) {
                FeatureSalesRequest::create([
                    'sales_request_id' => $request->id,
                    'feature_id' => $featureid,
                ]);
            }
        }
        if ($request->has('sales_request_districts') && count($request->sales_request_districts) > 0) {
            foreach ($request->sales_request_districts as $districtid) {
                SalesRequestDistrict::create([
                    'salesRequest_id' => $request->id,
                    'district_id' => $districtid,
                ]);
            }
        }
        if ($request->has('sales_request_municipalities') && count($request->sales_request_municipalities) > 0) {
            foreach ($request->sales_request_municipalities as $municipalityid) {
                SalesRequestMunicipality::create([
                    'salesRequest_id' => $request->id,
                    'municipality_id' => $municipalityid,
                ]);
            }
        }
        if ($request->has('sales_request_locations') && count($request->sales_request_locations) > 0) {
            foreach ($request->sales_request_locations as $locationid) {
                SalesRequestLocation::create([
                    'salesRequest_id' => $request->id,
                    'location_id' => $locationid,
                ]);
            }
        }
        if ($request->has('sales_request_listing_types') && count($request->sales_request_listing_types) > 0) {
            foreach ($request->sales_request_listing_types as $listingtype) {
                SalesRequestListingType::create([
                    'sales_request_id' => $request->id,
                    'listing_type_id' => $listingtype,
                ]);
            }
        }

        return response()->json([
            'message' => 'Sales Request updated successfully'
        ], 201);
    }
    public function get_lost_reason(Request $request)
    {
        $query = SalesLostReason::orderBy('sales_lost_reasons.name', 'asc')
            ->paginate(1000);

        $result = $query;

        return response()->json($result);
    }
    public function get_note_type(Request $request)
    {
        $query = SalesRequestNoteType::orderBy('sales_request_note_types.name', 'asc')
            ->paginate(1000);

        $result = $query;

        return response()->json($result);
    }
}