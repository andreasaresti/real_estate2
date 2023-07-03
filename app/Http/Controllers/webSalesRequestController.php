<?php

namespace App\Http\Controllers;

use App\Models\SalesRequestNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class webSalesRequestController extends Controller
{
    public function close_deal(Request $request)
    {
        // $this->authorize('create', Customer::class);
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'status' => 'required|in:won,lost',
            'listing_id' => 'nullable|integer|required_if:status,won|exists:sales_request_listings,id',
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

        if (
            $request->has('id') &&
            $request->id != '' &&
            $request->has('status') &&
            $request->status != '' &&
            $request->has('listing_id') &&
            $request->listing_id != '' &&
            $request->has('agreement_price') &&
            $request->agreement_price != '' &&
            $request->has('sales_lost_reason_id') &&
            $request->sales_lost_reason_id != ''
        ) {
            // if ($request->status == "won") {
            $query = $query
                ->where('id', $request->id)
                ->where('listing_id', $request->listing_id)
                ->where('agreement_price', $request->agreement_price)
                ->where('sales_lost_reason_id', $request->sales_lost_reason_id);
        }

        if ($query) {
            $query = $query
                ->select('sales_requests.*')
                ->orderBy($orderby, $orderbytype)
                ->paginate($perPage, ['/*'], 'page', $page);
        } else {
            $query = "No data";
        }

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
            'sales_request_id' => 'required'
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $query = DB::table('sales_request_notes');

        if (
            $request->has('sales_request_id') &&
            $request->sales_request_id != '' &&
            $request->has('sales_request_note_type_id') &&
            $request->sales_request_note_type_id != ''
        ) {
            $query = $query
                ->where('sales_request_id', $request->sales_request_id)
                ->where('sales_request_note_type_id', $request->sales_request_note_type_id);
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
    }
    public function get_appointments(Request $request)
    {
    }
    public function get_listings(Request $request)
    {
    }
    public function add_listing(Request $request)
    {
    }
    public function change_listing_type(Request $request)
    {
    }
    public function add_sales_request(Request $request)
    {
    }
    public function get_sales_request(Request $request)
    {
    }
    public function accept_sales_request(Request $request)
    {
    }
    public function sign_appointment(Request $request)
    {
    }
    public function update_sales_request(Request $request)
    {
    }
}