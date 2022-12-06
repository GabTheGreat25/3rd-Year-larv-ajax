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
use App\Http\Controllers\ApiAuthController as ApiAuthController;

class LoginController extends ApiAuthController
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validator Error', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);

        $success['token'] = $user->createToken("AuthToken")->accessToken;
        // $myItem = $success['token'];
        // $cookie = cookie('token', $myItem, 60); 
        // return redirect('/')->withCookie($cookie);
        $success['account'] = $user;
        // $accessToken = $user->createToken('authToken-'.$user->id, ['*'])->accessToken;
        $redirect = Redirect::to("/login");
        return $redirect;
        if ($success) {
            return $this->sendResponse($success, 'You Registered Successfully!');
        }
        else {
            return $this->sendResponse([$success, $myItem],'Account Created Successfully!');
    }
}

    public function login(Request $request){
        if(Auth::attempt(['email' => $request->get('email'), 'password' => $request->password])){
            $user = auth()->user();
            $success['token'] = $user->createToken("AuthToken")->accessToken;
            $success['account'] = $user;
            // $redirect = Redirect::to("/");
            // return $redirect;
            if ($success) {
             return $this->sendResponse($success, 'You Logged in Successfully!');
            }
        }
        else {
            return $this->sendError('UnAuthenticated' , ['error' => 'Wrong Password Or Email']);
        }
    }


    public function getLogin(){
        return view('user.login');
    }

    public function getRegister(){
        return view('user.register');
    }

    public function logout(Request $request){
    if ($request->user()) { 
        $request->user()->tokens()->delete();
        $redirect = Redirect::to("/login");
        return $redirect;
        if ($request->user()) {
            return response()->json(['message' => 'Log Out Successfully'], 200);
            }
        }
    }
}
