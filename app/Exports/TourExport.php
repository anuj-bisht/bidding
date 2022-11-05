<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class TourExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('users')->where('users.role',2)
               ->join('userbids','userbids.user_id','users.id')
               ->join('usertours','usertours.userbid_id','userbids.id')
               ->join('categories','categories.id','userbids.category_id')
               ->join('vehicles','vehicles.id','usertours.vehicle_id')
               ->select('users.name','users.email','users.mobile','categories.category','userbids.source_address',
               'userbids.destination_address','userbids.source_lat','userbids.source_long','userbids.destination_lat',
               'userbids.destination_long','userbids.distance','userbids.ETA','userbids.status',
               'usertours.order_id','usertours.description','usertours.date_of_travel','usertours.end_date',
               'usertours.number_of_passenger','vehicles.name as vehicle_name',)->get();
    }
    public function headings(): array
    {
        return ["Name","Email","Mobile","Category","Source Address","Destination Address","Source Lat","Source Long","Destination Lat","Destination Long",
                "Distance","ETA","Status","Order ID","Description","Date Of Travel", "Service End Date", "Number Of Passenger","Vehicle Name"];
    }
}
