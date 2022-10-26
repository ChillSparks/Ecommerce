<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon; 
use Mail; 
use DB;
use Cookie;

class LoginController extends Controller
{
    function forgot()
    {
        return view('forgot');
    }
    function resetemail()
    {
        return view('reset-email');
    }
   
    function forgotpost(Request $request)
    {
        $token=csrf_token();
        $request->validate([
            'email'=> 'required | email ',
        ]);

        DB::table('password_resets')->insert([
            'email'=>$request->email,
            'token'=>$token,
            'created_at'=>Carbon::now()
        ]);


        Mail::send('reset-email', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

         return back()->with('success','Password reset link set. Check your email');
    }
    function reset()
    {
        return view('reset');
    }

    function saveuser(Request $request)
    {
        $request->validate([
            'fname'=>'required',
            'lname'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8|confirmed',
           
        ]);

        $user=new Users();
        $user->fname=$request->fname;
        $user->lname=$request->lname;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $save=$user->save();

        if($save)
        {
            return back()->with('success','User Register Successful');
        }
        else
        {
            return back()->with('fail','User Register Failed. Something went wrong.');
        }
    }   

    function logincheck(Request $request)
    {

        $request->validate([
            'email'=>'required',
            'password'=>'required|min:8'
        ]);

        $login=Users::where('email','=',$request->email)->first();

        if($request->has('rememberme'))
        {
            Cookie::queue('useremail',$request->email,1440);
            Cookie::queue('userpwd',$request->password,1440);
        }

        if(!$login)
        {
            return back()->with('fail','We cannot recognise your email address');
        }
        else
        {
            if(Hash::check($request->password,$login->password))
            {
                $request->session()->put('LoggedUser',$login->id);
                return redirect('/');
            }
            else{
                return back()->with('fail','Incorrect Password');
               
            }
        }
    }
}
