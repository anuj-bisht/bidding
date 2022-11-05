<?php

namespace App\Http\Controllers\v1\Provider;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\Common;
use App\Models\Notification;
use App\Models\Provider;
use App\Models\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class UserController extends Controller
{
    use Common;

    public function ProviderRegister(Request $request, Notification $notification)
    {

        $status = 0;

        $messagee = "";
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required|string|max:255",
                "email" => "required|string|email|max:100|unique:users",
                "mobile" => "required|string|min:10|max:10|unique:users",
                'category_id' => 'required'


            ]);

            $data = [];
            //  $data['email'] = $request->get('email');
            //  $data['name'] = $request->get('name');
            //  $data['supportEmail'] = config('mail.supportEmail');
            //  $data['website'] = config('app.site_url');
            //  $data['site_name'] = config('app.site_name');

            // $data['subject'] = 'Registration OTP from '.config('app.site_name');
            $otp = rand(111111, 999999);
            //$otp = 123456;

            $data["otp"] = $otp;

            if ($validator->fails()) {
                $error = json_decode(json_encode($validator->errors()));
                if (isset($error->email[0])) {
                    $message = $error->email[0];
                }
                if (isset($error->mobile[0])) {
                    $message = $error->mobile[0];
                }
                if (isset($error->category_id[0])) {
                    $message = $error->category_id[0];
                }
                return response()->json(['status' => 0, 'message' => $message, 'data' => []]);

            }


            $user = User::create([
                "name" => $request->get("name"),
                "email" => $request->get("email"),
                "mobile" => $request->get("mobile"),
                "password" => Hash::make($request->get("123456@!")),
                "verified_otp" => 0,
                "role" => 3,
                "otp" => $otp,
                "firebase_token" => $request->firebase_token,
                "user_verified" => 1,
            ]);

            $token = JWTAuth::fromUser($user);
            $message = "Your OTP to log in to your account is" . " " . "$otp" . "." . " " . "Do not share your OTP with anyone. - Team WheelSniffer";
            $phone = $request->mobile;

            //JWTAuth::setToken($token);
            DB::table("users")
                ->where("id", $user->id)
                ->update(["remember_token" => $token]);
            // $cat = str_replace('[','',$request->category);
            // $cat = str_replace(']','',$cat);
            // $cat = explode(',',$cat);
            // $cat = str_replace(' ','',$cat);
            // $cat = array_unique($cat);
            // $cat = implode(',',$cat);
            // $cat = "[".$cat."]";
            if ($request->hasFile('aadhar_image')) {
                $image = $request->aadhar_image;
                $file = time() . '.' . $request->aadhar_image->extension();
                $aadh = $image->move('Provider/Profile', $file);
            } else {
                $file = '';

            }

            if ($request->hasFile('gst_image')) {
                $image = $request->gst_image;
                $filename = time() . '.' . $request->gst_image->extension();
                $gstt = $image->move('Provider/Profile', $filename);
            } else {
                $filename = '';

            }
            if ($request->hasFile('pan_image')) {
                $image = $request->pan_image;
                $panfilename = time() . '.' . $request->pan_image->extension();
                $pann = $image->move('Provider/Profile', $panfilename);
            } else {
                $panfilename = '';

            }


            $cat = str_replace('[', '', $request->category_id);

            $cat = str_replace(']', '', $cat);
            $cat = "[" . $cat . "]";
            $ProviderProfile = new Provider();
            $ProviderProfile->user_id = $user->id;
            $ProviderProfile->category_id = $cat;
            $ProviderProfile->organisation_name = $user->name;
            $ProviderProfile->organisation_email = $user->email;
            $ProviderProfile->address = 'nil';

            $ProviderProfile->mobile = $user->mobile;
            //$data->gst_image=$filename?url('/').'/'.$gs:$filename;

            $ProviderProfile->gst_image = $filename ? url('/') . '/' . $gstt : $filename;
            $ProviderProfile->pan_image = $panfilename ? url('/') . '/' . $pann : $panfilename;
            $ProviderProfile->aadhar_image = $file ? url('/') . '/' . $aadh : $file;

            if ($ProviderProfile->save()) {
                if (!empty($ProviderProfile->gst_image) || !empty($ProviderProfile->pan_image) || !empty($ProviderProfile->aadhar_image)) {
                    DB::table("users")
                        ->where("id", $user->id)
                        ->update(["user_verified" => 1]);

                } else {

                    DB::table("users")
                        ->where("id", $user->id)
                        ->update(["user_verified" => 0]);


                }
                $wallet = DB::table('wallets')->insert(['user_id' => $user->id, 'points' => 10]);

                $userr = DB::table('users')->where('id', $user->id)->first();
                $messagee = "User Registered Successfully";
                // return response()->json([
                //     "status" => 1,
                //     "message" => $message,
                //     "data" => $userr,
                // ])
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
                    DB::commit();
                    $notification->user_id = $user->id;
                    $notification->title = "Provider have Registered Successfully";
                    $notification->message = $user->name . " " . "have registered as a provider";
                    $notification->type = "Pregister";
                    $notification->save();
                    return response()->json(["status" => 1, "message" => $messagee, "data" => $userr]);
                } else {
                    return response()->json([
                        "status" => 0,
                        "responseCode" => "NP997",
                        "message" => "User not found. please register first",
                        "data" => json_decode("{}"),
                    ]);
                }
                DB::commit();
                //  $diviceIds = [$request->device_token];
                //  if(isset($diviceIds)){
                //               $suscription_title = "User Registration";
                //               $suscription_msg = "User Registered Successfully";
                //               $this->sendNotification($diviceIds,'',$suscription_title,$suscription_msg);
                //               Mail::to($request->get('email'))->send(new RegistrationMail(['user'=>$user,'password'=>$request->get('123456@!')]));
                //       }

            } else {
                return response()->json([
                    "status" => 0,
                    "message" => "Unable to send Provider Detail",
                    "data" => json_decode("{}"),
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                "status" => 0,
                "message" => $e->getMessage(),
                "data" => json_decode("{}"),
            ]);
        }
    }

    public function editDocuments(Request $request)
    {
        $user = JWTAuth::user();
        if (!isset($user)) {
            return response()->json([
                "status" => 0,
                "message" => 'User Not Found',
                "data" => json_decode("{}"),
            ]);

        }
        $filename = '';
        $panfilename = '';
        $file = '';

        if ($request->hasFile('aadhar_image')) {
            $image = $request->aadhar_image;
            $file = time() . '.' . $request->aadhar_image->extension();
            $aa = $image->move('Provider/Profile', $file);
        } else {
            $file = '';

        }

        if ($request->hasFile('gst_image')) {
            $image = $request->gst_image;
            $filename = time() . '.' . $request->gst_image->extension();
            $gs = $image->move('Provider/Profile', $filename);
        } else {
            $filename = '';

        }
        if ($request->hasFile('pan_image')) {
            $image = $request->pan_image;
            $panfilename = time() . '.' . $request->pan_image->extension();
            $pa = $image->move('Provider/Profile', $panfilename);
        } else {
            $panfilename = '';

        }

        $user = JWTAuth::user();
        $data = Provider::where('user_id', $user->id)->first();
        $data->gst_image = $filename ? url('/') . '/' . $gs : $filename;
        $data->pan_image = $panfilename ? url('/') . '/' . $pa : $panfilename;
        $data->aadhar_image = $file ? url('/') . '/' . $aa : $file;
        try {
            if ($data->save()) {
                DB::table('users')->where('id', $data->user_id)->update(['user_verified' => 1]);
                return response()->json([
                    "status" => 1,
                    "message" => "Provider Document Updated Successfully",
                    "data" => 1
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => 0,
                "message" => "Unable to update Provider Document",
                "data" => json_decode("{}")
            ]);
        }

    }

    public function editProviderProfile(Request $request)
    {

        $userr = JWTAuth::user();
        $user = User::find($userr->id);
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
//           return response()->json($request->all());
        try {
            $user->save();


            $provider = Provider::where('user_id', $user->id)->first();
            $provider->organisation_name = $user->name;
            $provider->mobile = $user->mobile;
            $provider->organisation_email = $user->email;
            if($request->has('category_id')){
                $cat = str_replace('[', '', $request->category_id);

                $cat = str_replace(']', '', $cat);
                $cat = "[" . $cat . "]";
                $provider->category_id = $cat;
            }


            try {
                $provider->save();

                return response()->json([
                    "status" => 1,
                    "message" => "Provider Profile Updated Successfully",
                    "data" => $user
                ]);

            } catch (Exception $e) {
                return response()->json([
                    "status" => 0,
                    "message" => "Unable to update Provider Profile",
                    "data" => json_decode("{}")
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => 0,
                "message" => "Unable to update Provider",
                "data" => json_decode("{}")
            ]);
        }

    }

    public function getMyProfile(Request $request)
    {
        try {
            $status = 1;
            $message = "";

            $user = JWTAuth::user();
            if (!isset($user)) {
                return response()->json(['status' => 0, 'message' => 'User does not exist', 'data' => json_decode("{}")]);
            }
            $userr = DB::table('users')->where('users.id', $user->id)
                ->join('providers', 'providers.user_id', 'users.id')
                ->select('users.name', 'users.mobile', 'users.email', 'providers.gst_image', 'providers.pan_image', 'providers.aadhar_image', 'providers.category_id', 'providers.gst_verified', 'providers.pan_verified', 'providers.aadhar_verified')->first();
            $ids = json_decode($userr->category_id);
            $users['provider_name'] = $userr->name;
            $users['provider_email'] = $userr->email;
            $users['provider_mobile'] = $userr->mobile;
            $users['provider_gst_image'] = $userr->gst_image;
            $users['provider_aadhar_image'] = $userr->aadhar_image;
            $users['provider_pan_image'] = $userr->pan_image;
            $users['gst_verified'] = $userr->gst_verified;
            $users['pan_verified'] = $userr->pan_verified;
            $users['aadhar_verified'] = $userr->aadhar_verified;

            $users['category'] = DB::table('categories')->whereIn('id', $ids)->select('id', 'category', 'icon')->get();

            return response()->json(['status' => $status, 'Provider Detail' => '', 'data' => $users]);


        } catch (Exception $e) {
            return response()->json(['status' => 0, 'message' => $e->getMessage(), 'data' => json_decode("{}")]);
        }

    }

}
  public function deleteConsumerAccount(Request $request){
        $user = JWTAuth::user();

          if (!isset($user)) {
              return response()->json(['status' => 0, 'message' => 'User does not exist', 'data' => json_decode("{}")]);
          }
          try{
            if(DB::table('supports')->where('user_id',$user->id)->exists()){
                DB::table('supports')->where('user_id',$user->id)->delete();
            }
              if(DB::table('notifications')->where('user_id',$user->id)->exists()){
                  DB::table('notifications')->where('user_id',$user->id)->delete();
              }
              if(DB::table('userbids')->where('user_id',$user->id)->exists()){
                  DB::table('userbids')->where('user_id',$user->id)->delete();
              }

              if(DB::table('users')->where('id',$user->id)->exists()){
                  DB::table('users')->where('id',$user->id)->delete();
              }
                  return response()->json(['status' => 1, 'Message' => 'Account Deleted Successfully', 'data' => 1]);

          }
          catch(Exception $e){
               return response()->json(['status' => 0, 'message' => $e->getMessage(), 'data' => json_decode("{}")]);
          }
  }

}
