<?php

namespace App\Http\Controllers\v1\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TruckPreferenceController extends Controller
{
    public function TruckPreference(){
        $data=DB::table('sizes')
              ->join('vehicles','sizes.vehicle_id', 'vehicles.id')
              ->select('sizes.id as id', 'sizes.size as vehicle_size', 'sizes.vehicle_id as vehicle_id', 'vehicles.name as vehicle_name')
              ->get();
        if(sizeof($data)>0)
        {
        return response()->json(['status'=>true, 'message'=>'Data fetch Successfully', 'data'=>$data]);
        }
        else{
        return response()->json(['status'=>false, 'message'=>'No result found', 'data'=>[]]);

        }

    }
}
