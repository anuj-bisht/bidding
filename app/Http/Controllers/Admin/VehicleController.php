<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    public function index(Vehicle $key, Request $request)
    {
        if($request->has('vehicleFilter')){
            $transport['vehicle']=$key->join('categories', 'categories.id', 'vehicles.category_id')
                                    ->where('vehicles.category_id', $request->get('vehicleFilter'))->get();
        }else{
            $transport['vehicle']=$key->join('categories', 'categories.id', 'vehicles.category_id')->get();
        }

        $transport['category']=DB::table('categories')->get();
         return view('admin/vehicle/index', $transport );
    }

    public function create(){
        $data['category']=DB::table('categories')->get();
        return view('admin.vehicle.create', $data);
    }
    public function submit(Request $request){
        if($request->hasFile('vehicle_icon')){
            $image=$request->vehicle_icon;
            $filename = time().'.'.$request->vehicle_icon->extension();
            $name=$image->move('vehicle', $filename);
        }
        DB::table('vehicles')->insert([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
	    'per_KM'=>$request->KM,
            'vehicle_icon'=>url('/').'/'.$name
        ]);
        return redirect('vehicles');
   }

   public function edit(Request $request,Vehicle $id){
    $data['vehicle']=$id;
    $data['category']=DB::table('categories')->get();
    return view('admin/vehicle/edit', $data);
}

public function update(Request $request){
    if($request->hasFile('vehicle_icon')){
        $image=$request->vehicle_icon;
        $filename = time().'.'.$request->vehicle_icon->extension();
        $name=$image->move('vehicle', $filename);
    }else{
        $name=$request->vehicle_icon;
    }
    $data['vehicle']=DB::table('vehicles')->where('id', $request->id)->update([
        'name'=>$request->name,
        'category_id'=>$request->category_id,
        'per_KM'=>$request->KM,
        'vehicle_icon'=>url('/').'/'.$name
    ]);

    return redirect('vehicles');
}
public function delete($id){
    $data=DB::table('vehicles')->where('id', $id)->delete();
    $d=DB::table('sizes')->where('vehicle_id',$id)->delete();
    return redirect('vehicles');

}
}
