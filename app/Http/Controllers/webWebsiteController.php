<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Blog;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Nova\Menu\MenuItem as MenuMenuItem;
use Outl1ne\MenuBuilder\Models\MenuItem;

class webWebsiteController extends Controller
{
    public function get_menu(Request $request)
    {
        // $this->authorize('create', Customer::class);
        $validator = Validator::make($request->all(), [
            'slug' => 'required',
            'parent_id' => 'nullable|integer',
            'locale' => 'required'
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $query = DB::table('nova_menu_menu_items')
                    ->join('nova_menu_menus', 'nova_menu_menu_items.menu_id', '=', 'nova_menu_menus.id')
                    ->where('nova_menu_menus.slug', $request->slug)
                    ->where('nova_menu_menu_items.locale', $request->locale)
                    ->where('nova_menu_menu_items.enabled', true);

        if ($request->has('parent_id') && $request->parent_id != '') {
            $query = $query->where('nova_menu_menu_items.parent_id', $request->parent_id);
        }

        $query = $query
                    ->select('nova_menu_menu_items.*')
                    ->orderBy('order', 'asc')->get();
        $menus = $query; 

        return response()->json($menus);
    }
    public function get_languages(Request $request)
    {       

        $query = Language::orderBy('sequence', 'asc')->orderBy('id', 'asc')->get();
        $languages = $query; 

        return response()->json($languages);
    }
    public function get_banner(Request $request)
    {
        

        $query = Language::orderBy('sequence', 'asc')->orderBy('id', 'asc')->get();
        $languages = $query; 

        return response()->json($languages);
    }
    public function get_blogs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'nullable|integer|exists:blogs,id',
        ]);
       
        if ($request->has('id') && $request->id != '') {
            $query = Blog::where('blogs.id', $request->id)->get();
        }else{
            $query = Blog::get();
        }
        
        foreach ($query as $key => $row) {
            $name = $row->name;
            $query[$key]->displayname = $name;
            $subquery = BlogPost::where('blog_id', $row->id)->get();
            foreach ($subquery as $subkey => $subrow) {
                $subquery[$subkey]->imageUrl = env('APP_URL') . '/storage/' . $subrow->image;
                $subname = $subrow->name;
                $subquery[$subkey]->displayname = $subname;
                $subdescription = $subrow->description;
                $subquery[$subkey]->displaydescription = $subdescription;
            }
            $query[$key]->blogpost = $subquery;
        }

        $result = $query;

        return response()->json($result);
    }
    public function get_blog_posts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'nullable|integer|exists:blog_posts,id',
            'blog_id' => 'nullable|integer|exists:blogs,id',
            'perpage' => 'nullable|integer',
            'page' => 'nullable|integer',
        ]);

        $perPage = 20;
        if ($request->has('perpage') && $request->perpage != '') {
            $perPage = $request->perpage;
        }
        $page = 1;
        if ($request->has('page') && $request->page != '') {
            $page = $request->page;
        }

        $query = BlogPost::where('published', '=', 1);

        
       
        if ($request->has('id') && $request->id != '') {
            $query = $query->where('id', $request->id);
        }
        if ($request->has('blog_id') && $request->blog_id != '') {
            $query = $query->where('blog_id', $request->blog_id);
        }
        if ($request->has('featured') && $request->featured == 1) {
            $query = $query->where('featured', $request->featured);
        }

        $query = $query
            ->select('*')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['/*'], 'page', $page);
        
        foreach ($query as $key => $row) {
            if($row->image != ''){
                $query[$key]->image = env('APP_URL') . '/storage/' . $row->image;
            }
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
            $description_array = $row->description;
            $query[$key]->displaydescription = $description_array;
            $query[$key]->link = '/page/blogpost-detail/'.$row->id;
        }

        $result = $query;

        return response()->json($result);
    }
}
