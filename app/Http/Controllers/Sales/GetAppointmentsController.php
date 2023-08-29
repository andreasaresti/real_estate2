<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\SalesRequestAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GetAppointmentsController extends Controller
{
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
                $query[$key]->image = env('APP_IMG_URL') . '/storage/' . $listing->image;
            }

        }
        $sales_request_appointments = $query;
        return response()->json($sales_request_appointments);
    }
}
