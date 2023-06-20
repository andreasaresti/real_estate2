<?php

namespace App\Http\Controllers;

use App\Models\NovaMenuMenus;
use App\Models\NovaMenuMenuItems;
use Illuminate\Http\Request;



class FeatureController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()//: JsonResponse
    {
		//$menu = json_encode(NovaMenuMenus::orderBy('id', 'desc')->get());
		//$menu = json_encode(NovaMenuMenuItems::orderBy('id', 'desc')->get());
		$list = \DB::select('SELECT * from features');
		$result = array();
		for($i=0;$i<count($list);$i++){
			array_push($result,["id"=> $list[$i]->id,"name"=> $list[$i]->name]);
		}
		return response()->json($result);
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
