<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use app\Models\User;
use Illuminate\Support\Facades\DB;

class ProviderConsignmentController extends Controller
{
    public function index(){
        $user['data']= User::where('role',3)->select('id','name','email','mobile')->paginate(15);
        return view('admin/providerconsignment/index', $user);
        }
}
