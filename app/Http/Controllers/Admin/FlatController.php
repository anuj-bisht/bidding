<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flat;
use Illuminate\Support\Facades\DB;

class FlatController extends Controller
{
     public function index(Flat $flat){
       $flat['data']=$flat->all();
       return view('admin/flat/index', $flat );
    }

    public function delete($id){
        DB::table('flats')->where('id', $id)->delete();
         return redirect('/allflat');
     }

     public function create(){

        return view('admin/flat/create');
     }
     public function submit(Request $request){
        DB::table('flats')->insert(['flat_type'=>$request->flat]);

        return redirect('/allflat');
     }

}
