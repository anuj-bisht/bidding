<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class PackageExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      return   DB::table('userbids')
                     ->where('userbids.category_id', 3)
                     ->join('userpackages', 'userpackages.userbid_id', 'userbids.id')
                     ->join('categories', 'categories.id', 'userbids.category_id')
                     ->join('users', 'users.id', 'userbids.user_id')
                     ->join('vehicles', 'vehicles.id', 'userpackages.vehicle_id')
                     ->join('flats', 'flats.id', 'userpackages.flat_type')
                      ->select( 'users.name','users.email', 'users.mobile','categories.category','userbids.source_address','userbids.destination_address','userbids.source_lat','userbids.source_long', 'userbids.destination_long', 'userbids.destination_lat',
                       'userbids.ETA','userbids.distance','userbids.status','userpackages.order_id','userpackages.description','userpackages.date_of_shifting as start_date','userpackages.end_date','flats.flat_type',
                         'vehicles.name as vehicle_name')->latest('userbids.created_at')->get();
    }
    public function headings(): array
    {
        return ["Name","Email","Mobile","Category","Source Address","Destination Address","Source Lat","Source Long","Destination Long","Destination Lat",
                "ETA","Distance","Status","Order ID","Description","Shifting Date", "Service End Date", "Flat Type","Vehicle Name"];
    }
}
