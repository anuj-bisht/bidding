<?php

namespace App\Http\Controllers\v1\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use GuzzleHttp\Client;
use App\Http\Controllers\Traits\Common;
use App\Models\Notification;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    use Common;

    public function sendotp(Request $request)
    {

        try {
            $status = 0;
            $message = "";

            $validator = Validator::make($request->all(), [
                "mobile" => "required|string|max:10|min:10",
            ]);

            if ($validator->fails()) {
                $error = json_decode(json_encode($validator->errors()));
                if (isset($error->mobile[0])) {
                    $message = $error->mobile[0];
                }

                return response()->json([
                    "status" => $status,
                    "responseCode" => "NP997",
                    "message" => $message,
                    "data" => json_decode("{}"),
                ]);
            }

            $userList = User::where("mobile", $request->mobile)->first();
            if (!isset($userList)) {
                return response()->json([
                    "status" => 0,
                    "message" => "User Not Exist, Please Register First",
                    "data" => json_decode("{}"),
                ]);
            }
            if ($userList->role === 2) {
                return response()->json([
                    "status" => 0,
                    "message" => "You Are Not A Provider Please Register First As A Provider",
                    "data" => json_decode("{}"),
                ]);
            } else {
                $otp = rand(111111, 999999);
                //$otp = 123456;

                //$otp = 123456;

                if ($userList != null && $userList->count() > 0) {
                    $phone = $request->mobile;
                    $message = "Your OTP to log in to your account is" . " " . "$otp" . "." . " " . "Do not share your OTP with anyone. - Team WheelSniffer";


                    $client = new Client();
                    $url = "http://sendsms.designhost.in/index.php/smsapi/httpapi/";
                    $response = $client->put($url, [
                        'headers' => ['Content-type' => 'application/json'],
                        'json' => ['uname' => 'wheelsniffer',
                            'password' => '654321',
                            'sender' => 'WHLSNF',
                            'tempid' => '1707165097449419397',
                            'receiver' => $phone,
                            'route' => 'TA',
                            'msgtype' => '1',
                            'sms' => $message,
                            'format' => 'json'
                        ],
                    ]);
                    if ($response->getStatusCode() == 200) { // 200 OK

                        $response_data = $response->getBody()->getContents();

                    }

                    $userList->otp = $otp;
                    $userList->otp_expiration_time = time();
                    $userList->save();
                    // if ($userList->save()) {
                    //     return response()->json([
                    //         "status" => 1,
                    //         "responseCode" => "APP001",
                    //         "message" => "OTP Sent",
                    //         "otp" => $otp,
                    //         "data" => json_decode("{}"),
                    //     ]);
                    // }
                    $uname = 'wheelsniffer';
                    $passwordd = '654321';
                    $sender = 'WHLSNF';
                    //  $tempid = '1707165097449419397';
                    $route = 'TA';
                    $msgtype = '1';

                    if ($this->SendSms($phone, $message, $uname, $passwordd, $sender, $route, $msgtype)) {


                        return response()->json([
                            "status" => 1,
                            "responseCode" => "APP001",
                            "message" => "OTP Sent",
                            "otp" => $otp,
                            "data" => json_decode("{}"),
                        ]);
                    }
                } else {
                    return response()->json([
                        "status" => 0,
                        "responseCode" => "NP997",
                        "message" => "User not found. please register first",
                        "data" => json_decode("{}"),
                    ]);
                }
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => 0,
                "responseCode" => "NP997",
                "message" => "User update Error",
                "data" => json_decode("{}"),
            ]);
        }
    }


    public function consumerOtp(Request $request)
    {

        try {
            $status = 0;
            $message = "";

            $validator = Validator::make($request->all(), [
                "mobile" => "required|string|max:10|min:10",
            ]);

            if ($validator->fails()) {
                $error = json_decode(json_encode($validator->errors()));
                if (isset($error->mobile[0])) {
                    $message = $error->mobile[0];
                }

                return response()->json([
                    "status" => $status,
                    "responseCode" => "NP997",
                    "message" => $message,
                    "data" => json_decode("{}"),
                ]);
            }

            $userList = User::where("mobile", $request->mobile)->first();
            if (!isset($userList)) {
                return response()->json([
                    "status" => 0,
                    "message" => "User Not Exist, Please Register First",
                    "data" => json_decode("{}"),
                ]);
            }
            if ($userList->role === 3) {
                return response()->json([
                    "status" => 0,
                    "message" => "You Are Not A Consumer Please Register First As A Consumer",
                    "data" => json_decode("{}"),
                ]);
            } else {
                $otp = rand(111111, 999999);
                //$otp = 123456;

                //$otp = 123456;

                if ($userList != null && $userList->count() > 0) {
                    $phone = $request->mobile;
                    $message = "Your OTP to log in to your account is" . " " . "$otp" . "." . " " . "Do not share your OTP with anyone. - Team WheelSniffer";


                    $client = new Client();
                    $url = "http://sendsms.designhost.in/index.php/smsapi/httpapi/";
                    $response = $client->put($url, [
                        'headers' => ['Content-type' => 'application/json'],
                        'json' => ['uname' => 'wheelsniffer',
                            'password' => '654321',
                            'sender' => 'WHLSNF',
                            'tempid' => '1707165097449419397',
                            'receiver' => $phone,
                            'route' => 'TA',
                            'msgtype' => '1',
                            'sms' => $message,
                            'format' => 'json'
                        ],
                    ]);
                    if ($response->getStatusCode() == 200) { // 200 OK

                        $response_data = $response->getBody()->getContents();

                    }

                    $userList->otp = $otp;
                    $userList->otp_expiration_time = time();
                    $userList->save();
                    // if ($userList->save()) {
                    //     return response()->json([
                    //         "status" => 1,
                    //         "responseCode" => "APP001",
                    //         "message" => "OTP Sent",
                    //         "otp" => $otp,
                    //         "data" => json_decode("{}"),
                    //     ]);
                    // }
                    $uname = 'wheelsniffer';
                    $passwordd = '654321';
                    $sender = 'WHLSNF';
                    //  $tempid = '1707165097449419397';
                    $route = 'TA';
                    $msgtype = '1';

                    if ($this->SendSms($phone, $message, $uname, $passwordd, $sender, $route, $msgtype)) {


                        return response()->json([
                            "status" => 1,
                            "responseCode" => "APP001",
                            "message" => "OTP Sent",
                            "otp" => $otp,
                            "data" => json_decode("{}"),
                        ]);
                    }
                } else {
                    return response()->json([
                        "status" => 0,
                        "responseCode" => "NP997",
                        "message" => "User not found. please register first",
                        "data" => json_decode("{}"),
                    ]);
                }
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => 0,
                "responseCode" => "NP997",
                "message" => "User update Error",
                "data" => json_decode("{}"),
            ]);
        }
    }


    public function ConsumerRegister(Request $request, Notification $notification)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",

            "email" => "required|string|email|max:100|unique:users",
            "mobile" => "required|string|max:10|unique:users",
        ]);

        //$validator->errors()

        if ($validator->fails()) {
            $errors = json_decode(json_encode($validator->errors()));
            if (isset($errors->mobile[0])) {
                $message = $errors->mobile[0];
            }
            if (isset($errors->email[0])) {
                $message = $errors->email[0];
            }

            return response()->json(['status' => 0, 'message' => $message, 'data' => []]);

        }

        $data = [];

        $otp = rand(111111, 999999);
        //$otp = 123456;

        $data["otp"] = $otp;
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "mobile" => $request->mobile,
            "role" => 2,
            "password" => Hash::make($request->get("123456@!")),
            "otp" => $otp,
            "verified_otp" => 0,
            "firebase_token" => $request->firebase_token,
            "user_verified" => 1,
        ]);
        $user->assignRole('consumer');
        $token = JWTAuth::fromUser($user);/////////////////////

        $update = DB::table("users")
            ->where("id", $user->id)
            ->update(["remember_token" => $token]);
        if ($user != null && $user->count() > 0) {
            $phone = $user->mobile;
            $message = "Your OTP to log in to your account is" . " " . "$otp" . "." . " " . "Do not share your OTP with anyone. - Team WheelSniffer";


            $client = new Client();
            $url = "http://sendsms.designhost.in/index.php/smsapi/httpapi/";
            $response = $client->put($url, [
                'headers' => ['Content-type' => 'application/json'],
                'json' => ['uname' => 'wheelsniffer',
                    'password' => '654321',
                    'sender' => 'WHLSNF',
                    'tempid' => '1707165097449419397',
                    'receiver' => $phone,
                    'route' => 'TA',
                    'msgtype' => '1',
                    'sms' => $message,
                    'format' => 'json'
                ],
            ]);
            if ($response->getStatusCode() == 200) { // 200 OK

                $response_data = $response->getBody()->getContents();

            }


            $uname = 'wheelsniffer';
            $passwordd = '654321';
            $sender = 'WHLSNF';
            //  $tempid = '1707165097449419397';
            $route = 'TA';
            $msgtype = '1';

            if ($this->SendSms($phone, $message, $uname, $passwordd, $sender, $route, $msgtype)) {
                $notification->user_id = $user->id;
                $notification->title = "Consumer have Registered Successfully";
                $notification->message = $user->name . " " . "have registered as a consumer";
                $notification->type = "Cregister";
                $notification->save();
                return response()->json(
                    [
                        'status' => 1,
                        "message" => "User successfully registered",
                        "user" => $user,
                        'token' => $token
                    ],
                    201
                );

            }
        } else {
            return response()->json([
                "status" => 0,
                "responseCode" => "NP997",
                "message" => "User not found. please register first",
                "data" => json_decode("{}"),
            ]);
        }

    }

    public function authenticate(Request $request)
    {
        $status = 0;
        $message = "";

        $validator = Validator::make($request->all(), [
            // "mobile" => "required|string|max:10",
            "otp" => "required|string",
        ]);
        //$validator->errors()
        if ($validator->fails()) {
            return response()->json([
                "status" => $status,
                "responseCode" => "NP997",
                "message" => "invalid input details",
                "data" => json_decode("{}"),
            ]);
        }
        //echo $pwd = Hash::make($request->password).'      ='.$request->email; die;
        $validationChk = User::where('otp', $request->otp)->get();

        if ($validationChk->count() == 0) {
            return response()->json([
                "status" => $status,
                "responseCode" => "NP997",
                "message" => "invalid credentials",
                "data" => json_decode("{}"),
            ]);
        } elseif ($validationChk[0]->status != "1") {
            return response()->json([
                "status" => $status,
                "responseCode" => "NP997",
                "message" => "User not verified",
                "data" => json_decode("{}"),
            ]);
        }

        // $otp_time_stamp = (int) $validationChk[0]->otp_expiration_time;
        // $curr_time_stamp = time();
        // $diff = $curr_time_stamp - $otp_time_stamp;
        // $minute = ($diff / 60);
        // if($minute > 3){
        //   return response()->json(["status"=>$status,"responseCode"=>"NP997","message"=>"Otp is expired","data"=>json_decode("{}")]);
        // }

        // $credentials = $request->only('mobile', 'otp');
        $user = User::where("otp", "=", $request->otp)->where('mobile', $request->mobile)->first();


        // try {
        //   $myTTL = 43200; //minutes
        //   JWTAuth::factory()->setTTL($myTTL);
        //     if (! $token = JWTAuth::attempt($credentials, ['status'=>'1'])) {
        //         $message = 'invalid_credentials';
        //         return response()->json(['status'=>$status,"responseCode"=>"NP997",'message'=>$message,'data'=>json_decode("{}")]);
        //     }
        // } catch (JWTException $e) {
        //     $message = 'could_not_create_token';
        //     return response()->json(['status'=>$status,"responseCode"=>"NP997",'message'=>$message,'data'=>json_decode("{}")]);
        // }
        // $user  = JWTAuth::setToken($token)->toUser();

        // $social_id = $request->social_id;
        // $user = User::where('social_id', '=', $social_id)->where('email', '=', $request->email)->first();
        if ($user) {
            try {
                $myTTL = 43200; //minutes
                JWTAuth::factory()->setTTL($myTTL);

                // verify the credentials and create a token for the user
                if (!($token = JWTAuth::fromUser($user))) {
                    return response()->json(
                        ["error" => "invalid_credentials"],
                        401
                    );
                }
            } catch (JWTException $e) {
                // something went wrong
                return response()->json(
                    ["error" => "could_not_create_token"],
                    500
                );
            }
            // if no errors are encountered we can return a JWT
            $user = JWTAuth::setToken($token)->toUser();
            unset($user->otp);
            unset($user->verified_otp);
            $user->token = $token;
            $user->remember_token = $token;
            $user->firebase_token = (isset($request->firebase_token)) ? $request->firebase_token : '';

            // $user->device_id = (isset($request->device_id)) ? $request->device_id : '';
            //$this->SendSms($request->phone,'Welcome to LivFit Your OTP is: '.$otp);
            $user->save();
            unset($user->remember_token);
            $status = 1;

            // if(isset($user->userProfile)){
            //   foreach($user->userProfile as $k=>$v){
            //     if($v->default=='Y'){

            //       $user->language_id = $v->language_id;
            //       $user->district_id = $v->district_id;
            //       $user->class_id = $v->class_id;
            //       $user->school_id = $v->school_id;
            //     }
            //   }
            // }

            return response()->json([
                "status" => $status,
                "responseCode" => "APP001",
                "message" => $message,
                "data" => $user,
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "invalid credentials are wrong",
                "data" => "No User Found",
            ]);
        }
    }

    public function ConsumerLogin(Request $request)
    {
        $request->merge([
            "email" => $request->email,
            "password" => $request->password,
        ]);
        $credentials = $request->only("email", "password");

        try {
            $myTTL = 43200; //minutes
            JWTAuth::factory()->setTTL($myTTL);
            if (!($token = JWTAuth::attempt($credentials))) {
                return response()->json([
                    "status" => 0,
                    "message" => "invalid_credentials",
                    "data" => json_decode("{}"),
                ]);
            }
        } catch (JWTException $e) {
            $message = "could_not_create_token";
            return response()->json([
                "status" => 0,
                "message" => $message,
                "data" => json_decode("{}"),
            ]);
        }
        $user = JWTAuth::setToken($token)->toUser();

        return response()->json([
            "status" => 1,
            "token" => $token,
            "message" => "Consumer Login Successfully",
            "data" => $user,
        ]);
    }

    public function consumerLogout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::parseToken());
            //JWTAuth::setToken($token)->invalidate();
            return response()->json([
                "status" => 1,
                "message" => "Consumer Logout Successfully",
                "data" => json_decode("{}"),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 0,
                "responseCode" => "NP997",
                "message" => "Not able to logout",
                "data" => json_decode("{}"),
            ]);
        }
    }

    public function Setting()
    {
        $data = DB::table("cms")->get();
        return response()->json([
            "status" => 1,
            "message" => "All Content",
            "data" => $data,
        ]);
    }

    public function findDistance(Request $request)
    {
        //  return $request->pickup_lang;
        //  return $request->pickup_long;
        //  return $request->dropoff_lat;
        //  return $request->dropoff_lat;

        $sqlDistance = DB::raw('( 111.045 * acos( cos( radians(' . $request->pickup_lang . ') )
       * cos( radians( addresses.latitude ) )
       * cos( radians( addresses.longitude )
       - radians(' . $request->pickup_lang . ') )
       + sin( radians(' . $request->dropoff_lat . ') )
       * sin( radians( addresses.latitude ) ) ) )');
        return $sqlDistance;

    }

    public function splashScreen(Request $request)
    {
        $data = DB::table('splashscreens')->get();
        return response()->json(['status' => 1, 'message' => 'Data fetch Successfully', 'data' => $data]);

    }

    public function privacy()
    {
        $data = DB::table('settings')->select('privacy_policy')->first();
        return response()->json(['status' => 1, 'message' => 'Success', 'data' => $data]);

    }

    public function terms_condition()
    {
        $data = DB::table('settings')->select('terms_and_condition')->first();
        return response()->json(['status' => 1, 'message' => 'Success', 'data' => $data]);
    }

    public function faq()
    {
        $data = DB::table('settings')->select('faq')->first();
        return response()->json(['status' => 1, 'message' => 'Success', 'data' => $data]);
    }

    public function editConsumerProfile(Request $request)
    {
        $userr = JWTAuth::user();
        $user = User::find($userr->id);
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        try {
            $user->save();

            return response()->json([
                "status" => 1,
                "message" => "Consumer Profile Update Successfully",
                "data" => $user
            ]);

        } catch (Exception $e) {
            return response()->json([
                "status" => 0,
                "message" => "Unable to Update Consumer Profile",
                "data" => json_decode("{}")
            ]);
        }

    }

    public function support(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'message' => 'required',
            'name' => 'required'
        ]);
        $errors = json_decode(json_encode($validator->errors()));
        if (isset($errors->email[0])) {
            $message = $errors->email[0];
        } elseif (isset($errors->message[0])) {
            $message = $errors->message[0];
        } elseif (isset($errors->name[0])) {
            $message = $errors->name[0];
        }
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $message]);
        }
        $user = JWTAuth::user();
        $data = DB::table('supports')->insert([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ]);
        return response()->json(['status' => 1, 'message' => 'Success', 'data' => $data]);


    }

    public function convertAPNS(Request $request)
    {
        $url = "https://iid.googleapis.com/iid/v1:batchImport";
        $validate = Validator::make($request->input(), [
            "application" => "required",
            "apns_token" => "required",
        ]);
        if($validate->fails()){
            return response()->json($validate->errors()->all());
        }
        $data = $validate->validated();
        $params = [
            "application" => $data['application'],
            "sandbox" => true,
            "apns_tokens" => [
                $data[apns_token]
            ]
        ];
        $headers = [
            "Content-Type" => "application/json",
            "Authorization" => "key=".env('FCM_SERVER_KEY'),
        ];
        $response = Http::withHeaders($headers)->post($url, $params);
        return response()->json($response);
    }

}
