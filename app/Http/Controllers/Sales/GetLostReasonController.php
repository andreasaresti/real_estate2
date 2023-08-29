<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\SalesLostReason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GetLostReasonController extends Controller
{
    public function get_lost_reason(Request $request)
    {
        $query = SalesLostReason::orderBy('sales_lost_reasons.name', 'asc')
            ->paginate(1000);

        $result = $query;

        return response()->json($result);
    }
}
