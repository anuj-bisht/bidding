<?php

namespace App\Http\Controllers\v1\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applybid;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Traits\Common;
use App\Models\Notification;

use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ApplyBidController extends Controller
{
 use Common;
public function providerApplyOnBid(Request $request,Notification $notification){

      $validate= Validator::make($request->all(),[
       'price'=>'required',

       'userbid_id'=>'required',

      ]);

      if($validate->fails()){
        return response()->json(['status'=>false, 'message'=>($validate->errors()), 'data'=>[]]);

      }
        $cons=DB::table('userbids')->where('userbids.id',$request->userbid_id)->join('users','users.id','userbids.user_id')->select('users.id','users.firebase_token')->first();

     $user=JWTAuth::user();
     if(!isset($user)){
      return response()->json([
              "status" => 0,
              "message" => "User Not Exist, Please Register First",
              "data" => json_decode("{}"),
                              ]);
               }
     $walletpoint=DB::table('wallets')->where('user_id',$user->id)->first();
     if($walletpoint->points>0){
     $applyBid= new ApplyBid;
     $applyBid->userbids_id=$request->userbid_id;
     $applyBid->provider_id=$user->id;
     $applyBid->price=$request->price;
     $applyBid->status='pending';
    try {
       $provider_document=DB::table('providers')->where('user_id', $user->id)->first();
    //    if(!empty($provider_document->gst_image) && $provider_document->pan_image =='NULL' && $provider_document->aadhar_image=='NULL'){

        if(!empty($provider_document->gst_image) || !empty($provider_document->pan_image) || !empty($provider_document->aadhar_image)){
            if(DB::table('wallets')->where('user_id',$user->id)->exists()){
            $walletpoint=DB::table('wallets')->where('user_id',$user->id)->first();
            $walletupdate=DB::table('wallets')->where('user_id',$user->id)->update(['points'=>$walletpoint->points-1]);

            }
            $applyBid->save();


        }else{

            return response()->json(['status'=>0, 'message'=>'First Upload All The Documents', 'data'=>[]]);


        }

    $suscription_title = "Apply On Bid";
                            $suscription_msg = "you have successfully applied on the bid";
                            $this->sendNotification($user->firebase_token,$suscription_title,$suscription_msg);
                            $notification=new Notification();
                            $notification->user_id=$user->id;
                            $notification->title=$suscription_title;
                            $notification->message=$suscription_msg;
                            $notification->type='Apply Bid';
                            if($notification->save()){
                            $suscription_titlee = $user->name.' '."has applied bid on your consignment";
                            $suscription_msgg = $user->name.' '."successfully applied bid on your consignment";
                            $this->sendNotificationn($cons->firebase_token,$suscription_titlee,$suscription_msgg);
                            $notificationn=new Notification();
                            $notificationn->user_id=$cons->id;
                            $notificationn->title=$suscription_titlee;
                            $notificationn->message=$suscription_msgg;
                            $notificationn->type='Apply on your consignment';
                            $notificationn->save();
                            }

        return response()->json(['status'=>1, 'message'=>'Provider Apply On Bid Successfully', 'data'=>$applyBid]);
    } catch (\Exception $e) {
        return response()->json(['status'=>0, 'message'=>$e->getMessage()]);
    }}
    else{
        return response()->json(['status'=>0, 'message'=>"You don't have enough balance to complete you bid,Please Recharge Your Wallet", 'data'=>[]]);
    }
    }

     public function editBid(Request $request){
        $user=JWTAuth::user();

        $category_id=DB::table('applybids')->where('applybids.id', $request->bid_id)
        ->join('userbids', 'userbids.id', 'applybids.userbids_id')->select('userbids.category_id')
        ->first();
        //  $category_id->category_id;
        if($category_id->category_id=='2'){
            $data=DB::table('applybids')
            ->where('applybids.id', $request->bid_id)
             ->join('providers', 'providers.user_id', 'applybids.provider_id')
             ->join('userbids', 'userbids.id', 'applybids.userbids_id')
             ->join('users', 'users.id', 'userbids.user_id')
             ->join('categories', 'categories.id', 'userbids.category_id')
             ->join('usertransports', 'usertransports.userbid_id', 'userbids.id')
             ->join('sizes', 'sizes.id', 'usertransports.vehicle_size_id')
             ->join('vehicles', 'vehicles.id', 'sizes.vehicle_id')
             ->select('applybids.price as bid_price', 'applybids.id as bid_id','applybids.driver_phone','applybids.driver_license_image','applybids.driver_image','providers.organisation_name as provider_name', 'providers.mobile as provider_mobile', 'providers.organisation_email as provider_email',
                        'users.name as consumer_username', 'users.mobile as consumer_mobile', 'users.email as consumer_email',
                       'userbids.source_address','userbids.destination_address','userbids.source_lat','userbids.source_long','userbids.destination_lat','userbids.destination_long','userbids.distance','categories.category as category_name', 'categories.icon as category_icon','sizes.size as vehicle_size',
                       'usertransports.vehicle_bodytype','usertransports.description','usertransports.order_id', 'usertransports.weight','usertransports.shifting_date as start_date','usertransports.loading_and_unloading', 'vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_image')
                     ->first();
        }
        elseif($category_id->category_id=='1'){
            $data=DB::table('applybids')
            ->where('applybids.id', $request->bid_id)
            ->join('providers', 'providers.user_id', 'applybids.provider_id')
            ->join('userbids', 'userbids.id', 'applybids.userbids_id')
             ->join('users', 'users.id', 'userbids.user_id')
             ->join('categories', 'categories.id', 'userbids.category_id')
             ->join('usertours', 'usertours.userbid_id', 'userbids.id')
             ->join('vehicles', 'vehicles.id', 'usertours.vehicle_id')
             ->select('applybids.price as bid_price','applybids.id as bid_id', 'applybids.driver_phone','applybids.driver_license_image','applybids.driver_image','providers.organisation_name as provider_name', 'providers.mobile as provider_mobile', 'providers.organisation_email as provider_email',
                        'users.name as consumer_username', 'users.mobile as consumer_mobile', 'users.email as consumer_email',
                       'userbids.source_address','userbids.destination_address','userbids.source_lat','userbids.source_long','userbids.destination_lat','userbids.destination_long','userbids.distance','categories.category as category_name', 'categories.icon as category_icon',
                       'usertours.date_of_travel as start_date', 'usertours.end_date','usertours.description','usertours.order_id', 'usertours.number_of_passenger', 'vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_image')
                     ->first();
        }
    elseif($category_id->category_id=='3'){
            $data=DB::table('applybids')
            ->where('applybids.id', $request->bid_id)
            ->join('providers', 'providers.user_id', 'applybids.provider_id')
            ->join('userbids', 'userbids.id', 'applybids.userbids_id')
             ->join('users', 'users.id', 'userbids.user_id')
             ->join('categories', 'categories.id', 'userbids.category_id')
             ->join('userpackages', 'userpackages.userbid_id', 'userbids.id')
             ->join('vehicles', 'vehicles.id', 'userpackages.vehicle_id')
             ->join('flats', 'flats.id', 'userpackages.flat_type')
             ->select('applybids.price as bid_price','applybids.id as bid_id', 'applybids.driver_phone','applybids.driver_license_image','applybids.driver_image','providers.organisation_name as provider_name', 'providers.mobile as provider_mobile', 'providers.organisation_email as provider_email',
                        'users.name as consumer_username', 'users.mobile as consumer_mobile', 'users.email as consumer_email',
                       'userbids.source_address','userbids.destination_address','userbids.source_lat','userbids.source_long','userbids.destination_lat','userbids.destination_long','userbids.distance','categories.category as category_name', 'categories.icon as category_icon',
                       'userpackages.description','userpackages.order_id','userpackages.date_of_shifting as start_date','userpackages.images as flat_images', 'vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_image','flats.flat_type')
                     ->first();
        }
                return response()->json(['status'=>1, 'message'=>'Success', 'data'=>$data]);

    }
  public function flatType(){
        $flat=DB::table('flats')->select('id as flat_id','flat_type')->get();
        if(sizeof($flat)>0){
        return response()->json(['status'=>1, 'message'=>'Success', 'data'=>$flat]);
        }
        else{
            return response()->json(['status'=>0, 'message'=>'No Data Found', 'data'=>[]]);

        }

    }
}
