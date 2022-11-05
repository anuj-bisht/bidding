<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\User;

class ParticularUserConsignmentExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($id){
    $this->id=$id;

    }
    public function collection()
    {
        $user=User::find($this->id);
        $user_history=DB::table('userbids')->where('userbids.user_id', $user->id)->get();


                return  $tour=DB::table('userbids')
                  ->where('userbids.user_id', $user->id)
                 ->where('userbids.category_id', 1)
                 ->join('usertours','usertours.userbid_id', 'userbids.id')
                 ->join('categories', 'categories.id', 'userbids.category_id')
                 ->join('users', 'users.id', 'userbids.user_id')
                 ->join('vehicles', 'vehicles.id', 'usertours.vehicle_id')
                  ->select('userbids.id as consignment_id','userbids.source_address','userbids.destination_address','userbids.ETA',
                  'userbids.distance','userbids.status', 'categories.category','categories.id as category_id','users.name as username','users.mobile as user_mobile', 'users.email as user_email',
                  'usertours.date_of_travel as start_date', 'usertours.end_date','usertours.description','usertours.order_id', 'usertours.number_of_passenger', 'vehicles.name','vehicles.vehicle_icon as vehicle_icon')
                  ->latest('userbids.created_at')->get();


        }



}
