<?php

namespace App\Http\Controllers\Listings;

use App\Http\Controllers\Controller;
use App\Models\FeatureListing;
use App\Models\Listing;
use App\Models\ListingListingType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CreateListingController extends Controller
{
    public function create_listing(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer',
            'map' => 'nullable|string',
            'price_prefix' => 'nullable|string',
            'price_postfix' => 'nullable|string',
            'area_size' => 'required|integer',
            'area_size_prefix' => 'nullable|string',
            'area_size_postfix' => 'nullable|string',
            'number_of_bedrooms' => 'nullable|integer',
            'number_of_bathrooms' => 'nullable|integer',
            'number_of_garages_or_parkingpaces' => 'nullable|integer',
            'year_built' => 'nullable|integer',
            'address' => 'required|string',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'virtual_tour' => 'nullable|string',
            'energy_class' => 'nullable|string',
            'energy_performance' => 'nullable|string',
            'epc_current_rating' => 'nullable|string',
            'epc_potential_rating' => 'nullable|string',
            'location_id' => 'required|integer|exists:locations,id',
            'property_type_id' => 'required|integer|exists:property_types,id',
            'delivery_time_id' => 'required|integer|exists:delivery_times,id',
            'owner_id' => 'required|integer|exists:customers,id',
            'listing_type_id' => 'required|integer|exists:listing_types,id',
            'images' => 'nullable|array',
            'features' => 'nullable|array',
            'features.*' => 'exists:features,id',
        ]);
        if ($validator->fails()) {
            // Return the validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $image = $request->image;
        $image_parts = explode(";base64", $image);
        $image_type_aux = explode('image/', $image_parts[0]);
        $image_type = $image_type_aux[1];
        $file = base64_decode($image_parts[1]);
        $safeName = 'listing_' . time() . "." . $image_type;
        file_put_contents(public_path('storage') . '/' . $safeName, $file);
        
        $listing = Listing::create([
            'name' => $request->name,
            'image' => $safeName,
            'description' => $request->description,
            'price' => $request->price,
            'map' => $request->map,
            'price_prefix' => $request->price_prefix,
            'price_postfix' => $request->price_postfix,
            'area_size' => $request->area_size,
            'area_size_prefix' => $request->area_size_prefix,
            'area_size_postfix' => $request->area_size_postfix,
            'number_of_bedrooms' => $request->number_of_bedrooms,
            'number_of_bashrooms' => $request->number_of_bashrooms,
            'number_of_garages_or_parkingpaces' => $request->number_of_garages_or_parkingpaces,
            'year_built' => $request->year_built,
            'published' => 0,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            '360_virtual_tour' => $request->virtual_tour,
            'energy_class' => $request->energy_class,
            'energy_performance' => $request->energy_performance,
            'epc_current_rating' => $request->epc_current_rating,
            'epc_potential_rating' => $request->epc_potential_rating,
            'location_id' => $request->location_id,
            'property_type_id' => $request->property_type_id,
            'delivery_time_id' => $request->delivery_time_id,
            'owner_id' => $request->owner_id,
        ]);
        
        
        foreach ($request->features as $key => $row) {
            $temp = FeatureListing::create([
                'listing_id' => $listing->id,
                'feature_id' => $row,
            ]);
        }
        $temp = ListingListingType::create([
            'listing_id' => $listing->id,
            'listing_type_id' => $request->listing_type_id,
        ]);
            
        foreach ($request->images as $key => $row) {
            $image = $row;
            $image_parts = explode(";base64", $image);
            $image_type_aux = explode('image/', $image_parts[0]);
            $image_type = $image_type_aux[1];
            $file = base64_decode($image_parts[1]);
            $safeName = 'signed_' . time() . "." . $image_type;
            $preName = 'signed_' . time();


            $model_type = str_replace("/", "\\", "App/Models/Listing");
            
        
            $media_listing = Media::create(array(
                'model_type' =>  $model_type, 
                'model_id' => $listing->id,
                'uuid' => rand(1,99999999999),
                'name' => $safeName,
                'size' => 520,
                'file_name' => $safeName,
                'collection_name' => 'images',
                'mime_type' => 'image/'.$image_type,
                'disk' => 'public',
                'conversions_disk' => 'public',
                'responsive_images' => array(),
                'manipulations' => array(),
                'custom_properties' => array(),
                'generated_conversions' => array('large-size' => true,"medium-size" => true, "thumb" => true)
            ));

            $imageId =  $media_listing->id;
            
            $success = file_put_contents(public_path('storage') . '/' . $safeName, $file);
            if (!file_exists(public_path('storage').'/'.$imageId)) 
            {     
                mkdir(public_path('storage').'/'.$imageId, 0777, true);
            }
            file_put_contents(public_path('storage').'/'.$imageId.'/'.$safeName, $file);
            if (!file_exists(public_path('storage').'/'.$imageId.'/conversions')) 
            {     
                mkdir(public_path('storage').'/'.$imageId.'/conversions', 0777, true);
            }
            file_put_contents(public_path('storage').'/'.$imageId.'/conversions'.'/'.$preName.'-large-size.jpg', $file);
            file_put_contents(public_path('storage').'/'.$imageId.'/conversions'.'/'.$preName.'-medium-size.jpg', $file);
            file_put_contents(public_path('storage').'/'.$imageId.'/conversions'.'/'.$preName.'-thumb.jpg', $file);

        }

        //sendmail
        $WebListingEmail = env("Web_Listing_Email");

        $testMailData = [
            'title' => 'Add a New Listing',
            'body' => 'User adds a new listing '
        ];

        // Mail::to($WebListingEmail)->send(new SendMail($testMailData));
        
        return response()->json([
            'message' => 'Listings added successfully',
            'listing' => $listing,
        ], 201);
    }
}
