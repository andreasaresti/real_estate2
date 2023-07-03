<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
    }
    public function add_note(Request $request)
    {
    }
    public function get_notes(Request $request)
    {
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
