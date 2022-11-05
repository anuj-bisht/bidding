<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use app\Models\User;
use Illuminate\Support\Facades\DB;

class ConsumerConsignmentController extends Controller
{
    public function index(){
    $user['data']= User::where('role',2)->select('id','name','email','mobile')->paginate(15);
    return view('admin/consumerconsignment/index', $user);
    }
}
