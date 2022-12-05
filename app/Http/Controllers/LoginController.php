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
        $myItem = $success['token'];

        if(isset($_COOKIE['mycookie'])) {
            $myItem = $_COOKIE['mycookie'];
        }
        $success['account'] = $user;
        // $accessToken = $user->createToken('authToken-'.$user->id, ['*'])->accessToken;

        return $this->sendResponse([$success, $myItem],'Account Created Successfully!');
    }

    public function login(Request $request){
        if(Auth::attempt(['email' => $request->get('email'), 'password' => $request->password])){
             $user = auth()->user();
            $success['token'] = $user->createToken("AuthToken")->accessToken;
            $success['account'] = $user;
            return $this->sendResponse($success, 'You Logged in Successfully!');
        }
        else {
            return $this->sendError('UnAuthenticated ' , ['error' => 'UnAuthorized']);
        }
    }

    public function getLogin(){
        return view('user.login');
    }

    public function getRegister(){
        return view('user.register');
    }

    public function logout(){
         Auth::logout();
        return redirect()->guest('/');
    //      if (auth()->guard('api')->check()) {
    //     auth()->guard('api')->user()->OauthAcessToken()->delete();

    //     return response()->json([ 'msg' => 'Successfully logged out!' ]);
    
    // } else {
    //     return abort(404, 'Must be logged in to log a user out');
    // }
    }
}