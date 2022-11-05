<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class TransportExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      return   DB::table('userbids')
                ->where('userbids.category_id', 2)
                ->join('usertransports', 'usertransports.userbid_id', 'userbids.id')
                ->join('categories', 'categories.id', 'userbids.category_id')
                ->join('users', 'users.id', 'userbids.user_id')
                ->join('sizes', 'sizes.id', 'usertransports.vehicle_size_id')
                ->join('vehicles', 'vehicles.id', 'sizes.vehicle_id')
                ->select('users.name','users.email','users.mobile','categories.category','userbids.source_address','userbids.destination_address',
                         'userbids.source_lat','userbids.source_long', 'userbids.destination_long', 'userbids.destination_lat',
                        'userbids.ETA','userbids.distance','userbids.status','usertransports.order_id','usertransports.description',
                        'usertransports.weight','usertransports.shifting_date as start_date','usertransports.end_date',
                        'usertransports.loading_and_unloading','sizes.size as vehicle_size', 'vehicles.name as vehicle_name','usertransports.vehicle_bodytype')
                         ->get();
    }
    public function headings(): array
    {
        return ["Name","Email","Mobile","Category","Source Address","Destination Address","Source Lat","Source Long","Destination Long","Destination Lat",
                "ETA","Distance","Status","Order ID","Description","Material Weight","Shifting Date", "Service End Date", "Loading And Unloading","Vehicle Size","Vehicle Name","Vehicle Body Type"];
    }
}
