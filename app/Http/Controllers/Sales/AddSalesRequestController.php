<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\SalesRequest;
use App\Models\SalesRequestDistrict;
use App\Models\SalesRequestListingType;
use App\Models\SalesRequestLocation;
use App\Models\SalesRequestMunicipality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddSalesRequestController extends Controller
{
    public function add_sales_request(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'date' => 'required|date',
            'customer_id' => 'required|integer|exists:customers,id',
            'source_id' => 'required|integer|exists:sources,id',
            'property_type_id' => 'required|integer|exists:property_types,id',
            'minimum_budget' => 'nullable|integer',
            'maximum_budget' => 'nullable|integer',
            'minimum_size' => 'nullable|integer',
            'maximum_size' => 'nullable|integer',
            'minimum_bedrooms' => 'nullable|integer',
            'minimum_bashrooms' => 'nullable|integer',
            'description' => 'nullable|string',
            'sales_request_districts' => 'nullable|array|exists:districts,id',
            'sales_request_listing_types' => 'nullable|array|exists:listing_types,id',
            'sales_request_locations' => 'nullable|array|exists:locations,id',
            'sales_request_municipalities' => 'nullable|array|exists:municipalities,id',
        ]);
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $salesRequest = SalesRequest::create([
            'name' => $request->name,
            'date' => $request->date,
            'customer_id' => $request->customer_id,
            'source_id' => $request->source_id,
            'property_type_id' => $request->property_type_id,
            'minimum_budget' => $request->minimum_budget,
            'maximum_budget' => $request->maximum_budget,
            'minimum_size' => $request->minumum_size,
            'maximum_size' => $request->maximum_size,
            'minimum_bedrooms' => $request->minimum_bedrooms,
            'minimum_bashrooms' => $request->minimum_bashrooms,
            'description' => $request->description
        ]);
        if ($request->has('sales_request_districts') && count($request->sales_request_districts) > 0) {
            foreach ($request->sales_request_districts as $districtid) {
                SalesRequestDistrict::create([
                    'salesRequest_id' => $salesRequest->id,
                    'district_id' => $districtid,
                ]);
            }
        }
        if ($request->has('sales_request_municipalities') && count($request->sales_request_municipalities) > 0) {
            foreach ($request->sales_request_municipalities as $municipalityid) {
                SalesRequestMunicipality::create([
                    'salesRequest_id' => $salesRequest->id,
                    'municipality_id' => $municipalityid,
                ]);
            }
        }
        if ($request->has('sales_request_locations') && count($request->sales_request_locations) > 0) {
            foreach ($request->sales_request_locations as $locationid) {
                SalesRequestLocation::create([
                    'salesRequest_id' => $salesRequest->id,
                    'location_id' => $locationid,
                ]);
            }
        }
        if ($request->has('sales_request_listing_types') && count($request->sales_request_listing_types) > 0) {
            foreach ($request->sales_request_listing_types as $listingtype) {
                SalesRequestListingType::create([
                    'sales_request_id' => $salesRequest->id,
                    'listing_type_id' => $listingtype,
                ]);
            }
        }


        return response()->json([
            'message' => 'Sales Request added successfully',
            'salesRequest' => $salesRequest,
        ], 201);
    }
}
