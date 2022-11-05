<?php

namespace App\Http\Controllers\v1\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;

class ConsignmentHistoryController extends Controller
{

    public function consignmentHistory(){
        // $z=DB::table('usertours')->get();
        // $y=DB::table('usertransports')->get();
        // $array = array_merge($z->toArray(), $y->toArray());
        // return $array;
        // die;
          $user= JWTAuth::user();

          $user_history=DB::table('userbids')->where('userbids.user_id', $user->id)->get();
          if(count($user_history)>0){



    $a=[];

          foreach($user_history as $user_category){

            //   switch($user_category->category_id){
                 if($user_category->category_id=='2'){

                    $transport=DB::table('userbids')
                    ->join('usertransports', 'usertransports.userbid_id', 'userbids.id')
                    ->join('categories', 'categories.id', 'userbids.category_id')
                     ->join('users', 'users.id', 'userbids.user_id')
                    ->join('sizes', 'sizes.id', 'usertransports.vehicle_size_id')
                     ->join('vehicles', 'vehicles.id', 'sizes.vehicle_id')
//                    ->where('userbids.status', '!=', 'complete')
                    ->where('userbids.user_id', $user->id)
                    ->where('userbids.category_id', 2)
//                    ->where('usertransports.shifting_date','<=',\Carbon\Carbon::now()->format('Y-m-d'))
//                    ->where('usertransports.end_date','>=',\Carbon\Carbon::now()->format('Y-m-d'))
                     ->select('userbids.id as consignment_id','userbids.source_address','userbids.destination_address','userbids.source_lat','userbids.source_long', 'userbids.destination_long', 'userbids.destination_lat',
                            'userbids.distance','userbids.status','usertransports.vehicle_bodytype','usertransports.description','usertransports.order_id', 'usertransports.weight','usertransports.shifting_date as start_date','usertransports.loading_and_unloading', 'categories.category',
                             'users.name as username','users.mobile as user_mobile', 'users.email as user_email', 'sizes.size as vehicle_size', 'vehicles.name as vehicle_name','vehicles.vehicle_icon as vehicle_icon')
                             ->orderByDesc('userbids.updated_at')->get();
                  }
                elseif($user_category->category_id=='1'){
                    $tour=DB::table('userbids')
                   ->join('usertours','usertours.userbid_id', 'userbids.id')
                   ->join('categories', 'categories.id', 'userbids.category_id')
                   ->join('users', 'users.id', 'userbids.user_id')
                   ->join('vehicles', 'vehicles.id', 'usertours.vehicle_id')
//                    ->where('userbids.status', '!=', 'complete')
                    ->where('userbids.user_id', $user->id)
                    ->where('userbids.category_id', 1)
//                    ->where('usertours.date_of_travel','<=',\Carbon\Carbon::now()->format('Y-m-d'))
//                    ->where('usertours.end_date','>=',\Carbon\Carbon::now()->format('Y-m-d'))
                    ->select('userbids.id as consignment_id','userbids.source_address','userbids.destination_address','userbids.source_lat','userbids.source_long', 'userbids.destination_long', 'userbids.destination_lat',
                    'userbids.distance','userbids.status', 'categories.category','users.name as username','users.mobile as user_mobile', 'users.email as user_email',
                    'usertours.date_of_travel as start_date', 'usertours.end_date','usertours.description','usertours.order_id', 'usertours.number_of_passenger', 'vehicles.name','vehicles.vehicle_icon as vehicle_icon')
                   ->orderByDesc('userbids.updated_at')->get();
                    // array_push($a, $data);
                  }
                  elseif($user_category->category_id=='3'){
                    $package=DB::table('userbids')
//                        ->where('userbids.status', '!=', 'complete')
                    ->where('userbids.user_id', $user->id)
                   ->where('userbids.category_id', 3)
                   ->join('userpackages','userpackages.userbid_id', 'userbids.id')
                   ->join('categories', 'categories.id', 'userbids.category_id')
                   ->join('users', 'users.id', 'userbids.user_id')
                   ->join('vehicles', 'vehicles.id', 'userpackages.vehicle_id')
                   ->join('flats','flats.id', 'userpackages.flat_type')
                    ->select('userbids.id as consignment_id','userbids.source_address','userbids.destination_address','userbids.source_lat','userbids.source_long', 'userbids.destination_long', 'userbids.destination_lat',
                    'userbids.distance','userbids.status', 'categories.category','users.name as username','users.mobile as user_mobile', 'users.email as user_email',
                    'userpackages.date_of_shifting as start_date', 'userpackages.end_date as end_date' ,'userpackages.description','userpackages.images','userpackages.order_id', 'flats.flat_type', 'vehicles.name','vehicles.vehicle_icon as vehicle_icon')
                   ->orderByDesc('userbids.updated_at')->get();


                    // array_push($a, $data);
                  }

          }


        //   $obj = (object) array_merge((array)$transport, (array)$package_mover);
        if(isset($tour) && isset($transport) && isset($package)){
            $array =  array_merge($tour->toArray(), $transport->toArray(), $package->toArray());
         }
         elseif(isset($tour) && isset($package)){
            $array =  array_merge($tour->toArray(), $package->toArray());
           }
         elseif(isset($tour) && isset($transport)){
          $array =  array_merge($tour->toArray(), $transport->toArray());
         }
         elseif(isset($package) && isset($transport)){
            $array =  array_merge($package->toArray(), $transport->toArray());

        }elseif(isset($transport)){
            $array =  $transport;
         }
         elseif(isset($tour)){
            $array =  $tour;
         }
         elseif(isset($package)){
            $array =  $package;
         }
        foreach ($array as $data){
            if(isset($data->end_date) && (\Carbon\Carbon::make($data->end_date)->diffInDays(now(), false) > 0) ){
                $data->status = "Expired";
            }
        }
          return response()->json(['status'=>1, 'message'=>'User All Consignment', 'data'=>$array]);
        }
        else{
            return response()->json(['status'=>0, 'message'=>'No  Consignment Found', 'data'=>[]]);

        }

    }
}
// else{
//     return response()->json(['status'=>1, 'message'=>'User All Consignment', 'data'=>$array]);

// }

