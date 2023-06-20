<?php

namespace App\Http\Controllers;

use App\Models\NovaMenuMenus;
use App\Models\NovaMenuMenuItems;
use Illuminate\Http\Request;



class MenuController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function getMenu($menu_id, $parent_id)
	{
		$result = array();
		$submenu = \DB::select('SELECT * from nova_menu_menu_items where  menu_id = ? and parent_id = ? order by "order" desc',[$menu_id, $parent_id]);
		if(count($submenu)>0){
			for($j=0;$j<count($submenu);$j++){
				$tt = MenuController::getMenu($menu_id, $submenu[$j]->id);
				array_push($result,["name"=> $submenu[$j]->name,"url"=>$submenu[$j]->value,"sub"=> $tt]);
			}
		}
		return $result;
	}

    public function index()//: JsonResponse
    {
		//$menu = json_encode(NovaMenuMenus::orderBy('id', 'desc')->get());
		//$menu = json_encode(NovaMenuMenuItems::orderBy('id', 'desc')->get());
		$menu = \DB::select('SELECT * from nova_menu_menus');
		$result = array();
		for($i=0;$i<count($menu);$i++){
			$submenu = \DB::select('SELECT * from nova_menu_menu_items where menu_id = ? order by "order" desc',[$menu[$i]->id]);
			$temp = array();
			for($j=0;$j<count($submenu);$j++){
				if(!($submenu[$j]->parent_id)){
					$tt = MenuController::getMenu($menu[$i]->id, $submenu[$j]->id);
					array_push($temp,["name"=> $submenu[$j]->name,"url"=>$submenu[$j]->value,"sub"=> $tt]);
				}
			}
			array_push($result,["name"=> $menu[$i]->slug,"url"=>"","sub"=> $temp]);
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
