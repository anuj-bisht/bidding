<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    public function index(Plan $plan, Request $request)
    {

        $plan['plans']=$plan->all();
        return view('admin/plan/index', $plan);
    }

    public function changeStatus($plan_id, $status){
        if($status=='no'){
            DB::table('plans')->where('id', $plan_id)->update(['status'=> 0]);
        }else{
            DB::table('plans')->where('id', $plan_id)->update(['status'=> 1]);

        }
    }

    public function editPlan(Request $request,  $id){

        $data['plan']=DB::table('plans')->where('id', $id)->first();
         return view('admin/plan/edit', $data);
    }
    public function updatePlan(Request $request){
        // if($request->hasFile('plan_image')){
        //     $image=$request->plan_image;
        //     $filename = time().rand(0,10000).'.'.$request->plan_image->extension();
        //    $path= $image->move('Icon', $filename);


        // }else{
        //     $filename=$request->icon;
        // }
        $data['plan']=DB::table('plans')->where('id', $request->id)->update([
            'plan_name'=>$request->name,
            'description'=>$request->plan_description,
            'plan_rate'=>$request->price,
            'coins'=>$request->coins
            // 'days'=>$request->days,
            // 'image'=>url('/').'/'.$path
        ]);

        return redirect('/allPlans');
    }
    public function deletePlan($id){
        $data=DB::table('plans')->where('id',$id)->delete();
        return redirect('/allPlans');

    }
    public function submit(Request $request){
        DB::table('plans')->insert(['plan_name'=>$request->plan_name,'description'=>$request->description,'plan_rate'=>$request->plan_rate,'coins'=>$request->coins]);
        return redirect('/allPlans');
    }
}
