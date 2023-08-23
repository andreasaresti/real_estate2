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
        $images_query = DB::table('import_listings')
                                ->join('import_property_images', 'import_property_images.property_id', '=', 'import_listings.property_id')
                                ->select('import_listings.property_number', 'import_property_images.url', 'import_property_images.id', 'import_property_images.is_main')
                                ->where('import_property_images.imported', 0)
                                ->limit(50)
                                ->get();
        foreach($images_query as $imageq){
            $ext = explode(".", basename($imageq->url));
            $image = 'data:image/'.$ext[1].';base64,'.base64_encode(file_get_contents($imageq->url));
            $image_parts = explode(";base64", $image);
            $image_type_aux = explode('image/', $image_parts[0]);
            $image_type = $image_type_aux[1];
            $file = base64_decode($image_parts[1]);
            $safeName = 'listing_' . time() . "." . $image_type;
            $preName = 'listing_' . time();
    
            $model_type = str_replace("/", "\\", "App/Models/Listing");
            
            $media_listing = Media::create(array(
                'model_type' =>  $model_type, 
                'model_id' => $imageq->property_number,
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
            if($imageq->is_main==1){
                $result = Listing::where("id",$imageq->property_number)
                            ->update(["image"=>'/'.$imageId.'/conversions'.'/'.$preName.'-thumb.jpg']);
            }

            

            DB::table('import_property_images')->where('id', $imageq->id)->update(['imported'=>1]);

            
        }
    }   
}
