<?php

namespace App\Http\Controllers\Traits;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Config;
use DB;
trait Common {
    protected function DateDiff($data_from,$date_to) {
        try{
            $t1 = strtotime(date('Y-m-d H:i:s'));
            $t2 = strtotime($date_to);
            $diff = $t2 - $t1;
            $hours = $diff / ( 60 * 60 );
            $hourFraction = $hours - (int)$hours;
            $minute = number_format($hourFraction*60,0);
            $data = floor($hours).':'.$minute;
            return $data;
          }catch(Exception $e){
            return 0;
          }
    }

    protected function SendSms($phone,$message,$uname,$passwordd,$sender,$route,$msgtype) {
        try{
            // $url = "https://api.msg91.com/api/sendhttp.php?mobiles=$phone&authkey=298624AWJzQa0Z8n5da2dd16&route=4&sender=TRFVFT&message=$message&country=91";
            $urll = "http://sendsms.designhost.in/index.php/smsapi/httpapi/?uname=$uname&password=$passwordd&sender=$sender&receiver=$phone&route=$route&msgtype=$msgtype&sms=$message";
            if(file_get_contents($urll)){
              return true;
            }
          }catch(\Exception $e){
            return $e->getMessage();
          }
    }
  protected function sendNotification($registration_ids,$title,$message) {
        $url = 'https://fcm.googleapis.com/fcm/send';
        //FCM requires registration_ids array to have correct indexes, starting from 0
        $registration_id = [$registration_ids];

        $fields = array(
          //'to' => $deviceToken,
          'registration_ids' => $registration_id,
          'notification'=> array( "body" => $message,"title"=>$title)

        );
        $headers = array(
            'Authorization:key=AAAAbtrh-nI:APA91bFYEOb0NJ4773nFPm7IJTgi1nBtceSY9CiGckUCwvNu4yi4gUomzLqmgBBOGmwq7scXNkInWk7VWFta0NgMkQXB0__x3XT_1GeZIKuOd8ItRd0mS0_D4DBQXSOqIyNVeIyVNHld',//.Config('app.GOOGLE_API_KEY'),
          'Content-Type: application/json'
        );

        $ch= curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $res = curl_exec($ch);

        //dd($fields, $res, $headers);
        if($res === false)
        // die('Curl failed ' . curl_error());

      curl_close($ch);
      return $res;


    }

 protected function sendNotificationn($registration_ids,$title,$message) {
        $url = 'https://fcm.googleapis.com/fcm/send';
        //FCM requires registration_ids array to have correct indexes, starting from 0
        $registration_id = [$registration_ids];

        $fields = array(
          //'to' => $deviceToken,
          'registration_ids' => $registration_id,
          'notification'=> array( "body" => $message,"title"=>$title)

        );
        $headers = array(
                    'Authorization:key=AAAAbtrh-nI:APA91bFYEOb0NJ4773nFPm7IJTgi1nBtceSY9CiGckUCwvNu4yi4gUomzLqmgBBOGmwq7scXNkInWk7VWFta0NgMkQXB0__x3XT_1GeZIKuOd8ItRd0mS0_D4DBQXSOqIyNVeIyVNHld',//.Config('app.GOOGLE_API_KEY'),
          'Content-Type: application/json'
        );

        $ch= curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $res = curl_exec($ch);

        //dd($fields, $res, $headers);
        if($res === false)
        // die('Curl failed ' . curl_error());

      curl_close($ch);
      return $res;


    }

     protected function commonQueryArr(){
      $params = ['status'=>false,'get_result'=>false];
      return $params;
    }

}

