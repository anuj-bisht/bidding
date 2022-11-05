<?php

namespace App\Http\Controllers\v1\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(){
        $category=DB::table('categories')->where('status',1)->select('category', 'id', 'icon')->get();
        return response()->json(['status'=>true, 'message'=>'Category Fetch Successfully', 'data'=> $category]);
    }
}
