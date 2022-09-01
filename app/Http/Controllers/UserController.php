<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\session;

class UserController extends Controller
{
    function list()
    {
       //return Session::get('logData');
       $user=User::all();
       return view('userlist',['user'=>$user]);

    }
    function create()
    {
       return view('create');

    }
    function login_up()
    {
       return view('login');

    }
    function login_submit(Request $request)
    {
         User::select('*')->where(
           [
              ['email', '=', $request->email],
              ['password', '=', $request->password],

           ]
        )->get();
        $request->session()->put('logData',[$request->input()]);
       return redirect('/list');

       

    }
    function create_submit(Request $request)
    {
        $user = new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=$request->password;
        $result=$user->save();
        if($result)
        {
             $request->session()->put('logData',[$request->input()]);
             return redirect('/list');

        }

     }
}
