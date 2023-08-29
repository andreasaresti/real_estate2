<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\SalesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CloseDealController extends Controller
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
}
