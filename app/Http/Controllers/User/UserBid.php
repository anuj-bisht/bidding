<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class UserBid extends Controller
{
    public function CreateBid(){
     $data['category']=DB::table('categories')->where('parent_category', 0)->get();
     $data['bid']=DB::table('userbids')->get();
        return view('user/bid/createbid', $data);
    }

    public function SubmitBid(Request $request){
        DB::table('userbids')->insert([
          'user_id'=>Auth::id(),
          'category_id'=>$request->category,
          'source'=>$request->source,
          'destination'=>$request->destination,
          'title'=>$request->title,
          'description'=>$request->description,
          'bid_end_date'=>$request->bid_end_date,
          'service_start_date'=>$request->service_start_date,
        ]);

           return redirect('/userdashboard')->with('bid_create', 'Bid Create Successfully');
       }
}
