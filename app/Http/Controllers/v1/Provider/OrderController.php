<?php

namespace App\Http\Controllers\v1\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Razorpay\Api\Api;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Notification;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use GuzzleHttp\Client;
use App\Http\Controllers\Traits\Common;
use app\Models\Wallet;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Config;
use App\Common\Utility;
use Razorpay\Api\Errors\SignatureVerificationError;

class OrderController extends Controller
{
    use Common;
    public function generateOrder(Request $request){

        try{
          $status = 0;
          $message = "";
          $user  = JWTAuth::user();


          $validator = Validator::make($request->all(), [
            'plan_id' => 'required'
          ]);

          $params = [];
          if($validator->fails()){
            $error = json_decode(json_encode($validator->errors()));
            if(isset($error->plan_id[0])){
              $message = $error->plan_id[0];
            }
            return response()->json(["status"=>$status,"message"=>$message,"data"=>json_decode("{}")]);
          }
          $planData = Plan::getPlanById($request->plan_id);

          //print_r($planData); die;
          if(isset($planData->id)){
           $amount = (($request->price) ? $planData->plan_rate : $planData->plan_rate)*100;
           $receipt = 'order_'.uniqid();
           $key = env('RAZOR_LIVE_KEY');
           $secret = env('RAZOR_LIVE_SECRET');

            $api = new Api('rzp_live_gmti8mZKHxaTUt','PLZ6RVKNr7JGqjZ3a4AItKEe');

            $data  = $api->order->create(array('receipt' => $receipt, 'amount' => $amount, 'currency' => 'INR')); // Creates order
            if (empty($data)) {
              $data = FALSE;
            } else {
                $result = $data;
                if(!isset($result->receipt)){
                  return response()->json(['status'=>$status,'message'=>'Error','data'=>$result]);
                }
                $order = new Order();
                $order->order_id = $result->receipt;
                $order->razor_id = $result->id;
                $order->amount = $result->amount/100;
                $order->user_id = $user->id;
                $order->plan_id = $request->plan_id;
                $order->consignment_id = (int)0;
                $order->currency = $result->currency;
                $order->status=0;
                if($order->save()){
                  return response()->json(['status'=>1,'message'=>'Order Created SuccessFully','data'=>$order]);
                }
            }
          }else{
            return response()->json(['status'=>$status,'message'=>'No plan exist','data'=>json_decode("{}")]);
          }
        }catch(Exception $e){
          return response()->json(['status'=>$status,'message'=>$e->getMessage(),'data'=>json_decode("{}")]);
        }

      }

        /**
         * Edit event method/
         * @return success or error
         *
         * */
        public function verifyPayment(Request $request,Notification $notification){

          try{
            $status = 0;
            $message = "";

            $user  = JWTAuth::user();

            if(!isset($user->id)){
              return response()->json(["status"=>$status,"message"=>'User does not exist',"data"=>json_decode("{}")]);
            }

            $key = env('RAZOR_LIVE_KEY');
            $secret = env('RAZOR_LIVE_SECRET');


             $api = new Api($key,$secret);

             $validator = Validator::make($request->all(), [
              'razorpay_payment_id' => 'required',
              'razorpay_order_id'=>'required',
              'razorpay_signature'=>'required',
              'order_id'=>'required',
            ]);

            if($validator->fails()){
              $error = json_decode(json_encode($validator->errors()));
              if(isset($error->razorpay_payment_id[0])){
                  $error = $error->razorpay_payment_id[0];
              }else if(isset($error->razorpay_order_id[0])){
                  $error = $error->razorpay_order_id[0];
              }else if(isset($error->razorpay_signature[0])){
                  $error = $error->razorpay_signature[0];
              }
              return response()->json(["status"=>$status,"message"=>$error,"data"=>json_decode("{}")]);
            }

        //dd("hi", $request->all());
            $success = false;
            if (!empty($request->razorpay_payment_id)) {

            try
                {
                    $attributes = array(
                        'razorpay_order_id' => $request->razorpay_order_id,
                        'razorpay_payment_id' => $request->razorpay_payment_id,
                        'razorpay_signature' => $request->razorpay_signature
                    );

                    $api->utility->verifyPaymentSignature($attributes);
                    $success = true;
                }
                catch(SignatureVerificationError $e)
                {
                    $success = false;
                    $error = 'Razorpay Error : ' . $e->getMessage();
                    $html = "<p>Your payment failed</p><p>{$error}</p>";

                    return response()->json(['status'=>0,'message'=>$html,'data'=>$html]);
                }

            }

            if ($success === true)
            {
               // DB::beginTransaction();
                //----- Sayed Code ---//
                $orderData = Order::where('order_id',$request->order_id)->orWhere('razor_id', $request->order_id)->first();
                //----- End Sayed Code ---//

                if(isset($orderData->id)){
                         $subs = Order::find($orderData->id);
                         $subs->status=1;
                    }
                    if($subs->save()){
//                        $this->confirmOrder($orderData->id,$subs->id);
                        $schedule_array = array("123", "246");
                        $rand_keys = array_rand($schedule_array, 1);
                        if(DB::table('wallets')->where('user_id',$user->id)->exists()){
                            if($orderData->plan_id == 0){
                                return response()->json(['status'=>0,'message'=>'plan selected not present in database.','data'=>json_decode("{}")]);
                            }
                            $coins = DB::table('plans')->where('id', $orderData->plan_id)->first()->coins;
                            $wallet=DB::table('wallets')->where('user_id',$user->id)->first();
                            $updatewallet=DB::table('wallets')->where('user_id',$user->id)->update(['points'=>$wallet->points+$coins]);
                            $wallethistory=DB::table('wallet_history')->insert(['user_id'=>$user->id,'point'=>$orderData->amount]);
                            $suscription_title = "Your Point has been created in your Wallet";
                            $suscription_msg = "your Wallet is updated";
                            $this->sendNotification($user->firebase_token,$suscription_title,$suscription_msg);
                            $notification->user_id=$user->id;
                            $notification->title=$suscription_title;
                            $notification->message=$suscription_msg;
                            $notification->type='Add Coins';
                            $notification->save();
                        return response()->json(['status'=>1,'message'=>"Payment success/ Signature Verified",'data'=>'success']);
                      }
                }else{
                    return response()->json(['status'=>0,'message'=>'Order does not exist','data'=>json_decode("{}")]);
                    }


                  }
                  else{
                    $html = "<p>Your payment failed</p><p>{$error}</p>";

                    return response()->json(['status'=>0,'message'=>$html,'data'=>$html]);
                }
                }
            catch(Exception $e){
                 return response()->json(['status'=>$status,'message'=> $e->getMessage(),'data'=>json_decode("{}")]);
          }

        }


        // public function getsubscription(Request $request){
        //     $status = 0;
        //     $message = "";
        //     $user  = JWTAuth::user();

        //     $result = Subscription::getSubsByUser($user->id);

        //     return response()->json(['status'=>1,'message'=>'','data'=>$result]);
        // }


}
