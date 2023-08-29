<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\FeatureSalesRequest;
use App\Models\SalesRequest;
use App\Models\SalesRequestDistrict;
use App\Models\SalesRequestListingType;
use App\Models\SalesRequestLocation;
use App\Models\SalesRequestMunicipality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GetSalesRequestDetailsController extends Controller
{
    public function get_sales_request_detail(Request $request)
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

        $query = SalesRequest::where('id', $request->id);

        $query = $query
            ->select('sales_requests.*')
            ->first();

        $customer = Customer::where('id', $query->customer_id)->first();
        $query->customer_name = $customer->name;
        $query->customer_surname = $customer->surname;
        $query->customer_email = $customer->email;
        $query->customer_phone = $customer->phone;
        $query->customer_address = $customer->address;

        $resultDistricts = SalesRequestDistrict::where('salesRequest_id', $request->id)->get();
        $districts = array();
        foreach ($resultDistricts as $row) {
            array_push($districts, $row->district_id);
        }
        $query->districts = $districts;

        $resultMunicipalities = SalesRequestMunicipality::where('salesRequest_id', $request->id)->get();
        $Municipalities = array();
        foreach ($resultMunicipalities as $row) {
            array_push($Municipalities, $row->municipality_id);
        }
        $query->municipalities = $Municipalities;

        $resultLocations = SalesRequestLocation::where('salesRequest_id', $request->id)->get();
        $locations = array();
        foreach ($resultLocations as $row) {
            array_push($locations, $row->location_id);
        }
        $query->locations = $locations;

        $resultListingTypes = SalesRequestListingType::where('sales_request_id', $request->id)->get();
        $listingTypes = array();
        foreach ($resultListingTypes as $row) {
            array_push($listingTypes, $row->listing_type_id);
        }
        $query->listingTypes = $listingTypes;

        $resultfeatures = FeatureSalesRequest::where('sales_request_id', $request->id)->get();
        $features = array();
        foreach ($resultfeatures as $row) {
            array_push($features, $row->feature_id);
        }
        $query->features = $features;

        $sales_request_detail = $query;
        return response()->json($sales_request_detail);
    }
}
