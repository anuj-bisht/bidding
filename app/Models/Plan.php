<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    public static function getPlanById($plan_id){

        return Self::select('plans.*')->where('plans.id',$plan_id)
        ->first();
    }
}
