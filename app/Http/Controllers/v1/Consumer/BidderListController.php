<?php

namespace App\Http\Controllers\v1\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use GuzzleHttp\Client;
use App\Http\Controllers\Traits\Common;
use Illuminate\Support\Facades\Log;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class BidderListController extends Controller
{
   use Common;
public function bidderList(Request $request){
    $user= JWTAuth::user();
    $check_category=DB::table('applybids')->where('userbids_id', $request->consignment_id)
    ->join('userbids', 'userbids.id', 'applybids.userbids_id')->select('userbids.category_id')
    ->get();
    if(count($check_category)>0)
    {
    foreach($check_category as $category){
      $datas=[];

        if($category->category_id=='2'){
    $bid=DB::table('applybids')->where('userbids_id', $request->consignment_id)
        ->join('userbids', 'userbids.id', 'applybids.userbids_id')
        ->join('categories','categories.id','userbids.category_id')
        ->join('providers', 'providers.user_id', 'applybids.provider_id')
        ->join('users', 'users.id', 'userbids.user_id')
        ->join('usertransports', 'usertransports.userbid_id', 'userbids.id')
        ->join('sizes', 'sizes.id', 'usertransports.vehicle_size_id')
        ->join('vehicles', 'vehicles.id', 'sizes.vehicle_id')
         ->where('userbids.status','pending')

        ->select('applybids.id','applybids.price','applybids.driver_phone','applybids.driver_license_image','applybids.driver_image','categories.category','categories.icon','providers.organisation_name','providers.organisation_email','providers.mobile','providers.gst_image','providers.pan_image','providers.aadhar_image',
        'userbids.source_address','userbids.destination_address','userbids.source_lat','userbids.source_long','userbids.destination_lat','userbids.destination_long','userbids.distance','users.name as username', 'users.mobile as usermobile', 'users.email as useremail','sizes.size as vehicle_size',
        'usertransports.vehicle_bodytype','usertransports.description','usertransports.order_id', 'usertransports.weight','usertransports.shifting_date as start_date','usertransports.loading_and_unloading','vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_image', 'providers.is_active as is_active')
        ->latest('applybids.created_at')->get();
        foreach($bid as $transport){
            $transportt['bidapply_id']=$transport->id;
            $transportt['bid_apply_price']=$transport->price;
            $transportt['driver_phone']=$transport->driver_phone;
            $transportt['driver_license_image']=$transport->driver_license_image;
            $transportt['driver_image']=$transport->driver_image;
            $transportt['category']=$transport->category;
            $transportt['category_icon']=$transport->icon;
            $transportt['provider_name']=$transport->organisation_name;
            $transportt['provider_gst_image']=$transport->gst_image;
            $transportt['provider_pan_image']=$transport->pan_image;
            $transportt['provider_aadhar_image']=$transport->aadhar_image;
            $transportt['provider_phone']=$transport->mobile;
            $transportt['provider_email']=$transport->organisation_email;
            $transportt['source_address']=$transport->source_address;
            $transportt['destination_address']=$transport->destination_address;
            $transportt['source_lat']=$transport->source_lat;
            $transportt['source_long']=$transport->source_long;
            $transportt['destination_lat']=$transport->destination_lat;
            $transportt['destination_long']=$transport->destination_long;
            $transportt['distance']=$transport->distance;
            $transportt['consumer_name']=$transport->username;
            $transportt['consumer_mobile']=$transport->usermobile;
            $transportt['consumer_email']=$transport->useremail;
            $transportt['vehicle_bodytype']=$transport->vehicle_bodytype;
            $transportt['description']=$transport->description;
            $transportt['order_id']=$transport->order_id;
            $transportt['weight']=$transport->weight;
            $transportt['start_date']=$transport->start_date;
            $transportt['loading_and_unloading']=$transport->loading_and_unloading;
            $transportt['vehicle_size']=$transport->vehicle_size;
            $transportt['vehicle_name']=$transport->vehicle_name;
            $transportt['vehicle_image']=$transport->vehicle_image;
            array_push($datas, $transportt);
        }


        }
        elseif($category->category_id=='1'){

            $bids=DB::table('applybids')->where('userbids_id', $request->consignment_id)
            ->join('userbids', 'userbids.id', 'applybids.userbids_id')
            ->join('categories','categories.id','userbids.category_id')
            ->join('providers', 'providers.user_id', 'applybids.provider_id')
            ->join('users', 'users.id', 'userbids.user_id')
            ->join('usertours', 'usertours.userbid_id', 'userbids.id')
             ->join('vehicles', 'vehicles.id', 'usertours.vehicle_id')
               ->where('userbids.status','pending')

             ->select('applybids.id','applybids.price','applybids.driver_phone','applybids.driver_license_image','applybids.driver_image','categories.category','categories.icon','providers.organisation_name','providers.organisation_email','providers.mobile','providers.gst_image','providers.pan_image','providers.aadhar_image',
             'userbids.source_address','userbids.destination_address','userbids.source_lat','userbids.source_long','userbids.destination_lat','userbids.destination_long','userbids.distance','users.name as username', 'users.mobile as usermobile', 'users.email as useremail'
            ,'usertours.description','usertours.order_id','usertours.date_of_travel as start_date','usertours.end_date','usertours.number_of_passenger','vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_image')
             ->latest('applybids.created_at')->get();

             foreach($bids as $tour){

                $tourr['bidapply_id']=$tour->id;
                $tourr['bid_apply_price']=$tour->price;
                $tourr['driver_phone']=$tour->driver_phone;
                $tourr['driver_license_image']=$tour->driver_license_image;
                $tourr['driver_image']=$tour->driver_image;
                $tourr['category']=$tour->category;
                $tourr['category_icon']=$tour->icon;
                $tourr['provider_name']=$tour->organisation_name;
                $tourr['provider_gst_image']=$tour->gst_image;
                $tourr['provider_pan_image']=$tour->pan_image;
                $tourr['provider_aadhar_image']=$tour->aadhar_image;
                $tourr['provider_phone']=$tour->mobile;
                $tourr['provider_email']=$tour->organisation_email;
                $tourr['source_address']=$tour->source_address;
                $tourr['destination_address']=$tour->destination_address;
                $tourr['source_lat']=$tour->source_lat;
                $tourr['source_long']=$tour->source_long;
                $tourr['destination_lat']=$tour->destination_lat;
                $tourr['destination_long']=$tour->destination_long;
                $tourr['distance']=$tour->distance;
                $tourr['consumer_name']=$tour->username;
                $tourr['consumer_mobile']=$tour->usermobile;
                $tourr['consumer_email']=$tour->useremail;
                $tourr['description']=$tour->description;
                $tourr['order_id']=$tour->order_id;
                $tourr['start_date']=$tour->start_date;
                $tourr['end_date']=$tour->end_date;
                $tourr['number_of_passenger']=$tour->number_of_passenger;
                $tourr['vehicle_name']=$tour->vehicle_name;
                $tourr['vehicle_image']=$tour->vehicle_image;

                array_push($datas, $tourr);
            }



        }
        elseif($category->category_id=='3'){

            $bidss=DB::table('applybids')->where('userbids_id', $request->consignment_id)
            ->join('userbids', 'userbids.id', 'applybids.userbids_id')
            ->join('categories','categories.id','userbids.category_id')
            ->join('providers', 'providers.user_id', 'applybids.provider_id')
            ->join('users', 'users.id', 'userbids.user_id')
            ->join('userpackages', 'userpackages.userbid_id', 'userbids.id')
             ->join('vehicles', 'vehicles.id', 'userpackages.vehicle_id')
             ->join('flats', 'flats.id', 'userpackages.flat_type')
               ->where('userbids.status','pending')
             ->select('applybids.id','applybids.price','applybids.driver_phone','applybids.driver_license_image','applybids.driver_image','categories.category','categories.icon','providers.organisation_name','providers.organisation_email','providers.mobile','providers.gst_image','providers.pan_image','providers.aadhar_image',
             'userbids.source_address','userbids.destination_address','userbids.source_lat','userbids.source_long','userbids.destination_lat','userbids.destination_long','userbids.distance','users.name as username', 'users.mobile as usermobile', 'users.email as useremail'
            ,'userpackages.description','userpackages.order_id','userpackages.date_of_shifting as start_date','userpackages.images','vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_image','flats.flat_type')
             ->latest('applybids.created_at')->get();

             foreach($bidss as $package){

                $packagee['bidapply_id']=$package->id;
                $packagee['bid_apply_price']=$package->price;
                $packagee['driver_phone']=$package->driver_phone;
                $packagee['driver_license_image']=$package->driver_license_image;
                $packagee['driver_image']=$package->driver_image;
                $packagee['category']=$package->category;
                $packagee['category_icon']=$package->icon;
                $packagee['provider_name']=$package->organisation_name;
                $packagee['provider_gst_image']=$package->gst_image;
                $packagee['provider_pan_image']=$package->pan_image;
                $packagee['provider_aadhar_image']=$package->aadhar_image;
                $packagee['provider_phone']=$package->mobile;
                $packagee['provider_email']=$package->organisation_email;
                $packagee['source_address']=$package->source_address;
                $packagee['destination_address']=$package->destination_address;
                $packagee['source_lat']=$package->source_lat;
                $packagee['source_long']=$package->source_long;
                $packagee['destination_lat']=$package->destination_lat;
                $packagee['destination_long']=$package->destination_long;
                $packagee['distance']=$package->distance;
                $packagee['consumer_name']=$package->username;
                $packagee['consumer_mobile']=$package->usermobile;
                $packagee['consumer_email']=$package->useremail;
                $packagee['description']=$package->description;
                $packagee['order_id']=$package->order_id;
                $packagee['start_date']=$package->start_date;
                $packagee['images']=$package->images;
                $packagee['flat_type']=$package->flat_type;
                $packagee['vehicle_name']=$package->vehicle_name;
                $packagee['vehicle_image']=$package->vehicle_image;

                array_push($datas, $packagee);
            }



        }

    }
    return response()->json(['status'=>1, 'message'=>'Bidder List', 'data'=>$datas]);
}
else{
$a=[];
    return response()->json(['status'=>0, 'message'=>'No Bidder placed bid on this consignment', 'data'=>$a]);

}



}
public function acceptBidder(Request $request,Notification $notification){
    $provider_id=DB::table('applybids')->where('id',$request->bidapply_id)->select('provider_id','userbids_id')->first();
    $user_token=DB::table('users')->where('id',$provider_id->provider_id)->select('firebase_token')->first();
    $token=DB::table('userbids')->where('userbids.id',$request->consignment_id)->join('users','users.id','userbids.user_id')->select('users.firebase_token','users.id')->first();

    $consignment=DB::table('userbids')->where('id',$provider_id->userbids_id)->select('category_id')->first();
    if($consignment->category_id===1){
        $order_id=DB::table('usertours')->where('userbid_id',$provider_id->userbids_id)->select('order_id')->first();
    }
    if($consignment->category_id===2){
        $order_id=DB::table('usertransports')->where('userbid_id',$provider_id->userbids_id)->select('order_id')->first();
    }
    if($consignment->category_id===3){
        $order_id=DB::table('userpackages')->where('userbid_id',$provider_id->userbids_id)->select('order_id')->first();
    }
    // return $order_id->order_id;
    // die;
    $data=DB::table('userbids')->where('id', $request->consignment_id)->update(['status'=>'Inprogress']);

    try {
        if($data==1){
            $bidapply_id=$request->bidapply_id;

            $dat=DB::table('applybids')->where('id', $bidapply_id)->update(['status'=>'Inprogress']);
            // return $user_token->firebase_token;
            // die;
            $suscription_title = "Your bid has been accepted";
            $suscription_msg = "Consignment Order id is"." ".$order_id->order_id;
            $this->sendNotification($user_token->firebase_token,$suscription_title,$suscription_msg);
            $notification->user_id=$provider_id->provider_id;
            $notification->title=$suscription_title;
            $notification->message=$suscription_msg;
            $notification->type='Accept Bid';
            if($notification->save()){
                $notification=new Notification();
                $suscription_titlee = "You have accepted the bid";
                $suscription_msgg = "Consignment Order id is"." ".$order_id->order_id;
                $this->sendNotificationn($token->firebase_token,$suscription_title,$suscription_msg);
                $notificationn=new Notification();
                $notificationn->user_id=$token->id;
                $notificationn->title=$suscription_titlee;
                $notificationn->message=$suscription_msgg;
                $notificationn->type='Accept Bid';
                $notificationn->save();
            }
             return response()->json(['status'=>1, 'message'=>'pending status change to Inprogress', 'data'=>$dat]);

        }else{
          return response()->json(['status'=>0, 'message'=>'error', 'data'=>[]]);

        }
    } catch (\Exception $e) {
        return response()->json(['status'=>0, 'message'=>$e->getMessage(), 'data'=>[]]);

    }

}
public function rejectBidder(Request $request){
    $data=DB::table('userbids')->where('id', $request->consignment_id)->update(['status'=>'pending']);

    try {
        if($data==1){
            $bidapply_id=$request->bidapply_id;

            $dat=DB::table('applybids')->where('id', $bidapply_id)->update(['status'=>'pending']);
             return response()->json(['status'=>1, 'message'=>'Inprogress status change to pending', 'data'=>$dat]);

        }else{
          return response()->json(['status'=>0, 'message'=>'error', 'data'=>[]]);

        }
    } catch (\Exception $e) {
        return response()->json(['status'=>0, 'message'=>$e->getMessage(), 'data'=>[]]);

    }

}
}
