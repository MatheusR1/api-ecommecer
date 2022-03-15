<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

Class RegisterController extends Controller {

    public function register (Request $request , User $user) 
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name'     => 'required',
            'password' => 'required',
            'email'    => 'required'
        ]);

        if($validator->fails()){
            return response()->json(array( 'status' => false , 'errors' => $validator->errors()));       
        }

        if (!$user = $user->create($input)) {
            return response()->json(array( 'status' => false , 'errors' => 'user not created'));
        }

        return response()->json(array('status' => true , 'data' => $user)); 
    }
}
