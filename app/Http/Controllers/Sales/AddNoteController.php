<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\SalesRequestNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddNoteController extends Controller
{
    public function add_note(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sales_request_id' => 'required|integer|exists:sales_requests,id',
            'sales_request_note_type_id' => 'required|integer|exists:sales_request_note_types,id',
            'description' => 'required|string'
        ]);
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $note = SalesRequestNote::create([
            'sales_request_id' => $request->sales_request_id,
            'sales_request_note_type_id' => $request->sales_request_note_type_id,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Note created successfully',
            'note' => $note,
        ], 201);
    }
}
