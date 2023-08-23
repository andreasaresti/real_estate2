<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class webListingsImportImagesController extends Controller
{
    public function import_images(Request $request)
    {
        $images_query = DB::table('import_property_images')
                                ->select('*')
                                ->where('imported', 0)
                                ->orderBy('is_main', 'desc')
                                ->limit(100)
                                ->get();
        foreach($images_query as $imageq){
            $ext = explode(".", basename($imageq->url));
            $image = 'data:image/'.$ext[1].';base64,'.base64_encode(file_get_contents($imageq->url));
            $image_parts = explode(";base64", $image);
            $extension_array = explode('.', $imageq->url);
            $extension = end($extension_array);
            $image_type_aux = explode('image/', $extension);
            $image_type = end($image_type_aux);
            $file = base64_decode($image_parts[1]);
            $safeName = $imageq->id . "." . $extension;
            $preName = $imageq->id;

            if($imageq->is_main == 0){
                $model_type = str_replace("/", "\\", "App/Models/Listing");
            
                $media_listing = Media::create(array(
                    'model_type' =>  $model_type, 
                    'model_id' => $imageq->property_id,
                    'uuid' => rand(1,99999999999),
                    'name' => $safeName,
                    'size' => 520,
                    'file_name' => $safeName,
                    'collection_name' => 'images',
                    'mime_type' => 'image/'.$extension,
                    'disk' => 'public',
                    'conversions_disk' => 'public',
                    'responsive_images' => array(),
                    'manipulations' => array(),
                    'custom_properties' => array(),
                    'generated_conversions' => array('large-size' => true,"medium-size" => true, "thumb" => true)
                ));
                $imageId =  $media_listing->id;

                Media::where('id', $imageId)->update(['name'=>$imageId.'.'.$extension, 'file_name'=>$imageId.'.'.$extension]);
            
                if (!file_exists(public_path('storage').'/'.$imageId)) 
                {     
                    mkdir(public_path('storage').'/'.$imageId, 0777, true);
                }
                file_put_contents(public_path('storage').'/'.$imageId.'/'.$imageId.'.'.$extension, $file);
                if (!file_exists(public_path('storage').'/'.$imageId.'/conversions')) 
                {     
                    mkdir(public_path('storage').'/'.$imageId.'/conversions', 0777, true);
                }
                file_put_contents(public_path('storage').'/'.$imageId.'/conversions'.'/'.$imageId.'-large-size.'.$extension, $file);
                file_put_contents(public_path('storage').'/'.$imageId.'/conversions'.'/'.$imageId.'-medium-size.'.$extension, $file);
                file_put_contents(public_path('storage').'/'.$imageId.'/conversions'.'/'.$imageId.'-thumb.'.$extension, $file);
            }
            else if($imageq->is_main == 1){
                Listing::where('id', $imageq->property_id)->update(['image'=>$imageq->property_id.'.'.$extension]);
                file_put_contents(public_path('storage').'/'.$imageq->property_id.'.'.$extension, $file);

            }
            DB::table('import_property_images')->where('id', $imageq->id)->update(['imported'=>1]);
            
        }
        echo 'finished<br>';
    }   
}
