<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\SalesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GetSalesRequestController extends Controller
{
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
}
