<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function login(Request $request){
        if(Auth::attempt(['email' => $request->get('email'), 'password' => $request->password]))
        {
             $user = auth()->user();
             $success['token'] = $user->createToken("AuthToken")->accessToken;
             $token = $success['token'];
 
             $session = "<script type='text/JavaScript'>
                 window.location = '/home'
                 document.write(localStorage.setItem('token', '".$token."'));
                 </script>";

             return $session;

             if (auth()->user()->role === 'admin') {
                response()->json(["success" => "You have successfully log in!",
                "user" => $user, "status" => 200])->throwResponse();
            } 

             else if (auth()->user()->role === 'operator'){
                response()->json(["success" => "You have successfully log in!",
                "user" => $user, "status" => 200])->throwResponse();
            } 

             else if (auth()->user()->role === 'investor'){
                response()->json(["success" => "You have successfully log in!",
                "user" => $user, "status" => 200])->throwResponse();
            } 

             else if (auth()->user()->role === 'client'){
                response()->json(["success" => "You have successfully log in!",
                "user" => $user, "status" => 200])->throwResponse();
            } 
        
             else {
                 response()->json(["error" => "You have failed to login!",
                 "status" => 500])->throwResponse();
            }
        }
        else {
            return response()->json(["error" => "You have failed to login!",
            "status" => 500]);
        }
    }


    public function getLogin(){
        return view('user.login');
    }

    public function logout(Request $request){
    if ($request->user()) { 
        $session = "<script type='text/JavaScript'>
               window.location = '/login'
               alert('You Logout Successfully!');
               localStorage.removeItem('token');
              </script>";
        return $session;
         
        response()->json(["error" => "You have successfully logout!",
             "status" => 200])->throwResponse();
    } else{
        return response()->json(['error' => 'Log Out Failed'], 500);
        }
    }
}
