<?php

namespace App\Http\Controllers;

use App\Models\Language;
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
}
