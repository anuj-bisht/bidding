<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryController extends Controller
{
    public function index(){
    $data['support']=DB::table('supports')->get();
    return view('admin/support/index', $data);
    }
}
