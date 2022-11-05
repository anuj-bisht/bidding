<?php

namespace App\Http\Controllers\v1\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use JWTAuth;

class EstimatePriceController extends Controller
{
    public function estimatePrice(Request $request){

        $validator=Validator::make($request->all(),[
            'distance'=>'required',
            'vehicle_id'=>'required'
        ]);
        $errors=json_decode(json_encode($validator->errors()));
        if(isset($errors->distance[0])){
           $message=$errors->distance[0];
        }
        elseif(isset($errors->vehicle_id[0])){
        $message=$errors->vehicle_id[0];
        }
        if($validator->fails()){
            return response()->json(['status'=>0, 'message'=>$message]);
        }
$t=$request->distance;
$distance= explode(' km',$t);
$actual_distance=$distance[0];
     
        $vehicle_price=DB::table('vehicles')->where('id', $request->vehicle_id)->select('per_KM')->first();
        $estimated_price=$actual_distance*(int)$vehicle_price->per_KM;
        $actual_price= (int)$estimated_price;
        return response()->json(['status'=>1, 'message'=>'Estimate Price', 'price'=>$actual_price]);

    }
}
