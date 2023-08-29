<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\SalesRequestAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class AddAppointmentController extends Controller
{
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
}
