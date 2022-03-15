<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller {

    public function login (Request $request , User $user) 
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'password' => 'required',
            'email'    => 'required'
        ]);

        if($validator->fails()){
            return response()->json(array( 'status' => false , 'errors' => $validator->errors()));       
        }

        if ( !Auth::attempt($input)) {
            abort(401, trans('Invalid Credentials', [], 'pt-BR'));
        }

        $token =  auth()->user()->createToken('auth_token');

        return response()->json(array('status' => true , 'data' => [ 'token' => $token->plainTextToken])); 
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
    }

}
