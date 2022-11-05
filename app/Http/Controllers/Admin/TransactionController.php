<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function providerTransaction(){
        $data['pl']=DB::table('order')->where('consignment_id',0)
              ->join('users','users.id','order.user_id')
              ->join('plans','plans.id','order.plan_id')
            ->select('order.order_id','order.amount','order.status','users.name','users.mobile','users.email','plans.plan_name','plans.coins')
            ->paginate(15);
        return view('admin/transaction/provider',$data);
    }

          public function consumerTransaction(){
        $data['cl']=DB::table('order')->where('plan_id',0)
              ->join('users','users.id','order.user_id')
            ->select('order.order_id','order.amount','order.status','users.name','users.mobile','users.email')->get();
        return view('admin/transaction/consumer',$data);
    }
}
