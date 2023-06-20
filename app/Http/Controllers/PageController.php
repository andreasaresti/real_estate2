<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
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

	public function get($url)
    {
		$result = array();
        $temp = \DB::select('SELECT l.id AS layout_id, l.name AS name, p.id as id FROM pages p JOIN layouts l ON l.id=p.layout_id WHERE p.slug = "'.$url.'"');
        $layout = $temp[0]->layout_id;
        $parent_id = $temp[0]->id;
        if($layout == 1){
            $pages = \DB::select('SELECT DISTINCT m.id AS folder , m.file_name AS file_name, p.title as title, p.description as description, p.image as image  FROM pages p JOIN media m ON m.model_id=p.id WHERE m.model_type LIKE "%page%" AND p.slug = "'.$url.'"');	
			if(!count($pages)){
				$pages = \DB::select('SELECT DISTINCT  p.title as title, p.description as description, p.image as image  FROM pages p WHERE  p.slug = "'.$url.'"');	
				if(count($pages)){
					array_push($result,["layout" =>  "details" ,"file_name"=> "","folder"=> "","title"=> json_decode($pages[0]->title),"description"=> json_decode($pages[0]->description),"image"=>$pages[0]->image]);
				}
			}else{
				array_push($result,["layout" =>  "details" ,"file_name"=> $pages[0]->file_name,"folder"=> $pages[0]->folder,"title"=> json_decode($pages[0]->title),"description"=> json_decode($pages[0]->description),"image"=>$pages[0]->image]);
			}
        }else{
            $pages = \DB::select('SELECT * FROM pages WHERE  parent_page_id = "'.$parent_id.'"');	
            for($i=0;$i<count($pages);$i++){
                array_push($result,["layout" => "navigation", "slug"=> $pages[$i]->slug ,"title"=> json_decode($pages[$i]->title),"description"=> json_decode($pages[$i]->description),"image"=>$pages[$i]->image]);
            }
            
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
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }
}
