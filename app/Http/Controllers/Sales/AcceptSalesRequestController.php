<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\SalesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AcceptSalesRequestController extends Controller
{
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
}
