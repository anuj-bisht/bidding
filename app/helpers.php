<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

function ConsumerCount(){
    $Consumercount=DB::table('users')->where('role',2)->count();
    return $Consumercount;
}

function ProviderCount(){
    $Providercount=DB::table('users')->where('role', 3)->count();
    return $Providercount;
}

function VehicleCount(){
    $Vehiclecount=DB::table('vehicles')->count();
    return $Vehiclecount;
}
function ConsumerTotalPayment(){
    $Consumertotalpayment=DB::table('order')->where('status',1)->where('consignment_id','>',0)->sum('amount');
    return $Consumertotalpayment;
}

function ProviderTotalPayment(){
    $Providertotalpayment=DB::table('order')->where('status',0)->where('plan_id','>',0)->sum('amount');
    return $Providertotalpayment;
}
function TotalConsignment(){
    $TotalConsignment=DB::table('userbids')->count();
    return $TotalConsignment;
}
function TotalBids(){
    $TotalBids=DB::table('applybids')->count();
    return $TotalBids;
}
function pendingConsignment(){
    $pendingConsignment=DB::table('userbids')->where('status','pending')->count();
    return $pendingConsignment;
}
function InprogressConsignment(){
    $InprogressConsignment=DB::table('userbids')->where('status','Inprogress')->count();
    return $InprogressConsignment;
}
function notificationCount(){
    $notificationCount=DB::table('notifications')->where('type','Cregister')->orWhere('type','Pregister')->count();
 return $notificationCount;
}
function allNotification(){
    $allNotification=DB::table('notifications')->where('type','Cregister')->orWhere('type','Pregister')->select('user_id','message')->get();
 return $allNotification;
}

