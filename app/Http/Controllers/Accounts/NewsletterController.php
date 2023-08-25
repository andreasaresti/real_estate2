<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function register_unregister_newsletter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string',
            'surname' => 'nullable|string',
            'email' => 'required|email',
            'active' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = [];
        if($request->has('name')){
            $data['name'] = $request->name;
        }
        if($request->has('surname')){
            $data['surname'] = $request->surname;
        }
        $data['email'] = $request->email;
        $data['active'] = $request->active;

        $email = Newsletter::where('email', $request->email)->first();
        if($email){
            Newsletter::where('email', $request->email)->update($data);
        }
        else{
            Newsletter::create($data);
        }
        return response()->json(['success' => 'User Newsletter Preferences added.']);
    }
    
}
