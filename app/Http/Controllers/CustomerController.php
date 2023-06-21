<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\SalesPeople;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

	public function get(Request $request)
    {
		$data = $request;

        session_start();

        $result = Customer::where('email', '=', $data['email'])
                                ->where('password', md5($data['password']))
                                ->first();
        if ($result === null) {
            return "fail";            
        }
        else{
            $result2 = DB::table('customers')->where('password', md5($data['password']))->where('email', $data['email'])->orderBy('created_at', 'desc')->first();
            if ($result2 === null) {
                return "fail";                
            }
            
            $_SESSION["email"] = $result->email;
            $_SESSION["name"] = $result->name;
            $_SESSION["user_id"] = $result->id;
            $_SESSION["user_image"]= $result->image;

            $sales_people = SalesPeople::where('customer_id', $result->id)
                                ->first();
            if ($sales_people !== null) {
                $_SESSION["user_role"]= "sales_people";
                $_SESSION["sales_person_id"]= $sales_people->id;
            }else{
                $_SESSION["user_role"]= "";
            }
			return response()->json([
                                        "id" => $result->id,
                                        "name" => $result->name,
                                        "email" => $result->email,
                                        "address" => $result->address,
                                        "phone" => $result->phone,
                                        "city" => $result->city
                                    ]);
        }
	}
    public function update(Request $request)
    {
        session_start();
		$data = $request;
		$temp = DB::table('customers') ->where('email', $_SESSION["email"]) ->limit(1) 
            ->update( [ 
                        'address' => $data['address'],  
                        'company_name' => $data['company_name'],
                        'country' => $data['country'],
                        'district' => $data['district'],
                        'city' => $data['city'],
                        'email' => $data['email'],
                        'mobile' => $data['mobile'],
                        'notes' => $data['notes'],
                        'phone' => $data['phone'],
                        'postal_code' => $data['postal_code'],
                        'name' => $data['name']
                    ]);
        return "ok";
	}
    public function get_details(Request $request)
    {
        session_start();
		$data = $request->data;
		if(DB::table('customers')->where('email', $data['email'])->exists()){
			$result = DB::table('customers')->where('email', $data['email'])->orderBy('created_at', 'desc')->first();
			return response()->json([
                                        "name" => $result->name,
                                        "email" => $result->email,
                                        "role" => $result->role_id,
                                        "address" => $result->address,
                                        "phone" => $result->phone,
                                        "city" => $result->city
                                    ]);
		}
        else{
			return "fail";
		}
	}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        session_start();
		$cur_date = date('Y-m-d H:i:s');
        $data = $request;
        $user = Customer::where('email', '=', $data['email'])->first();
        if ($user === null) {
		//if(DB::table('customers')->where('email', $data['email'])->exists() == false){
			DB::table('customers')->insert(array('name' =>  $data['name'], 'email' => $data['email'], 'phone' => '', 'password' => md5($data['password']), 'created_at'=>$cur_date , 'type'=>""));
			return "ok";
		}else{
			return "fail";
		}
    }
    public function store_details(Request $request)
    {
        session_start();
		$cur_date = date('Y-m-d H:i:s');
        $data = $request->data;
        if($data['password']!==""){
            DB::table('customers')->where('email' ,  $data['b_email'])->update(array(
                                                                                    'email' =>  $data['email'],
                                                                                    'name' =>  $data['name'], 
                                                                                    'city' => $data['city'], 
                                                                                    'phone' =>  $data['phone'], 
                                                                                    'password' => md5($data['password']), 
                                                                                    'created_at'=>$cur_date , 
                                                                                    'address'=>$data['address']
                                                                                ));
        }
        else{
            DB::table('customers')->where('email' ,  $data['b_email'])->update(array(
                                                                                        'email' =>  $data['email'],
                                                                                        'name' =>  $data['name'], 
                                                                                        'city' => $data['city'], 
                                                                                        'phone' =>  $data['phone'], 
                                                                                        'created_at'=>$cur_date , 
                                                                                        'address'=>$data['address']));
        }
        return "ok";
    }

    public function logout()
    {
        session_start();
        unset($_SESSION["email"]);
        unset($_SESSION["name"]);
        unset($_SESSION["user_id"]);
        unset($_SESSION["user_image"]);
        return "ok";
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
