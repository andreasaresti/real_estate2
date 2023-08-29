<?php
namespace App\Helpers;

use App\Models\Customer;
use App\Models\DeliveryTime;
use App\Models\District;
use App\Models\Feature;
use App\Models\Listing;
use App\Models\ListingType;
use App\Models\Location;
use App\Models\Municipality;
use App\Models\Newsletter;
use App\Models\PropertyType;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Helper {
	public static function get_delivery_times()
    {
        // $this->authorize('view-any', Size::class);

        $query = DeliveryTime::select('delivery_times.*')
            ->orderBy('delivery_times.sequence', 'asc')
            ->distinct()
            ->paginate(1000);

        foreach ($query as $key => $row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
        }

        $result = $query;

		return json_encode($result);
    }

	public static function get_active_features()
    {
        // $this->authorize('view-any', Size::class);

        $query = Feature::orderBy('features.name', 'asc');
        $query = $query->whereIn('features.id', function ($subquery) {
            $subquery->select('feature_listing.feature_id')
                ->from('listings')
                ->join('feature_listing', 'feature_listing.listing_id', '=', 'listings.id')
                ->where('listings.published', 1);
        });

        $query = $query->select('features.*')
            ->paginate(1000);

        foreach ($query as $key => $row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
        }

        $features = $query;

		return json_encode($features);
    }

	public static function get_active_district()
	{
		$query = District::whereIn('districts.id', function ($subquery) {
            $subquery->select('district_id')
                ->from('listings')
                ->join('locations', 'listings.location_id', '=', 'locations.id')
                ->join('municipalities', 'listings.location_id', '=', 'locations.id')
                ->where('listings.published', '=', 1);
        });
        $query = $query->select('districts.*')
            ->orderBy('districts.name', 'asc')
            ->distinct()
            ->paginate(1000);



        foreach ($query as $key => $row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;

            if($row->image != ''){
                $query[$key]->image = env('APP_IMG_URL') . '/storage/' . $row->image;;
            }

            $listingCount  = Listing::join('locations', 'locations.id', '=', 'listings.location_id')
                                        ->join('municipalities', 'locations.municipality_id', '=', 'municipalities.id')
                                        ->where('listings.published', '=', 1)
                                        ->where('municipalities.district_id', $row->id)->count();
            $query[$key]->listingCount = $listingCount;
        }

        $districts = $query;

		return json_encode($districts);
	}
	public static function get_active_location($post_data = [])
    {
        $query = Location::whereIn('locations.id', function ($subquery) {
            $subquery->select('location_id')
                ->from('listings')
                ->where('published', '=', 1);
        });
        if (isset($post_data['municipality']) && $post_data['municipality'] != '') {
            $query = $query->where('municipality_id', '=', $post_data['municipality']);
        }
        if (isset($post_data['district']) && $post_data['district'] != '') {
            $query = $query->join('municipalities', 'municipalities.id', '=', 'locations.municipality_id')
                ->where('municipalities.district_id', '=', $post_data['district']);
        }
        $query = $query->select('locations.*')
            ->orderBy('locations.name', 'asc')
            ->distinct()
            ->paginate(1000);

        foreach ($query as $key => $row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;

            $listingCount  = Listing::where('published', '=', 1)->where('location_id', $row->id)->count();
            $query[$key]->listingCount = $listingCount;

            if($row->image != ''){
                $query[$key]->image = env('APP_IMG_URL') . '/storage/' . $row->image;
            }
        }

        $locations = $query;

        return json_encode($locations);
    }
	public static function get_menu($post_data = [])
    {

        $query = DB::table('nova_menu_menu_items')
                    ->join('nova_menu_menus', 'nova_menu_menu_items.menu_id', '=', 'nova_menu_menus.id')
                    ->where('nova_menu_menus.slug', $post_data['slug'])
                    ->where('nova_menu_menu_items.locale', $post_data['locale'])
                    ->where('nova_menu_menu_items.enabled', true);

        if (isset($post_data['parent_id']) && $post_data['parent_id'] != '') {
            $query = $query->where('nova_menu_menu_items.parent_id', $post_data['parent_id']);
        }

        $query = $query
                    ->select('nova_menu_menu_items.*')
                    ->orderBy('order', 'asc')->get();
        $menus = $query; 

        return json_encode($menus);
    }
	public static function get_active_property_types($post_data = [])
	{
		// $this->authorize('view-any', Size::class);

		$query = PropertyType::whereIn('property_types.id', function ($subquery) {
			$subquery->select('listings.property_type_id')
				->from('listings')
				->where('listings.published', '=', 1);
		});

		$query = $query->select('property_types.*')
			->orderBy('property_types.name', 'asc')
			->paginate(1000);

		foreach ($query as $key => $row) {
			$name_array = $row->name;
			$query[$key]->displayname = $name_array;
		}

		$listing_types = $query;

		return json_encode($listing_types);

	}
	public static function get_active_municipality($post_data = [])
	{
		$query = Municipality::whereIn('municipalities.id', function ($subquery) {
            $subquery->select('municipality_id')
                ->from('listings')
                ->join('locations', 'listings.location_id', '=', 'locations.id')
                ->where('published', '=', 1);
        });
        if (isset($post_data['district']) && $post_data['district'] != '') {
            $query = $query->where('municipalities.district_id', '=', $post_data['district']);
        }
        $query = $query->select('municipalities.*')
            ->orderBy('municipalities.name', 'asc')
            ->distinct()
            ->paginate(1000);

        foreach ($query as $key => $row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;

            if($row->image != ''){
                $query[$key]->image = env('APP_IMG_URL') . '/storage/' . $row->image;;
            }

            $listingCount  = Listing::join('locations', 'locations.id', '=', 'listings.location_id')
                                        ->where('listings.published', '=', 1)
                                        ->where('locations.municipality_id', $row->id)->count();
            $query[$key]->listingCount = $listingCount;
        }

        $municipality = $query;

		return json_encode($municipality);
	}
	public static function get_active_listing_types()
    {
        $query = ListingType::whereIn('listing_types.id', function ($subquery) {
            $subquery->select('listing_type_id')
                ->from('listings')
                ->join('listing_listing_type', 'listing_listing_type.listing_id', '=', 'listings.id')
                ->where('listings.published', '=', 1);
        });

        $query = $query->select('listing_types.*')
            ->orderBy('listing_types.name', 'asc')
            ->paginate(1000);

        foreach ($query as $key => $row) {
            $name_array = $row->name;
            $query[$key]->displayname = $name_array;
        }

        $listing_types = $query;

		return json_encode($listing_types);
    }
}