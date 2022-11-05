<?php

namespace App\Http\Controllers\v1\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use GuzzleHttp\Client;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Provider;
use Exception;

class PlanController extends Controller
{
    public function getAllPlan(){
      $user=JWTAuth::user();
      if($user->role=='3'){
       $data=DB::table('plans')->where('status',1)->select('id as plan_id','plan_name', 'description', 'plan_rate','coins', 'image')->get();
       return response()->json(['staus'=>1, 'message'=>'All Plans', 'data'=>$data]);
    }else{
        return response()->json(['staus'=>0, 'message'=>'This plans only for Provider', 'data'=>[]]);

    }
}
}
