<?php

namespace App\Http\Controllers\v1\Consumer;

use App\Common\Utility;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\Common;
use App\Models\Applybid;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\UserBid;
use Config;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Razorpay\Api\Api;
use Tymon\JWTAuth\Exceptions\JWTException;

class OrderController extends Controller
{
    use Common;

    public function generateOrderr(Request $request, Notification $notification)
    {

        try {
            $status = 0;
            $message = "";
            $user = JWTAuth::user();

            $validator = Validator::make($request->all(), [
                'consignment_id' => 'required'
            ]);
            $params = [];
            if ($validator->fails()) {
                $error = json_decode(json_encode($validator->errors()));
                if (isset($error->consignment_id[0])) {
                    $message = $error->consignment_id[0];
                }
                return response()->json(["status" => $status, "message" => $message, "data" => json_decode("{}")]);
            }
            $consignment = DB::table('userbids')->where('userbids.id', $request->consignment_id)
                ->join('applybids', 'applybids.userbids_id', 'userbids.id')->where('applybids.status', 'Inprogress')
                ->select('applybids.price as bid_price', 'applybids.userbids_id', 'applybids.provider_id')->first();
            $consignment_category = DB::table('userbids')->where('id', $consignment->userbids_id)->select('category_id')->first();
            if ($consignment_category->category_id === 1) {
                $order_id = DB::table('usertours')->where('userbid_id', $consignment->userbids_id)->select('order_id')->first();
            }
            if ($consignment_category->category_id === 2) {
                $order_id = DB::table('usertransports')->where('userbid_id', $consignment->userbids_id)->select('order_id')->first();
            }
            if ($consignment_category->category_id === 3) {
                $order_id = DB::table('userpackages')->where('userbid_id', $consignment->userbids_id)->select('order_id')->first();
            }
            $user_token = DB::table('users')->where('id', $consignment->provider_id)->select('firebase_token')->first();
            //  return $user_token->firebase_token;
            //  die;
            if (isset($consignment->userbids_id)) {
                $amount = (($request->price) ? $consignment->bid_price : $consignment->bid_price) * 100;
                $receipt = 'order_' . uniqid();
                $key = env('RAZOR_LIVE_KEY');
                $secret = env('RAZOR_LIVE_SECRET');


                $api = new Api('rzp_live_gmti8mZKHxaTUt', 'PLZ6RVKNr7JGqjZ3a4AItKEe');
                $data = $api->order->create(array('receipt' => $receipt, 'amount' => $amount, 'currency' => 'INR')); // Creates order
                if (empty($data)) {
                    $data = FALSE;
                } else {
                    $result = $data;

                    if (!isset($result->receipt)) {
                        return response()->json(['status' => $status, 'message' => 'Error', 'data' => $result]);
                    }
// dd($result->receipt,$result->id,$result->amount,$user->id,$request->plan_id,$result->currency);

                    $order = new Order();
                    $order->order_id = $result->receipt;
                    $order->razor_id = $result->id;
                    $order->amount = $result->amount / 100;
                    $order->user_id = $user->id;
                    $order->consignment_id = $request->consignment_id;
                    $order->plan_id = (int)0;
                    $order->currency = $result->currency;
                    $order->status = '0';
                    if ($order->save()) {
                        return response()->json(['status' => 1, 'message' => 'Order Created SuccessFully', 'data' => $order]);
                    }
                    return response()->json(['status' => $status, 'message' => 'No Consignment exist', 'data' => json_decode("{}")]);
                }
            } else {
                return response()->json(['status' => $status, 'message' => 'No Consignment exist', 'data' => json_decode("{}")]);
            }


        } catch (Exception $e) {
            return response()->json(['status' => $status, 'message' => $e->getMessage(), 'data' => json_decode("{}")]);
        }

    }

    public function verifyPaymentt(Request $request)
    {

        try {
            $status = 0;
            $message = "";
            $error = "Error will set";
            $user = JWTAuth::user();

            if (!isset($user->id)) {
                return response()->json(["status" => $status, "message" => 'User does not exist', "data" => json_decode("{}")]);
            }

            $key = env('RAZOR_LIVE_KEY')?? "rzp_live_gmti8mZKHxaTUt" ;
            $secret = env('RAZOR_LIVE_SECRET') ?? "PLZ6RVKNr7JGqjZ3a4AItKEe";

            $api = new Api($key, $secret);
            $validator = Validator::make($request->all(), [
                'razorpay_payment_id' => 'required',
                'razorpay_order_id' => 'required',
                'razorpay_signature' => 'required',
                'order_id' => 'required',
            ]);

            if ($validator->fails()) {
                $error = json_decode(json_encode($validator->errors()));
                if (isset($error->razorpay_payment_id[0])) {
                    $message = $error->razorpay_payment_id[0];
                } else if (isset($error->razorpay_order_id[0])) {
                    $message = $error->razorpay_order_id[0];
                } else if (isset($error->razorpay_signature[0])) {
                    $message = $error->razorpay_signature[0];
                }
                return response()->json(["status" => $status, "message" => $error, "data" => json_decode("{}")]);
            }

            //dd("hi", $request->all());
            $success = true;
            if (!empty($request->razorpay_payment_id)) {

                try {
                    $attributes = array(
                        'razorpay_order_id' => $request->razorpay_order_id,
                        'razorpay_payment_id' => $request->razorpay_payment_id,
                        'razorpay_signature' => $request->razorpay_signature
                    );

                    $api->utility->verifyPaymentSignature($attributes);
                    $success = true;
                } catch (Exception $e) {
                    $success = false;
                    $error = 'Razorpay Error : ' . $e->getMessage();
                    return response()->json(['status' => 0, 'message' => $error, 'data' => json_decode("{}")]);
                }

            }
            //----- Sayed Code ---//
            if ($success === true) {

                $orderData = Order::where('order_id', $request->order_id)->orWhere('razor_id', $request->order_id)->first();
                if (isset($orderData->id)) {
                    $subs = Order::find($orderData->id);
                    $subs->status = 1;
                    DB::beginTransaction();
                    try {
                        if ($subs->save()) {


//                    $this->confirmOrder($orderData->id, $subs->id);
                            $schedule_array = array("123", "246");
                            $rand_keys = array_rand($schedule_array, 1);
                            $html = "Payment success/ Signature Verified";
                            $consignment = DB::table('userbids')->where('userbids.id', $orderData->consignment_id)
                                ->join('applybids', 'applybids.userbids_id', 'userbids.id')
                                ->where('applybids.status', 'Inprogress')
                                ->select('applybids.price as bid_price', 'applybids.userbids_id', 'applybids.provider_id')->first();
                            $consignment_category = DB::table('userbids')->where('id', $consignment->userbids_id)->select('category_id')->first();
                            if ($consignment_category->category_id === 1) {
                                $order_id = DB::table('usertours')->where('userbid_id', $consignment->userbids_id)->select('order_id')->first();
                            }
                            if ($consignment_category->category_id === 2) {
                                $order_id = DB::table('usertransports')->where('userbid_id', $consignment->userbids_id)->select('order_id')->first();
                            }
                            if ($consignment_category->category_id === 3) {
                                $order_id = DB::table('userpackages')->where('userbid_id', $consignment->userbids_id)->select('order_id')->first();
                            }
                            $user_token = DB::table('users')->where('id', $consignment->provider_id)->select('firebase_token')->first();
                            //  return $user_token->firebase_token;
                            //  die;
                            if (isset($consignment->userbids_id)) {
                                DB::table('userbids')->where('id', $subs->consignment_id)->update(['status' => 'payment complete']);
                                DB::table('applybids')->where('userbids_id', $subs->consignment_id)->where('status', 'Inprogress')->update(['status' => 'payment complete']);
//                        $amount = (($request->price) ? $consignment->bid_price : $consignment->bid_price) * 100;
//                        $receipt = 'order_' . uniqid();
//                        $key = env('RAZOR_LIVE_KEY');
//                        $secret = env('RAZOR_LIVE_SECRET');


//                        $api = new Api('rzp_live_gmti8mZKHxaTUt', 'PLZ6RVKNr7JGqjZ3a4AItKEe');
//                        $data = $api->order->create(array('receipt' => $receipt, 'amount' => $amount, 'currency' => 'INR')); // Creates order
//                        if (empty($data)) {
//                            $data = FALSE;
//                        } else {
//                            $result = $data;

//                            if (!isset($result->receipt)) {
//                                return response()->json(['status' => $status, 'message' => 'Error', 'data' => $result]);
//                            }
// dd($result->receipt,$result->id,$result->amount,$user->id,$request->plan_id,$result->currency);

//                            $order = new Order();
//                            $order->order_id = $result->receipt;
//                            $order->razor_id = $result->id;
//                            $order->amount = $result->amount / 100;
//                            $order->user_id = $user->id;
//                            $order->consignment_id = $request->consignment_id;
//                            $order->plan_id = (int)0;
//                            $order->currency = $result->currency;
//                            $order->status = '0';


//                            if ($order->save()) {
                                $suscription_title = "Payment Successful";
                                $suscription_msg = JWTAuth::user()->name . " " . "complete a payment." . " " . "Order ID is" . " " . $order_id->order_id;
                                $this->sendNotification($user_token->firebase_token, $suscription_title, $suscription_msg);
                                $notification = new Notification;
                                $notification->user_id = $consignment->provider_id;
                                $notification->title = $suscription_title;
                                $notification->message = $suscription_msg;
                                $notification->type = 'Consignment Payment Done';
                                $notification->save();

                                $suscription_titlee = "Payment Successful";
                                $suscription_msgg = JWTAuth::user()->name . "," . "Your payment is complete." . " " . "Consignment Order ID is" . " " . $order_id->order_id;
                                $this->sendNotificationn(JWTAuth::user()->firebase_token, $suscription_titlee, $suscription_msgg);
                                $notification = new Notification;
                                $notification->user_id = $user->id;
                                $notification->title = $suscription_titlee;
                                $notification->message = $suscription_msgg;
                                $notification->type = 'Consignment Payment Done';
                                $notification->save();
                                DB::commit();
//                            }
//                        }
//                    } else {
//                        return response()->json(['status' => $status, 'message' => 'No Consignment exist', 'data' => json_decode("{}")]);
//                    }
                                return response()->json(['status' => 1, 'message' => "Payment success/ Signature Verified", 'data' => 'success']);
                            } else {
                                return response()->json(['status' => 0, 'message' => 'Order does not exist', 'data' => json_decode("{}")]);
                            }


                        } else {
                            $html = "<p>Your payment failed</p><p>{$error}</p>";

                            return response()->json(['status' => 0, 'message' => $html, 'data' => $html]);
                        }
                    } catch (Exception $e) {
                        DB::rollBack();
                        return response()->json(['status' => 0, 'message' => $e->getMessage(), 'data' => json_decode("{}")]);
                    }
                    //----- End Sayed Code ---//
                } else {
                    return response()->json(['status' => $status, 'message' => "No Order with the provided order id", 'data' => json_decode("{}")]);
                }


            } else {
                $html = "<p>Your payment failed</p><p>{$error}</p>";

                return response()->json(['status' => 0, 'message' => $html, 'data' => $html]);
            }

        } catch (Exception $e) {
            // DB::rollback();
            return response()->json(['status' => $status, 'message' => $e->getMessage(), 'data' => json_decode("{}")]);
        }

    }
}
