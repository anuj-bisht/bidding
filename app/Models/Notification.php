<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    public static function saveNotification($data=[]){
        $obj = new Notification();
        $obj->title = (isset($data['title'])) ? $data['title']:'';
        $obj->user_id = (isset($data['user_id'])) ? $data['user_id']: 1;
        $obj->message = (isset($data['message'])) ? $data['message']: '';
        $obj->type = (isset($data['type'])) ? $data['type']: 'Normal';
        if($obj->save()){
            return true;
        }else{
            return false;
        }
    }

}
