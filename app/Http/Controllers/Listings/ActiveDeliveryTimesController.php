<?php

namespace App\Http\Controllers\Listings;

use App\Http\Controllers\Controller;
use App\Models\DeliveryTime;
use Illuminate\Http\Request;

class ActiveDeliveryTimesController extends Controller
{
    public function get_delivery_times(Request $request)
    {

        $query = DeliveryTime::select('delivery_times.*')
            ->orderBy('delivery_times.sequence', 'asc')
            ->distinct()
            ->paginate(1000);

        foreach ($query as $key => $row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
        }

        $result = $query;

        return response()->json($result);
    }
}
