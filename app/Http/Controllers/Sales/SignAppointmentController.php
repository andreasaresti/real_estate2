<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\SalesRequestAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;
use App\Mail\SendMail;
use Spatie\MediaLibrary\ResponsiveImages\ResponsiveImage;
use PDF;

class SignAppointmentController extends Controller
{
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
}
