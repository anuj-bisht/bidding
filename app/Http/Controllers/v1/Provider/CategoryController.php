<?php

namespace App\Http\Controllers\v1\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;

class CategoryController extends Controller
{
    public function providerCategory(){
        $user= JWTAuth::user();
        $provider_category=DB::table('providers')->where('user_id', $user->id)->first();
        $all_category= json_decode($provider_category->category_id);
        $data= DB::table('categories')->whereIn('id', $all_category)->select('id', 'category', 'icon')->get();
         return response()->json(['status'=>1, 'message'=>'Success', 'data'=>$data]);
    }
   public function walletHistory(){
        $user=JWTAuth::user();
        if(!isset($user)){
            return response()->json(['status'=>0, 'message'=>'This User Not Found', 'data'=>[]]);

        }
        $data=DB::table('wallet_history')->where('user_id', $user->id)->get();
        if(sizeof($data)>0){
            return response()->json(['status'=>1, 'message'=>'Success', 'data'=>$data]);
        }else{
            return response()->json(['status'=>0, 'message'=>'Please Recharge Your Wallet', 'data'=>[]]);
        }
    }
    public function walletPoint(){
        $user=JWTAuth::user();
        if(!isset($user)){
            return response()->json(['status'=>0, 'message'=>'This User Not Found', 'data'=>[]]);

        }
        $data=DB::table('wallets')->where('user_id', $user->id)->first();
        if(!isset($data)){
            return response()->json(['status'=>0, 'message'=>'Please Recharge Your Wallet', 'data'=>[]]);

        }else{
            return response()->json(['status'=>1, 'message'=>'Success', 'data'=>$data]);
        }
    }
}
