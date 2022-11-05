<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class VehicleExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       return DB::table('vehicles')->join('categories','categories.id','vehicles.category_id')
              ->select('vehicles.name as vehicle_name','vehicles.vehicle_icon', 'vehicles.per_KM', 'categories.category')->get();
    }
    public function headings(): array
    {
        return ["Vehicle Name","Vehicle Icon","Per KM Price","Vehicle Category"];
    }
}
