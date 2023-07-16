<?php

namespace App\Http\Controllers;
use App\Models\Listing;
use App\Models\Location;
use App\Models\Agent;
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
        if(isset($_GET['flag'])){
            $flag = $_GET['flag'];
        }else{
            $flag = "";
        }
        if($flag == "listings"){
            $data = Listing::where('id',$index)->first();
            return view('positionModal', compact('data'));
        }
        if($flag == "locations"){
            $data = Location::where('id',$index)->first();
            return view('positionModal', compact('data'));
        }
        if($flag == "agencies"){
            $data = Agent::where('id',$index)->first();
            return view('positionModal', compact('data'));
        }
    }

}
