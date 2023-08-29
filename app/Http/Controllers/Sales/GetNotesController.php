<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\SalesRequestNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GetNotesController extends Controller
{
    public function get_notes(Request $request)
    {
        $perPage = 20;
        $page = 1;
        $orderby = 'sales_request_notes.id';
        $orderbytype = 'desc';

        $validator = Validator::make($request->all(), [
            'sales_request_id' => 'required|integer|exists:sales_requests,id',
            'sales_request_note_type_id' => 'nullable|integer|exists:sales_request_note_types,id',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $query = SalesRequestNote::where('sales_request_id', $request->sales_request_id);
        ;
        if ($request->has('sales_request_note_type_id') && $request->sales_request_note_type_id != '') {
            $query = $query->where('sales_request_note_type_id', $request->sales_request_note_type_id);
        }

        $query = $query
            ->select('sales_request_notes.*')
            ->orderBy($orderby, $orderbytype)
            ->paginate($perPage, ['/*'], 'page', $page);

        $sales_request_notes = $query;

        return response()->json($sales_request_notes);
    }
}
