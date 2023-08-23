<?php

namespace App\Http\Controllers\Listings;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\District;
use App\Models\Listing;
use App\Models\Location;
use App\Models\Municipality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SaveListingPositionController extends Controller
{
    public function save_position(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required',
            'longitude' => 'required',
            'index' => 'required',
            'flag' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        }
        if($request->flag == "listings"){
            Listing::where('id',$request->index)->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
        }
        if($request->flag == "locations"){
            Location::where('id',$request->index)->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
        }
        if($request->flag == "agencies"){
            Agent::where('id',$request->index)->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
        }
        if($request->flag == "municipalities"){
            Municipality::where('id',$request->index)->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
        }
        if($request->flag == "districts"){
            District::where('id',$request->index)->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
        }
        

        return response()->json(['success' => 'Product created successfully.']);
    }
}
