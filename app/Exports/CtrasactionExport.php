<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
class CtrasactionExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
     return   DB::table('order')->where('plan_id',0)
              ->join('users','users.id','order.user_id')
            ->select('order.order_id','order.amount','order.status','users.name','users.mobile','users.email')->get();
    }
    public function headings(): array
    {
        return ["Order ID","Order Amount","Order Status","Username","Phone","Email"];
    }
}
