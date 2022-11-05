<?php

namespace App\Exports;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('users')->join('providers','users.id','providers.user_id')->where('users.role',3)->select('users.name','users.email','users.mobile',"providers.pan_image","providers.gst_image","providers.aadhar_image")->get();
    }
    public function headings(): array
    {
        return ["Name","Email","Phone","Pan Image","GST Image","Aadhar Image"];
    }
}
