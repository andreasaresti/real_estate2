<?php

namespace App\Http\Controllers\Listings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AddMediaController extends Controller
{
    public function add_media(Request $request){
        $validator = Validator::make($request->all(), [
            'model_type' => 'required|string',
            'model_id' => 'required|integer',
            'image' => 'required|string',
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
        $safeName = 'signed_' . time() . "." . $image_type;
        $preName = 'signed_' . time();


        $model_type = str_replace("/", "\\", $request->model_type);
        
       
        $media_listing = Media::create(array(
            'model_type' =>  $model_type, 
            'model_id' => $request->model_id,
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


        return response()->json([
            'message' => 'Media added successfully',
            'media' => $media_listing,
        ], 201);
    }
}
