<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\User;

class ParticularTransportConsignmentExport implements FromCollection
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


                return   $transport=DB::table('userbids')
                ->where('userbids.user_id', $user->id)
                ->where('userbids.category_id', 2)
                ->join('usertransports', 'usertransports.userbid_id', 'userbids.id')
                ->join('categories', 'categories.id', 'userbids.category_id')
                 ->join('users', 'users.id', 'userbids.user_id')
                ->join('sizes', 'sizes.id', 'usertransports.vehicle_size_id')
                 ->join('vehicles', 'vehicles.id', 'sizes.vehicle_id')
                 ->select('userbids.id as consignment_id','userbids.source_address','userbids.destination_address','userbids.ETA',
                        'userbids.distance','userbids.status','usertransports.vehicle_bodytype','usertransports.description','usertransports.order_id', 'usertransports.weight','usertransports.shifting_date as start_date','usertransports.loading_and_unloading', 'categories.category','categories.id as category_id',
                         'users.name as username','users.mobile as user_mobile', 'users.email as user_email', 'sizes.size as vehicle_size', 'vehicles.name as vehicle_name','vehicles.vehicle_icon as vehicle_icon')
                         ->latest('userbids.created_at')->get();
    }
}
