<?php

namespace App\Http\Controllers\v1\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use JWTAuth;
use App\Http\Controllers\Traits\Common;

use App\Models\UserBid;
use App\Models\Userpackage;
use App\Models\Usertour;
use App\Models\Usertransport;
use App\Models\Notification;
use Exception;
use Carbon\Carbon;

use Tymon\JWTAuth\Exceptions\JWTException;

class UserbidController extends Controller
{
 use Common;
    public function index(Request $request)
    {
        try {
            $user = JWTAuth::user();

            $data = DB::table("userbids")
                ->join('sizes', 'sizes.id' , 'userbids.truck_preference')
                ->join('vehicles', 'vehicles.id', 'sizes.vehicle_id')
                ->join('categories', 'categories.id', 'vehicles.category_id')
                ->where("userbids.user_id", $user->id)
                ->select('userbids.*', 'sizes.size as vehicle_size', 'sizes.id as size_id', 'sizes.vehicle_id as vehicle_id',
                         'vehicles.name as vehicle_name', 'categories.category as category')
                ->get();
            if (sizeof($data) > 0) {
                return response()->json([
                    "status" => true,
                    "message" => "Data Fetch Successfully",
                    "data" => $data,
                ]);
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "No Data Found",
                    "data" => [],
                ]);
            }
        } catch (JWTException $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
                "data" => [],
            ]);
        }
    }

     public function createTransportConsignment(Request $request,Notification $notification)
    {
        DB::beginTransaction();
        try{
        $user = JWTAuth::user();
        $data = new Userbid();
        $data->user_id = $user->id;
        $data->category_id = $request->category_id;
        $data->source_address = $request->source_address;
        $data->destination_address = $request->destination_address;
        $data->source_lat= $request->source_lat;
        $data->source_long = $request->source_long;
        $data->destination_lat= $request->destination_lat;
        $data->destination_long = $request->destination_long;
        $data->distance= $request->distance;
	$data->ETA= (int)$request->ETA;
        $data->status='pending';


        if($data->save() ){


            if($data->category_id==2){
            $usertransport = new Usertransport();
            $usertransport->userbid_id = $data->id;

            $usertransport->vehicle_size_id = $request->vehicle_size_id;
            $usertransport->description = $request->description;
            $usertransport->weight = $request->weight;
            $usertransport->vehicle_bodytype = $request->vehicle_bodytype;
            $usertransport->loading_and_unloading= $request->loading_and_unloading;
             $usertransport->shifting_date = Carbon::parse($request->shifting_date);
            $usertransport->end_date = Carbon::parse($request->end_date);
            $usertransport->order_id = 'WHLSNFRTRA000'.$data->id;
            }

        }
 if ($usertransport->save()) {
            DB::commit();

            if(isset($user->firebase_token)){
                $dateTime = date('Y-m-d H:i:s');
 $suscription_title = "Create Transport Consignment";
                          $suscription_msg = "Create Transport Consignment on"." ".Carbon::createFromFormat('Y-m-d H:i:s', $dateTime)->format('m-d-Y');
                          $this->sendNotification($user->firebase_token,$suscription_title,$suscription_msg);
   			  $notification=new Notification();
			  $notification->user_id=$user->id;
                          $notification->title=$suscription_title;
                          $notification->message=$suscription_msg;
                          $notification->type='Transport Consignment';
                              if($notification->save()){
                              $onlytransport=DB::table('users')->where('role',3)->select('users.id','users.firebase_token')->get();
                          foreach($onlytransport as $notificationnn){
                            $suscription_titlee = $user->name." "."Create Transport Consignment";
                            $suscription_msgg = $user->name." "."has  Created a Transport Consignment";
                            $this->sendNotificationn($notificationnn->firebase_token,$suscription_titlee,$suscription_msgg);
                            $notificationn=new Notification();
                            $notificationn->user_id=$notificationnn->id;
                            $notificationn->title=$suscription_titlee;
                            $notificationn->message=$suscription_msgg;
                            $notificationn->type='Transport Consignment';
                            $notificationn->save();
                            }
                        }
                     
                        $message = "Transport Consignment Create Successfully";
                                              return response()->json([
                            "status" => 1,
                            "message" => $message,
                            "data" => $data
                        ]);
                    }
        }
       else {
            return response()->json([
                "status" => 0,
                "message" => "Unable to create user transport consignment",
                "data" => json_decode("{}"),
            ]);
        }

        }
        catch(\Exception $e){
          DB::rollBack();
          return response()->json([
                    "status" => 0,
                    "message" => $e->getMessage()

                ]);
        }
    }

    public function createTourConsignment(Request $request,Notification $notification){
        DB::beginTransaction();
        try{
        $user = JWTAuth::user();
        $data = new Userbid();
        $data->user_id = $user->id;
        $data->category_id = $request->category_id;
        $data->source_address = $request->source_address;
        $data->destination_address = $request->destination_address;
        $data->source_lat= $request->source_lat;
        $data->source_long = $request->source_long;
        $data->destination_lat= $request->destination_lat;
        $data->destination_long = $request->destination_long;
        $data->distance= $request->distance;
        $data->ETA= (int)$request->ETA;
        $data->status='pending';

        if($data->save() ){



            if($data->category_id==1){
                $usertour = new Usertour();
                $usertour->userbid_id = $data->id;
                $usertour->vehicle_id = $request->vehicle_id;
                $usertour->description = $request->description;
          $usertour->date_of_travel = Carbon::parse($request->date_of_travel);
                $usertour->end_date = Carbon::parse($request->end_date);
                $usertour->number_of_passenger = $request->number_of_passenger;
                $usertour->order_id = 'WHLSNFRTO000'.$data->id;
            }
        }

        if ($usertour->save()) {
            DB::commit();

            if(isset($user->firebase_token)){
                $dateTime = date('Y-m-d H:i:s');
                          $suscription_title = "Create Tour Consignment";
                          $suscription_msg = "Create Tour Consignment on"." ".Carbon::createFromFormat('Y-m-d H:i:s', $dateTime)->format('m-d-Y');
                          $this->sendNotification($user->firebase_token,$suscription_title,$suscription_msg);
			  $notification=new Notification();
			  $notification->user_id=$user->id;
                          $notification->title=$suscription_title;
                          $notification->message=$suscription_msg;
                          $notification->type='Transport Consignment';
                                 if($notification->save()){
                              $onlytransport=DB::table('users')->where('role',3)->select('users.id','users.firebase_token')->get();
                          foreach($onlytransport as $notificationnn){
                            $suscription_titlee = $user->name." "."Create Tour Consignment";
                            $suscription_msgg = $user->name." "."has  Created a Tour Consignment";
                            $this->sendNotificationn($notificationnn->firebase_token,$suscription_titlee,$suscription_msgg);
                            $notificationn=new Notification();
                            $notificationn->user_id=$notificationnn->id;
                            $notificationn->title=$suscription_titlee;
                            $notificationn->message=$suscription_msgg;
                            $notificationn->type='Tour Consignment';
                            $notificationn->save();
                            }
                        }

                        $message = "Tour and Travel Consignment Create Successfully";
                        return response()->json([
                            "status" => 1,
                            "message" => $message,
                            "data" => $data
                        ]);
                    }
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Unable to create user tour consignment",
                "data" => json_decode("{}"),
            ]);
        }
        }
        catch(\Exception $e){
          DB::rollBack();
          return response()->json([
                    "status" => 0,
                    "message" => $e->getMessage()

                ]);
        }
    }
  public function createPackageConsignment(Request $request,Notification $notification){
           
        DB::beginTransaction();
        try{
        $user = JWTAuth::user();
        $data = new Userbid();
        $data->user_id = $user->id;
        $data->category_id = $request->category_id;
        $data->source_address = $request->source_address;
        $data->destination_address = $request->destination_address;
        $data->source_lat= $request->source_lat;
        $data->source_long = $request->source_long;
        $data->destination_lat= $request->destination_lat;
        $data->destination_long = $request->destination_long;
        $data->distance= $request->distance;
        $data->ETA= (int)$request->ETA;
        $data->status='pending';


        if($data->save() ){



            if($data->category_id==3){

                $images=[];
                $files=$request->file('flat_images');

                if($files=$request->file('flat_images')){
                    foreach($files as $file){
                        $name=time().rand(1,100).'.'.$file->extension();
                       $path= $file->move('Flat', $name);


                       $images[]=url('').'/'.$path;

                    }
                }
                $userpackage = new Userpackage();
                $userpackage->userbid_id = $data->id;
                $userpackage->vehicle_id = $request->vehicle_id;
                $userpackage->description = $request->description;
            $userpackage->date_of_shifting = Carbon::parse($request->date_of_shifting);
                $userpackage->end_date = Carbon::parse($request->end_date);
                $userpackage->description = $request->description;
                $userpackage->images = collect($images)->implode(',');
                $userpackage->flat_type = $request->flat_type;
                $userpackage->order_id = 'WHLSNFRPA000'.$data->id;
            }
        }

         if ($userpackage->save()) {
            DB::commit();

             if(isset($user->firebase_token)){
                $dateTime = date('Y-m-d H:i:s');
                          $suscription_title = "Create Package Consignment";
                          $suscription_msg = "Create Package Consignment on"." ".Carbon::createFromFormat('Y-m-d H:i:s', $dateTime)->format('m-d-Y');
                          $this->sendNotification($user->firebase_token,$suscription_title,$suscription_msg);
			  $notification=new Notification();
			  $notification->user_id=$user->id;
                          $notification->title=$suscription_title;
                          $notification->message=$suscription_msg;
                          $notification->type='Package Consignment';
                          if($notification->save()){
                              $onlytransport=DB::table('users')->where('role',3)->select('users.id','users.firebase_token')->get();
                          foreach($onlytransport as $notificationnn){
                            $suscription_titlee = $user->name." "."Create Package Consignment";
                            $suscription_msgg = $user->name." "."has  Created a Package Consignment";
                            $this->sendNotificationn($notificationnn->firebase_token,$suscription_titlee,$suscription_msgg);
                            $notificationn=new Notification();
                            $notificationn->user_id=$notificationnn->id;
                            $notificationn->title=$suscription_titlee;
                            $notificationn->message=$suscription_msgg;
                            $notificationn->type='Transport Consignment';
                            $notificationn->save();
                            }
                        }

                        $message = "User Package Consignment Create Successfully";
                        return response()->json([
                            "status" => 1,
                            "message" => $message,
                            "data" => $data
                        ]);
                    }

        } else {
            return response()->json([
                "status" => 0,
                "message" => "Unable to create user tour consignment",
                "data" => json_decode("{}"),
            ]);
        }
        }
        catch(\Exception $e){
          DB::rollBack();
          return response()->json([
                    "status" => 0,
                    "message" => $e->getMessage()

                ]);
        }
    }

          public function update(Request $request)
    {
        $user = JWTAuth::user();
        $data = Userbid::findOrFail($request->id);
        $data->user_id = $user->id;
        $data->category_id = $request->category_id;
        $data->source = $request->source;
        $data->truck_preference = $request->truck_preference;
        $data->body_type = $request->body_type;
        $data->lat= $request->lat;
        $data->long = $request->long;
        $data->distance= $request->distance;
        $data->destination = $request->destination;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->bid_end_date = $request->bid_end_date;
        $data->service_start_date = $request->service_start_date;
        try {
            $data->save();
            return response()->json([
                "status" => true,
                "message" => "Data Update Successfully",
                "data" => $data,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
                "data" => [],
            ]);
        }
    }

    public function delete(Request $request)
    {
        $data = Userbid::findOrFail($request->id);
        try {
            $data->delete();
            return response()->json([
                "status" => true,
                "message" => "Data Delete Successfully",
                "data" => $data,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
                "data" => [],
            ]);
        }
    }

    public function ProviderAction(Request $request){

        $data=DB::table('applybids')
              ->where('applybids.userbids_id', $request->userbid_id)
            ->join('users', 'users.id', 'applybids.provider_id')
            //   ->join('users', 'id', 'applybids.provider_id')
            ->select('users.name as provider_name', 'applybids.price as bid_price', 'applybids.description as bid_description',
               'applybids.additional_information as bid_additional_information', 'users.email as provider_email', 'users.mobile as provider_mobile')
               ->get();

    }

}
