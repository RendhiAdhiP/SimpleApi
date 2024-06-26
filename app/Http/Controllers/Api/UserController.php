<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name'=>'required|string|min:6',
            'password'=>'required|string',
            'username'=>'required|string|min:6',
        ],[
            'name.required'=>'username must not be blank',
            'username.required'=>'username must not be blank',
        ]);

        $data = $request->all();

        $user = User::create($data);
        $u = [
            'id'=>$user->id,
            'name'=>$user->name,
            'username'=>$user->username,
        ];
        return response()->json(['message'=>'Success register user','data'=>$u],201);
    }


    public function login(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);

        $data = $request->all();

        if(auth()->attempt($data)){
            $user = $request->user();
            $token = $request->user()->createToken('token')->plainTextToken;
            $u = [
                'id'=>$user->id,
                'username'=>$user->username,
                'name'=>$user->name,
                'token'=>$token,
            ];

            return response()->json(['message'=>'Success login','data'=>$u],200);

        }

        return response()->json(['message'=>'Username or password inccorect'],401);

    }

    public function current(Request $request){
        $user = $request->user();
        $u = [
            'id'=>$user->id,
            'username'=>$user->username,
            'name'=>$user->name,
        ];

        return response()->json(['message'=>'Success get current user','data'=>$u],200);

    }
    public function update($id,Request $request){


        $user = $request->user();

        $request->user()->update(
            ['username'=>$request->username,
            'password'=>$request->password,]
        );

        $u = [
            'id'=>$user->id,
            'username'=>$user->username,
            'name'=>$user->name,
        ];

        return response()->json(['message'=>'Success update user','data'=>$u],200);
    }
    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json(['message'=>'Logout success'],200);

    }
}
