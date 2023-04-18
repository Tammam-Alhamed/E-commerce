<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends BaseController
{
    public function register(Request $request)
    {
       $validator = Validator::make($request->all(),[
        'name' => 'requierd',
        'email' => 'requierd|email',
        'password' => 'requierd',
        'phone' => 'requierd',
       ]); 


       if ($validator->fails() ) {
        return $this->sendError('plase validate error' , $validator->errors());
       }
       $input = $request->all();
       $input ['password'] = Hash::make($input['password']);
       $user = User::create ($input);
       $success['token'] = $user->createToken('Za3Tr')->accessToken;
       $success['name'] = $user->name ;

       return $this->sendResponse($success , 'User registred successfully');
    }





    public function login(Request $request)
    {

        if (Auth::attempt(['email' => $request->email , 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('Za3Tr')->accessToken;
            $success['name'] = $user->name ;
            return $this->sendResponse($success , 'User login successfully');
        }else{
            return $this->sendError('plase check tour auth' , ['error' => 'Unauthorised']);
        }

    }
}
