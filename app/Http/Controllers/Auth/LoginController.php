<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo(){
        if(Auth::user()->role==1){
           return redirect('/home');
        }
        elseif(Auth::user()->role==2){
            return redirect('/userdashboard');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request){
        $input=$request->all();
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);
   if(auth()->attempt(array('email'=>$input['email'], 'password'=>$input['password']))){
   	
         if(auth()->user()->role == 1){
         
             $request->session()->put('id' , auth()->user()->id);
            return redirect('/home');
         }
         elseif(auth()->user()->role == 2){
            $request->session()->put('name' , auth()->user()->name);
            return redirect('/userdashboard');

         }
   }else{
       return back()->withErrors(['error'=> 'Email or Password are Wrong']);
   }
    }

    public function UserLogin(Request $request){
        $input=$request->all();
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);
   if(auth()->attempt(array('email'=>$input['email'], 'password'=>$input['password']))){
        //  if(auth()->user()->role == 1){
        //      $request->session()->put('id' , auth()->user()->id);
        //     return redirect('/home');
        //  }
         if(auth()->user()->role == 2){
            $request->session()->put('name' , auth()->user()->name);
            return redirect('/userdashboard');

         }
   }else{
       return back()->withErrors(['error'=> 'Email or Password are Wrong']);
   }
    }
 public function logout(Request $request){
   Auth::logout();
   return redirect('/login');
}
}
