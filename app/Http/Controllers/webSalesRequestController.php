<?php

namespace App\Http\Controllers;

use App\Models\SalesRequestNote;
use App\Models\SalesRequestListing;
use App\Models\SalesRequest;
use App\Models\SalesRequestAppointment;
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
            'id' => 'required|integer',
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

        $perPage = 20;
        $page = 1;
        $orderby = 'sales_requests.id';
        $orderbytype = 'desc';

        $query = DB::table('sales_requests');

        $query = $query
            ->where('id', $request->id)
            ->where('listing_id', $request->listing_id)
            ->where('agreement_price', $request->agreement_price)
            ->where('sales_lost_reason_id', $request->sales_lost_reason_id);

        $query = $query
            ->select('sales_requests.*')
            ->orderBy($orderby, $orderbytype)
            ->paginate($perPage, ['/*'], 'page', $page);
        $sales_requests = $query;
        return response()->json($sales_requests);
    }
    public function add_note(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sales_request_id' => 'required|integer|exists:sales_requests,id|unique:sales_request_notes',
            'sales_request_note_type_id' => 'required|integer|exists:sales_request_note_types,id|unique:sales_request_notes',
            'description' => 'required | string'
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

        $query = DB::table('sales_request_notes');

        $query = $query
            ->where('sales_request_id', $request->sales_request_id)
            ->where('sales_request_note_type_id', $request->sales_request_note_type_id);

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
            'listing_id' => 'required|integer|exists:listings,id',
            'status' => 'required|string',
            'signed' => 'required|integer',
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

        $query = DB::table('sales_request_appointments');

        $query = $query
            ->where('listing_id', $request->listing_id)
            ->where('status', $request->status)
            ->where('signed', $request->signed);

        $query = $query
            ->select('sales_request_appointments.*')
            ->orderBy($orderby, $orderbytype)
            ->paginate($perPage, ['/*'], 'page', $page);
        $sales_request_appointments = $query;
        return response()->json($sales_request_appointments);
    }
    public function get_listings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sales_request_id' => 'required|integer|exists:sales_requests,id',
            'listing_id' => 'required|integer|exists:listings,id',
            'status' => 'required|string',
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

        $query = DB::table('sales_request_listings');

        $query = $query
            ->where('sales_request_id', $request->sales_request_id)
            ->where('listing_id', $request->listing_id)
            ->where('status', $request->status)
            ->where('emailed', $request->emailed)
            ->where('active', $request->active);

        $query = $query
            ->select('sales_request_listings.*')
            ->orderBy($orderby, $orderbytype)
            ->paginate($perPage, ['/*'], 'page', $page);
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

        $list = SalesRequestListing::create([
            'sales_request_id' => $request->sales_request_id,
            'listing_id' => $request->listing_id,
        ]);

        return response()->json([
            'message' => 'Note created successfully',
            'list' => $list,
        ], 201);
    }
    public function change_listing_type(Request $request)
    {
    }
    // public function add_sales_request(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string',
    //         'date' => 'required|date',
    //         'customer_id' => 'required|integer|exists:customers,id',
    //         'source_id' => 'required|integer|exists:sources,id',
    //         'property_type_id' => 'required|integer|exists:property_types,id',
    //         'minimum_budget' => 'nullable|integer',
    //         'maximum_budget' => 'nullable|integer',
    //         'minimum_size' => 'nullable|integer',
    //         'maximum_size' => 'nullable|integer',
    //         'minimum_bedrooms' => 'nullable|integer',
    //         'maximum_bedrooms' => 'nullable|integer',
    //         'description' => 'nullable|string',
    //         'sales_request_districts' => 'nullable|array|exists:districts,id',
    //         'sales_request_listing_types' => 'nullable|array|exists:listing_types,id',
    //         'sales_request_locations' => 'nullable|array|exists:locations,id',
    //         'sales_request_municipalities' => 'nullable|array|exists:municipalities,id',
    //     ]);
    //     if ($validator->fails()) {
    //         // Return the validation errors
    //         return response()->json([
    //             'errors' => $validator->errors(),
    //         ], 422);
    //     }

    //     $salesRequest = SalesRequest::create([
    //         'name' => $request->name,
    //         'date' => $request->date,
    //         'customer_id' => $request->customer_id,
    //         'source_id' => $request->source_id,
    //         'property_type_id' => $request->property_type_id,
    //         'minimum_budget' => $request->minimum_budget,
    //         'maximum_budget' => $request->maximum_budget,
    //         'minimum_size' => $request->minimum_size,
    //         'maximum_size' => $request->maximum_size,
    //         'minimum_bedrooms' => $request->minimum_bedrooms,
    //         'maximum_bedrooms' => $request->maximum_bedrooms,
    //         'description' => $request->description,
    //     ]);

    //     return response()->json([
    //         'message' => 'SalesRequest created successfully',
    //         'salesRequest' => $salesRequest,
    //     ]);
    // }
    public function get_sales_request(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string',
            'accepted_status' => 'required|string',
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

        $query = DB::table('sales_requests');

        $query = $query
            ->where('status', $request->status)
            ->where('accepted_status', $request->accepted_status)
            ->where('sales_people_id', $request->sales_people_id);

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

        $query = DB::table('sales_requests');

        $query = $query
            ->where('id', $request->id);
        $query = $query
            ->select('sales_requests.*')
            ->orderBy($orderby, $orderbytype)
            ->paginate($perPage, ['/*'], 'page', $page);

        $accept_sales_request = $query;
        return response()->json($accept_sales_request);
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

        $signappointment_array = [];
        foreach ($request->id as $id) {
            $signappointment = SalesRequestAppointment::where('id', $id)->update([
                'signature' => $request->signature,
            ]);
            array_push($signappointment_array, $signappointment);
        }
        return response()->json([
            'message' => 'Appointment updated successfully',
            'appointment' => $signappointment_array,
        ]);
    }
    public function update_sales_request(Request $request)
    {
    }
}