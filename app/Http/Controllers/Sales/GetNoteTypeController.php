<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\SalesRequestNoteType;
use Illuminate\Http\Request;

class GetNoteTypeController extends Controller
{
    public function get_note_type(Request $request)
    {
        $query = SalesRequestNoteType::orderBy('sales_request_note_types.name', 'asc')
            ->paginate(1000);

        $result = $query;

        return response()->json($result);
    }
}
