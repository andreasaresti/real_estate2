<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\FeatureSalesRequest;
use App\Models\SalesRequest;
use App\Models\SalesRequestDistrict;
use App\Models\SalesRequestListingType;
use App\Models\SalesRequestLocation;
use App\Models\SalesRequestMunicipality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateSalesRequestController extends Controller
{
    public function update_sales_request(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:sales_requests,id',
            'name' => 'nullable|string',
            'date' => 'nullable|date',
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
            'sales_request_feature' => 'nullable|array|exists:features,id',
        ]);
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        SalesRequest::where('id', $request->id)->update([
            // 'name' => $request->name,
            // 'date' => $request->date,
            'customer_id' => $request->customer_id,
            'source_id' => $request->source_id,
            'property_type_id' => $request->property_type_id,
            'minimum_budget' => $request->minimum_budget,
            'maximum_budget' => $request->maximum_budget,
            'minimum_size' => $request->minimum_size,
            'maximum_size' => $request->maximum_size,
            'minimum_bedrooms' => $request->minimum_bedrooms,
            'minimum_bathrooms' => $request->minimum_bashrooms,
            // 'description' => $request->description
        ]);

        SalesRequestDistrict::where('salesRequest_id', $request->id)->delete();
        SalesRequestMunicipality::where('salesRequest_id', $request->id)->delete();
        SalesRequestLocation::where('salesRequest_id', $request->id)->delete();
        SalesRequestListingType::where('sales_request_id', $request->id)->delete();
        FeatureSalesRequest::where('sales_request_id', $request->id)->delete();

        if ($request->has('sales_request_feature') && count($request->sales_request_feature) > 0) {
            foreach ($request->sales_request_feature as $featureid) {
                FeatureSalesRequest::create([
                    'sales_request_id' => $request->id,
                    'feature_id' => $featureid,
                ]);
            }
        }
        if ($request->has('sales_request_districts') && count($request->sales_request_districts) > 0) {
            foreach ($request->sales_request_districts as $districtid) {
                SalesRequestDistrict::create([
                    'salesRequest_id' => $request->id,
                    'district_id' => $districtid,
                ]);
            }
        }
        if ($request->has('sales_request_municipalities') && count($request->sales_request_municipalities) > 0) {
            foreach ($request->sales_request_municipalities as $municipalityid) {
                SalesRequestMunicipality::create([
                    'salesRequest_id' => $request->id,
                    'municipality_id' => $municipalityid,
                ]);
            }
        }
        if ($request->has('sales_request_locations') && count($request->sales_request_locations) > 0) {
            foreach ($request->sales_request_locations as $locationid) {
                SalesRequestLocation::create([
                    'salesRequest_id' => $request->id,
                    'location_id' => $locationid,
                ]);
            }
        }
        if ($request->has('sales_request_listing_types') && count($request->sales_request_listing_types) > 0) {
            foreach ($request->sales_request_listing_types as $listingtype) {
                SalesRequestListingType::create([
                    'sales_request_id' => $request->id,
                    'listing_type_id' => $listingtype,
                ]);
            }
        }

        return response()->json([
            'message' => 'Sales Request updated successfully'
        ], 201);
    }
}
