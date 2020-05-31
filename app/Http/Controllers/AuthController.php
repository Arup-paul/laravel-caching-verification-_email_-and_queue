<?php

namespace App\Http\Controllers;

use App\Mail\VerificationEmail;
use Illuminate\Http\Request;
use Validator;
use App\User;
use Auth;
use Str;
use Mail;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    //

    public function showRegistration(){
        $data = [];

        $data['site_title'] = "RioTheme";
        return view('frontend.register',$data);
    }

    public function processRegistration(Request $request){

       //validation
       $Validator = Validator::make($request->all(),[
        'name' =>'required|min:4',
        'email'=> 'required|email|unique:users',
        'password'=>'required|min:6|confirmed'
       ],[
           'name.required' => 'We Need To Know Your Full Name!',
           'email.required' => 'Must be Your Valid Email!',
           'password.required' => 'Must Strong Password Required!'
       ]);


       if($Validator->fails()){
              return redirect()->back()->withErrors($Validator)->withInput( );
       }

       $user = User::create( [
           'name' => $request->input('name'),
           'email' => strtolower($request->input('email')),
           'password' => bcrypt($request->input('password')),
           'email_verification_token' => Str::random(32)
       ]);



    //   Mail::to($user->email)->send(new VerificationEmail($user));

      Mail::to($user->email)->queue(new VerificationEmail($user));


       session()->flash('msg','User Registration Succesfully');
       session()->flash('type','success');
       return redirect()->back();


    }

    public function verifyEmail($token =null){
        if($token == null){
            session()->flash('msg','Invalid Token');
            session()->flash('type','warning');
            return redirect()->route('userlogin');
        }
        $user = User::where('email_verification_token',$token)->first();

        if($user == null){
            session()->flash('msg','Invalid Token');
            session()->flash('type','warning');
            return redirect()->route('userlogin');
        }

        $user->update([
            'email_verified' =>1,
            'email_verified_at' => Carbon::now(),
            'email_verified_token' => '',

        ]);
        session()->flash('msg','Your Account Active Succesfully');
         session()->flash('type','success');
        return redirect()->route('userlogin');



    }

    public function Dashboard(){
        $data = [];

        $data['site_title'] = "RioTheme";
        return view('dashboard',$data);
    }

    public function showLogin(){
        $data = [];

        $data['site_title'] = "RioTheme";
        return view('frontend.login',$data);
    }

    public function processLogin(Request $request){
        $Validator = Validator::make($request->all(),[
            'email'=> 'required|email',
            'password'=>'required|min:6'
           ]);


           if($Validator->fails()){
                  return redirect()->back()->withErrors($Validator)->withInput( );
           }

           $credentials = $request->except(['_token']);

           if(auth()->attempt($credentials)){
               $user = auth()->user();

               if($user->email_verified == 0){
                session()->flash('msg','Your Account is Not activated. Please verify your Email');
                session()->flash('type','danger');
                auth()->logout();
                return redirect()->route('userlogin');
               }

              return redirect()->route('dashboard');
           }
           session()->flash('msg','Invalid credentials');
           session()->flash('type','danger');
           return redirect()->back();
    }

    public function logout(){
        auth()->logout();
        session()->flash('msg','User has been logout');
        session()->flash('type','success');
        return redirect()->route('userlogin');
    }
}
