<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\ShoppingCart;
use App\Models\WishList;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Colour;
use App\Models\FavoriteProperty;
use App\Models\Listing;
use App\Models\SalesPeople;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class webUsersController extends Controller
{
    public function remind_password(Request $request)
    {
        echo 'remind password';
    }
    public function create_user(Request $request)
    {
        session_start();
        // $this->authorize('create', Customer::class);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        // Create a new user
        $user = Customer::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'company_name' => $request->company_name,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'city' => $request->city,
            'district' => $request->district,
            'country' => $request->country,
            'notes' => $request->notes,
        ]);

        $_SESSION["email"] = $request->email;
        $_SESSION["name"] = $request->name.' '.$request->surname;
        $_SESSION["user_id"] = $user->id;
        $_SESSION["user_image"] = '';
        $_SESSION["user_role"] = "";

        // You can customize the response as per your needs
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], 201);
    }
    public function update_user(Request $request)
    {
        session_start();
        // $this->authorize('create', Customer::class);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'id' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('customers')->where(function ($query) use ($request){
                    // Exclude rows with a specific condition
                    $query->where('id', '!=', $request->id);
                }),
            ],
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        // Create a new user
        $user = Customer::where('id', $request->id)->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'company_name' => $request->company_name,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'city' => $request->city,
            'district' => $request->district,
            'country' => $request->country,
            'notes' => $request->notes,
        ]);

        $_SESSION["email"] = $request->email;
        $_SESSION["name"] = $request->name.' '.$request->surname;
        $_SESSION["user_id"] = $request->id;
        $_SESSION["user_image"] = '';
        $_SESSION["user_role"] = "";

        // You can customize the response as per your needs
        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
        ], 201);
    }
    public function changepassword_user(Request $request)
    {
        session_start();
        // $this->authorize('create', Customer::class);
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'id' => 'required'
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        // Create a new user
        $user = Customer::where('id', $request->id)->update([
            'password' => bcrypt($request->password),
        ]);

        // You can customize the response as per your needs
        return response()->json([
            'message' => 'Password updated successfully',
            'user' => $user,
        ], 201);
    }
    public function login_user(Request $request)
    {
        session_start();
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $customer = Customer::where('email', $request->email)->first();
        if (Hash::check($request->password, $customer->password)) {
            // The hashed value matches the input
            // Perform additional logic or return a success response

            

            $_SESSION["email"] = $customer->email;
            $_SESSION["name"] = $customer->name;
            $_SESSION["user_id"] = $customer->id;
            $_SESSION["user_image"] = $customer->image;

            $sales_people = SalesPeople::where('customer_id', $customer->id)
                                ->first();
            if ($sales_people !== null) {
                $_SESSION["user_role"] = "sales_people";
                $_SESSION["sales_person_id"] = $sales_people->id;
            }
            else{
                $_SESSION["user_role"] = "";
            }

            return response()->json([
                'status' => true,
                'message' => 'User logged in successfully',
                'user' => $customer,
            ], 201);
        } 
        
        // Authentication failed
        return response()->json([
            'status' => false,
            'message' => 'Invalid login credentials',
        ], 401);
    }
    public function logout_user(Request $request){
        session_start();
        unset($_SESSION["email"]);
        unset($_SESSION["name"]);
        unset($_SESSION["user_id"]);
        unset($_SESSION["user_image"]);
        unset($_SESSION["user_role"]);
        unset($_SESSION["sales_person_id"]);

        return response()->json([
            'status' => true,
            'message' => 'User logged out successfully'
        ], 201);

    }
    public function get_users(Request $request)
    {
        // $this->authorize('view-any', Customer::class);

        $perPage = 20;
        $page = 1;
        $orderby = 'customers.id';
        $orderbytype = 'desc';

        if ($request->has('page') && is_numeric($request->page)) {
            $page = $request->page;
        }
        if ($request->has('per_page') && is_numeric($request->per_page)) {
            $perPage = $request->per_page;
        }

        $query = DB::table('customers');

        if ($request->has('id') && $request->id != '') {
            $query = $query->where('id', $request->id);
        }

        $query = $query
                    ->select('customers.*')                
                    ->orderBy($orderby, $orderbytype)
                    ->paginate($perPage, ['/*'], 'page', $page);
        foreach ($query as $key=>$row) {
            unset($query[$key]->password);
        }
        $customers = $query; 

        return response()->json($customers);

    }
    public function add_remove_to_favorites(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => [
                'required','integer',
                Rule::exists('customers', 'id'),
            ],
            'listing_id' => [
                'required','integer',
                Rule::exists('listings', 'id'),
            ]
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        $existingModel = FavoriteProperty::where('listing_id', $request->listing_id)
                                    ->where('customer_id', $request->customer_id)
                                    ->first();
        if ($existingModel) {
                $existingModel->delete();
        } 
        else {
            FavoriteProperty::create([
                                'customer_id' => $request->customer_id, 
                                'listing_id' => $request->listing_id
                            ]);
        }

        return response()->json([
            'message' => 'Favorite Listing updated successfully'
        ], 201);
    }
}
