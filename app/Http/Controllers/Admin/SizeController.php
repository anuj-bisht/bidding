<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Size;
class SizeController extends Controller
{
    public function index(){
      $data['veh']=  DB::table('sizes')
        ->join('vehicles', 'vehicles.id', '=', 'sizes.vehicle_id')
        ->select('vehicles.name as name', 'sizes.size as size', 'sizes.vehicle_id as vehicle', 'sizes.id')
        ->get();
       return view('admin/size.index', $data);
    }

    public function create(){
       $data['vehicle']=DB::table('vehicles')->where('category_id',2)->get();
       $data['category']=DB::table('categories')->get();
        return view('admin.size.create', $data);
    }
    public function submit(Request $request){
        DB::table('sizes')->insert([
         'size'=>$request->size.' '.'feet',
         'vehicle_id'=>$request->vehicle_id
         
        ]);
         return redirect('/vehiclesize');
     }

     public function edit( $id){

        $data['veh']=DB::table('sizes')->where('id', $id)->first();
        $data['vehicle']=DB::table('vehicles')->get();
     
        return view('admin/size/edit', $data);
    }
  public function delete($id){

        $data['veh']=DB::table('sizes')->where('id', $id)->delete();


        return redirect('/vehiclesize');
    }
    public function update(Request $request){
    $vehicle_id=($request->vehicle_id)?$request->vehicle_id:$request->vehicl_id;
        $data['vehicle']=DB::table('sizes')->where('id', $request->id)->update([
            'size'=>$request->size.' '.'feet',
            'vehicle_id'=>$vehicle_id
           
        ]);

        return redirect('/vehiclesize');
    }
}
