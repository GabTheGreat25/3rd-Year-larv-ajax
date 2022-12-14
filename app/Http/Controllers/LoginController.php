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
//     public function register(Request $request){
//         $validator = Validator::make($request->all(), [
//             'name' => 'required',
//             'email' => 'required|email|unique:users',
//             'password' => 'required',
//         ]);

//         if($validator->fails()){
//             return $this->sendError('Validator Error', $validator->errors());
//         }

//         $input = $request->all();
//         $input['password'] = Hash::make($input['password']);
//         $user = User::create($input);
//         $redirect = Redirect::to("/login");
//         return $redirect;

//         if ($redirect == true) {
//             response()->json(["success" => "You have registered succesfully!", "user" => $user, "status" => 200])->throwResponse();
//         }
//         else {
//             return response()->json(["error" => "You have failed to register!", "user" => $user, "status" => 500]);
//         }
// }

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
                 "status" => 500])->throwResponse();;
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

    // public function getRegister(){
    //     return view('user.register');
    // }

    public function logout(Request $request){
    if ($request->user()) { 
        echo "<script type='text/JavaScript'>
               window.location = '/login'
               alert('You Logout Successfully!');
               localStorage.removeItem('token');
              </script>"; 
    } else{
        return response()->json(['error' => 'Log Out Failed'], 500);
        }
    }
}
