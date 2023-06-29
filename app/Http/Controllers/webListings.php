<?php


namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Feature;
use App\Models\Listing;
use App\Models\Location;
use App\Models\Municipality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class webListings extends Controller
{
    public function get_active_features(Request $request)
    {
        // $this->authorize('view-any', Size::class);

        $query = Feature::join('feature_listings', 'features.id', '=', 'feature_listings.feature_id')
                            ->join('listings', 'listings.id', '=', 'feature_listings.listing_id')
                            ->where('listings.published', true);
        $query = $query->select('features.*')
                ->orderBy('features.sequence', 'desc')
                ->orderBy('features.name', 'desc')
                ->distinct()
                ->paginate(1000);

        foreach ($query as $key=>$row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
        }

        $sizes = $query;

        return response()->json($sizes);
    }
    public function get_active_district(Request $request)
    {
        // http://localhost:8000/api/activelocation
        // http://localhost:8000/api/activemunicipality
        // http://localhost:8000/api/activedistrict
        // http://localhost:8000/api/activefeatures

        $query = District::whereIn('districts.id', function ($subquery) {
                                $subquery->select('location_id')
                                ->from('listings')
                                ->join('locations', 'listings.location_id', '=', 'locations.id')
                                ->join('municipalities', 'listings.location_id', '=', 'locations.id')
                                ->where('listings.published', '=', 1);
                            });
        if ($request->has('district')) {
            $query = $query->where('municipalities.district_id', '=', $request->district);
        }
        $query = $query->select('districts.*')
                ->orderBy('districts.name', 'asc')
                ->paginate(1000);

        

        foreach ($query as $key=>$row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
        }

        $districts = $query;

        return response()->json($districts);
    }
    public function get_active_municipality(Request $request)
    {
        // http://localhost:8000/api/activelocation
        // http://localhost:8000/api/activemunicipality

        $query = Municipality::whereIn('municipalities.id', function ($subquery) {
                                $subquery->select('municipality_id')
                                ->from('listings')
                                ->join('locations', 'listings.location_id', '=', 'locations.id')
                                ->where('published', '=', 1);
                            });
        if ($request->has('district')) {
            $query = $query->where('municipalities.district_id', '=', $request->district);
        }
        $query = $query->select('municipalities.*')
                ->orderBy('municipalities.name', 'asc')
                ->paginate(1000);

        

        foreach ($query as $key=>$row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
        }

        $municipality = $query;

        return response()->json($municipality);
    }
    public function get_active_location(Request $request)
    {
        // $this->authorize('view-any', Size::class);

        $query = Location::whereIn('locations.id', function ($subquery) {
            $subquery->select('location_id')
            ->from('listings')
            ->where('published', '=', 1);
        });
        if ($request->has('municipality')) {
            $query = $query->where('municipality_id', '=', $request->municipality);
        }
        if ($request->has('district')) {
            $query = $query->join('municipalities', 'municipalities.id', '=', 'locations.municipality_id')
                        ->where('municipalities.district_id', '=', $request->district);
        }
        $query = $query->select('locations.*')
                ->orderBy('locations.name', 'asc')
                ->paginate(1000);

        

        foreach ($query as $key=>$row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
        }

        $locations = $query;

        return response()->json($locations);
    }
    public function get_active_listings(Request $request)
    {
        // $request = $_REQUEST;
        

        $perPage = 20;
        $page = 1;
        $orderby = 'listings.id';
        $orderbytype = 'desc';

        if ($request->has('page') && is_numeric($request->page)) {
            $page = $request->page;
        }
        if ($request->has('per_page') && is_numeric($request->per_page)) {
            $perPage = $request->per_page;
        }
        
        $query = Listing::where('published', '=', 1);

        if ($request->has('features')) {
            foreach($request->features as $feature){
                $query = $query->whereIn('listings.id', function ($subquery) use ($feature) {
                    $subquery->select('listing_id')
                        ->from('feature_listing')
                        ->where('feature_listing.feature_id', $feature);
                });
            }
        }
        if ($request->has('locations')) {
            $query = $query->whereIn('location_id', $request->locations);
        }
        

/*
                    echo 'we are here<br>';
        echo $request->address;
        return true;

        $select_values_array = [];
        
        if ($request->has('customer_id')) {
            $select_values_array[] = 'wish_lists.product_id as wish_list_product_id';
            $query = $query->leftJoin('wish_lists', function ($join) use ($request) {
                $join->on('products.id', '=', 'wish_lists.product_id')
                    ->where('wish_lists.customer_id', '=', $request->customer_id);
            });
        }
        else{
            // $select_values_array[] = "'' as wish_list_product_id";
        }

        if(count($subcategories_array) > 0){
            $query = $query->whereIn('products.id', function ($subquery) use ($subcategories_array) {
                $subquery->select('product_id')
                    ->from('category_product')
                    ->whereIn('category_id', $subcategories_array);
            });
        }
        if ($request->has('brands')) {
            $brands_array = [];
            foreach(explode(',', $request->brands) as $brandid){
                if(is_numeric($brandid)){
                    $brands_array[] = $brandid;
                }
            }
            if(count($brands_array) > 0){
                $query = $query->whereIn('brand_id', $brands_array);
            }   
        }
        
        if ($request->has('colours')) {
            $colours_array = [];
            foreach(explode(',', $request->colours) as $colorid){
                if(is_numeric($colorid)){
                    $colours_array[] = $colorid;
                }
            }
            if(count($colours_array) > 0){
                $query = $query->whereIn('products.id', function ($subquery) use ($colours_array) {
                    $subquery->select('product_id')
                        ->from('product_variants')
                        ->whereIn('product_variants.colour_id', $colours_array)
                        ->where('product_variants.active', '=', 1);
                });
            }            
        }
        
        if ($request->has('sizes')) {
            $sizes_array = [];
            foreach(explode(',', $request->sizes) as $sizesid){
                if(is_numeric($sizesid)){
                    $sizes_array[] = $sizesid;
                }
            }
            if(count($sizes_array) > 0){
                $query = $query->whereIn('products.id', function ($subquery) use ($sizes_array) {
                    $subquery->select('product_id')
                        ->from('product_variants')
                        ->whereIn('product_variants.size_id', $sizes_array)
                        ->where('product_variants.active', '=', 1);
                });
            }            
        }
        
        if ($request->has('id') && $request->id != '') {
            $query = $query->where('id', $request->id);
        }
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query = $query
                        ->where('sku', 'LIKE', '%' . $search . '%')
                        ->orWhere('barcode', 'LIKE', '%' . $search . '%')
                        ->orWhere('name', 'LIKE', '%' . $search . '%');
        }
        
        $select_values_array[] = 'products.*';
        */
        $query = $query
                    ->select('listings.*')                
                    ->orderBy($orderby, $orderbytype)
                    ->paginate($perPage, ['/*'], 'page', $page);

                    print_r($query);
                    return '12345';
        /*       
        foreach ($query as $key=>$row) {
            $name_array =json_decode($row->name);
            $query[$key]->name = isset($name_array->en)?$name_array->en:'';

            $description_array =json_decode($row->description);
            $query[$key]->description = isset($description_array->en)?$description_array->en:'';

            $post = Product::with('media')->find($row->id);
            $media = $post->media;
            
            $images_array = [];
            foreach ($media as $m) {
                $images_array[] = env('APP_URL').'/storage/'.$m->id.'/'.$m->file_name;
            }
            $query[$key]->images = $images_array;
            $query[$key]->brand_name = '';
            if($row->brand_id != ''){
                $brand = Brand::find($row->brand_id);
                $query[$key]->brand_name = $brand->name;
            }
            $variants = ProductVariant::where('product_id', $row->id)->get();

            $variants_array = [];
            foreach ($variants as $variant) {
                $variant->color_name = '';
                if($variant->colour_id != ''){
                    $colour = Colour::find($variant->colour_id);
                    $variant->color_name = $colour->name;
                }
                $variant->size_name = '';
                if($variant->size_id != ''){
                    $size = Size::find($variant->size_id);
                    $variant->size_name = $size->name;
                }
                $variants_array[] = $variant;
            }
            $query[$key]->variants = $variants_array;
            $query[$key]->in_wishlist = 0;
            if(isset($query[$key]->wish_list_product_id) && $query[$key]->wish_list_product_id == $query[$key]->id){
                $query[$key]->in_wishlist = 1;
            }
        }
        */

        $products = $query; 

        print_r($products);
        return true;

        return response()->json($products);
    }
}
