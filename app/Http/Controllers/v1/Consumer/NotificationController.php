<?php

namespace App\Http\Controllers\v1\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use Tymon\JWTAuth\Facades\JWTAuth;

class NotificationController extends Controller
{
    public function getAllNotification(Request $request){
        $user=JWTAuth::user();
        if(!isset($user)){
            return response()->json(['status'=>0, 'message'=>"User Not Found or Wrong Token", 'data'=>[]]);
        }
        $notification=Notification::where('user_id', $user->id)->where('status',1)->latest('updated_at')->get();
        if(sizeof($notification)>0){
            return response()->json(['status'=>1, 'message'=>"User Notification", 'data'=>$notification]);

        }else{
            return response()->json(['status'=>0, 'message'=>"No Notification Found", 'data'=>[]]);

        }
    }
    public function unreadNotification(Request $request){
        $user=JWTAuth::user();
        if(!isset($user)){
            return response()->json(['status'=>0, 'message'=>"User Not Found or Wrong Token", 'data'=>[]]);
        }
        Notification::where('user_id', $user->id)->update(['status'=>0]);
        
            return response()->json(['status'=>1, 'message'=>"User Notification read to unread", 'data'=>[]]);

            }

}
