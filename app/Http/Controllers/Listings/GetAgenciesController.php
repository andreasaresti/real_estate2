<?php

namespace App\Http\Controllers\Listings;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GetAgenciesController extends Controller
{
    public function get_agencies(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'nullable|integer|exists:agencies,id',
            'perpage' => 'nullable|integer',
            'page' => 'nullable|integer',
        ]);

        $perPage = 20;
        if ($request->has('perpage') && $request->perpage != '') {
            $perPage = $request->perpage;
        }
        $page = 1;
        if ($request->has('page') && $request->page != '') {
            $page = $request->page;
        }

        $query = Agent::where('active', '=', 1);
       
        if ($request->has('id') && $request->id != '') {
            $query = $query->where('id', $request->id);
        }

        $query = $query
            ->select('*')
            ->orderBy('sort_order', 'asc')
            ->paginate($perPage, ['/*'], 'page', $page);
        
        foreach ($query as $key => $row) {            
            if($row->image != ''){
                $query[$key]->image = env('APP_IMG_URL') . '/storage/' . $row->image;
            }
            else{
                $query[$key]->image = '';
            }
            if($row->country != ''){
                $query_country = Country::where('code', $row->country)->first();
                $query[$key]->country = $query_country->name;

            }
            else{
                $query[$key]->country = '';

            }
        }

        $result = $query;

        return response()->json($result);
    }
    public function get_mapAgencies(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'agencies' => 'required|array',
        ]);
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        $result = array();
        $agencies =  $request->agencies;
        foreach ($agencies as $Agency_id) {
            
            $query = Agent::where('id', '=', $Agency_id)->first();;
        
            if($query->image != ''){
                $query->image = env('APP_IMG_URL') . '/storage/' . $query->image;
            }
            else{
                $query->image = '';
            }
            if($query->country != ''){
                $query_country = Country::where('code', $query->country)->first();
                $query->country = $query_country->name;

            }
            else{
                $query->country = '';
            }

            array_push($result, $query);

        }
        return response()->json($result);
    }
}
