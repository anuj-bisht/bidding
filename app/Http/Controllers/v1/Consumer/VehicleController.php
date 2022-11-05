<?php

namespace App\Http\Controllers\v1\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    public function getVehicle(Request $request){

    $category = DB::table('categories')->where('id', $request->category)->first();
    $vehicle_arr=[];
    // $vehicle=DB::table('vehicles')
    //          ->join('sizes', 'sizes.vehicle_id', 'vehicles.id')
    //          ->where('vehicles.category_id', $category->id)
    //         ->select('sizes.size as vehicle_size', 'vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_icon', 'sizes.id as size_id')
    //         ->get();
    $vehicle=DB::table('vehicles')->where('category_id', $request->category)->get();

    foreach($vehicle as $allvehicle){
        $vehicle_detail['vehicle_id'] = $allvehicle->id;

        $vehicle_detail['name'] = $allvehicle->name;
        $vehicle_detail['icon'] = $allvehicle->vehicle_icon;
        $vehicle_detail['size']=DB::table('sizes')->where('vehicle_id', $allvehicle->id)->get();
     array_push($vehicle_arr, $vehicle_detail);
    }
//     return $vehicle_arr;
// die;
    return  response()->json(['status'=>1, 'message'=>'Success', 'data'=>$vehicle_arr]);

//     $vehicle=DB::table('vehicles')
//     ->where('vehicles.category_id', $category->id)
//    ->select( 'vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_icon', 'vehicles.id')
//    ->get();
//     return
//    foreach($vehicle->id as $id){
//        return $id;

}

// return  response()->json(['status'=>true, 'data'=>$vehicle]);
//     }
}
