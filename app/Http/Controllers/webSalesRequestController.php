<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\SalesRequestNote;
use App\Models\SalesRequestListing;
use App\Models\SalesRequest;
use App\Models\SalesRequestAppointment;
use App\Models\SalesRequestDistrict;
use App\Models\SalesRequestListingType;
use App\Models\SalesRequestLocation;
use App\Models\SalesRequestMunicipality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\ResponsiveImages\ResponsiveImage;

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
        foreach ($request->sales_requests as $sales_request_id) {
            $validator = Validator::make($request->all(), [
                'sales_requests' => 'required|array|exists:sales_requests,id',
                'listing_id' => 'required|integer|exists:listings,id',
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

        foreach ($request->sales_requests as $sales_request_id) {
            $appointment = SalesRequestAppointment::create([
                'sales_request_id' => $sales_request_id,
                'listing_id' => $request->listing_id,
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
        return response()->json([
            'message' => 'Appointment updated successfully',
        ], 201);
    }
    public function update_sales_request(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:sales_requests,id',
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

        SalesRequest::where('id', $request->id)->update([
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

        SalesRequestDistrict::where('salesRequest_id', $request->id)->delete();
        SalesRequestMunicipality::where('salesRequest_id', $request->id)->delete();
        SalesRequestLocation::where('salesRequest_id', $request->id)->delete();
        SalesRequestListingType::where('sales_request_id', $request->id)->delete();

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
}