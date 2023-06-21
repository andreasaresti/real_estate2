<?php

namespace App\Http\Controllers;

use App\Models\FavoriteProperty;
use App\Models\NovaMenuMenus;
use App\Models\NovaMenuMenuItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use ZipArchive;
use Config;

class FavoritePropertyController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()//: JsonResponse
    {
		
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($index)
    {
        session_start();
        if(!FavoriteProperty::where('customer_id', $_SESSION["user_id"])->where('listing_id', $index)->exists()){
            FavoriteProperty::insert(array('customer_id' =>  $_SESSION["user_id"], 'listing_id' => $index));
            return "ok";
        }else{
			FavoriteProperty::where('customer_id', $_SESSION["user_id"])->where('listing_id', $index)->delete();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $Menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $Menu)
    {
        //return view('Menu.view', ['Menu' => $Menu]);
        // return $Menu;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $Menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $Menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $Menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $Menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $Menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $Menu)
    {
        //
    }
}
