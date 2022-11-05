<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContentManagement extends Controller
{
    public function index(){
        $cms['data']=DB::table('settings')->get();
        return view('admin.cms.index', $cms);
    }
    public function create(){
        // $cms['data']=DB::table('cms')->get();
        return view('admin.cms.create');
    }
    public function submit(Request $request){
        DB::table('cms')->insert([
            'code'=>$request->code,
            'name'=>$request->name,
            'title'=>$request->title,
            'description'=>$request->description,
            'status'=>1
        ]);
        return redirect('cms');

   }

   public function editCms(Request $request, $id){
    $data['cms']=DB::table('settings')->where('id', $id)->first();

    return view('admin/cms/edit', $data);
}
public function updateCms(Request $request){

    $data['cms']=DB::table('settings')->where('id', $request->id)->update([
        'privacy_policy'=>$request->privacy_policy,
        'faq'=>$request->faq,
        'terms_and_condition'=>$request->terms_and_condition


    ]);

    return redirect('cms');
}
}
