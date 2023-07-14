<?php

namespace App\Http\Controllers;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PositionModalController extends Controller
{
    public function index()
    {
        if(isset($_GET['index'])){
            $index = $_GET['index'];
        }else{
            $index = 0;
        }
        
        $listing = Listing::where('id',$index)->first();
        return view('positionModal', compact('listing'));
    }

}
