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
            ->orderBy('name', 'asc')
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
}
