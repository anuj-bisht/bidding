<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    public static function getSubsByPlan($plan_id,$user_id){
        return Self::select('subscriptions.*','users.name as username',
        'plans.plan_name as plan_name','plans.plan_rate as plan_price',
        'plans.days as plan_days','plans.description as plan_description')
        ->join('users','users.id','=','subscriptions.user_id')
        ->join('plans','plans.id','=','subscriptions.plan_id')
        ->where('users.id',$user_id)
        ->where('subscriptions.plan_id',$plan_id)
        ->where('subscriptions.status','active')
        ->first();
    }

}
