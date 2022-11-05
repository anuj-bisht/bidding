<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Carbon;



class UserRegister extends Controller
{
    public function SellerRegister(){
        return view('user.sellerregister');
    }

    public function UserRegister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
         User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role'=>$request->role,
            'password' => Hash::make($request->password),
        ]);
        return back()->with('BidderRegister','You are Successfully Register');
    }


    public function UserLoginForm(){
        return view('user.userloginform');
    }
    public function UserDashboard(){

            $data['category']=DB::table('categories')->get();
            $data['bid']=DB::table('userbids')->get();


        return view('user.dashboard', $data);

    }

}
