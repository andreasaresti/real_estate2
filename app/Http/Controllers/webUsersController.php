<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\ShoppingCart;
use App\Models\WishList;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Colour;
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
        // $this->authorize('create', Customer::class);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:8',
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

        // You can customize the response as per your needs
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], 201);
    }
    public function update_user(Request $request)
    {
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

        // You can customize the response as per your needs
        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
        ], 201);
    }
    public function changepassword_user(Request $request)
    {
        // $this->authorize('create', Customer::class);
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8',
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
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
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

            session_start();

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

        $customers = $query; 

        return response()->json($customers);

    }
    public function get_wish_list(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => [
                'required','integer',
                Rule::exists('customers', 'id'),
            ]
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $query = DB::table('wish_lists')
                ->where('customer_id', $request->customer_id)
                ->paginate(1000);

        foreach ($query as $key=>$row) {

            $product = Product::where('id', $row->product_id)->first();

            $productData = $product;

            // $name_array =json_decode($product->name);
            // $productData->productName = isset($name_array->en)?$name_array->en:'';

            $productData->productName = $product->name;
            $query[$key]->product = $productData;

            $post = Product::with('media')->find($row->product_id);
            $media = $post->media;
            $images_array = [];
            foreach ($media as $m) {
                $images_array[] = env('APP_URL').'/storage/'.$m->id.'/'.$m->file_name;
            }
            $query[$key]->images = $images_array;

        }
        $wishlist = $query;

        return response()->json($wishlist);
    }
    
    public function add_remove_to_wish_list(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => [
                'required','integer',
                Rule::exists('customers', 'id'),
            ],
            'product_id' => [
                'required','integer',
                Rule::exists('products', 'id'),
            ],
            'action' => 'required|in:add,remove'
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        $existingModel = WishList::where('product_id', $request->product_id)
                                    ->where('customer_id', $request->customer_id)
                                    ->first();

        if($request->action == 'add'){
            $quantity = $request->quantity;
        }
        else if($request->action == 'remove'){
            $quantity = (-1) * $request->quantity;
        }

        if ($existingModel) {
            // If the model exists, increment the desired field by 1
            if($request->action == 'remove'){
                $existingModel->delete();
            }
        } 
        else {
            if($request->action == 'add'){
                WishList::create([
                                    'customer_id' => $request->customer_id, 
                                    'product_id' => $request->product_id
                                ]);
            }
        }

        return response()->json([
            'message' => 'Wish list updated successfully'
        ], 201);
    }
    public function remove_cart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cart_id' => [
                'required','integer',
                Rule::exists('shopping_carts', 'id'),
            ]
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        
        $existingModel = ShoppingCart::where('id', $request->cart_id)
        ->first();

        if ($existingModel) {
            $existingModel->delete();
        } 

        return response()->json([
            'message' => 'Cart list removed successfully'
        ], 201);
    }
    public function update_cart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cart_id' => [
                'required','integer',
                Rule::exists('shopping_carts', 'id'),
            ],
            'quantity' => 'required|integer|min:1'
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        
        $existingModel = ShoppingCart::where('id', $request->cart_id)
        ->first();

        if ($existingModel) {
            $existingModel->update(['quantity' => $request->quantity]);
        } 

        return response()->json([
            'message' => 'Cart list updated successfully'
        ], 201);
    }
    public function get_cart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => [
                'required','integer',
                Rule::exists('customers', 'id'),
            ]
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $query = DB::table('shopping_carts')
                ->where('customer_id', $request->customer_id)
                ->paginate(1000);

        foreach ($query as $key=>$row) {

            $product = Product::where('id', $row->product_id)->first();

            $productData = $product;

            // $name_array =json_decode($product->name);
            // $productData->productName = isset($name_array->en)?$name_array->en:'';

            $productData->productName = $product->name;
            $query[$key]->product = $productData;

            $post = Product::with('media')->find($row->product_id);
            $media = $post->media;
            $images_array = [];
            foreach ($media as $m) {
                $images_array[] = env('APP_URL').'/storage/'.$m->id.'/'.$m->file_name;
            }
            $query[$key]->images = $images_array;

            $variant = ProductVariant::where('id', $row->product_variant_id)->first();

            $variants_array = $variant;

            $variant->color_name = '';
            if($variant->colour_id != ''){
                $colour = Colour::find($variant->colour_id);
                $variants_array->color_name = $colour->name;
                $variants_array->color_code = $colour->colour_code;
            }
            $variant->size_name = '';
            if($variant->size_id != ''){
                $size = Size::find($variant->size_id);
                $variants_array->size_name = $size->name;
            }

            $query[$key]->variants = $variants_array;

        }

        $cart = $query;

        return response()->json($cart);
    }
    public function add_remove_to_cart(Request $request)
    {        
        $validator = Validator::make($request->all(), [
            'customer_id' => [
                'required','integer',
                Rule::exists('customers', 'id'),
            ],
            'product_id' => [
                'required','integer',
                Rule::exists('products', 'id'),
            ],
            'product_variant_id' => [
                'nullable','integer',
                Rule::exists('product_variants', 'id'),
            ],
            'quantity' => 'required|integer|min:1',
            'action' => 'required|in:add,remove'
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        $existingModel = ShoppingCart::where('product_id', $request->product_id)
                                    ->where('customer_id', $request->customer_id)
                                    ->where('product_variant_id', $request->product_variant_id)
                                    ->first();

        if($request->action == 'add'){
            $quantity = $request->quantity;
        }
        else if($request->action == 'remove'){
            $quantity = (-1) * $request->quantity;
        }

        if ($existingModel) {
            // If the model exists, increment the desired field by 1
            $existingModel->update(['quantity' => $existingModel->quantity + $quantity]);
        } 
        else {
            // If the model doesn't exist, create a new one with the desired field set to 1
            ShoppingCart::create([
                                'customer_id' => $request->customer_id, 
                                'product_id' => $request->product_id, 
                                'product_variant_id' => $request->product_variant_id,
                                'quantity' => $quantity
                            ]);
        }
        ShoppingCart::where('quantity', '<=', 0)->delete();

        return response()->json([
            'message' => 'Shopping Cart updated successfully'
        ], 201);
    }
}
