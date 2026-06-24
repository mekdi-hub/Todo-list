<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class Authcontroller extends Controller
{
 public function register(Request $request){
    $validated=$request->validate([
        'name'=>'required|string|max:255',
        'email'=>'required|string|email|max:255|unique:users',
        'password'=>'required|string|min:8|confirmed',
    ]);
    $user=User::create ([
        'name'=>$validated['name'],
        'email'=>$validated['email'],
        'password'=>Hash::make($validated['password']),
    ]);
    $token=$user->createToken('auth-token')->plainTextToken;
    return response()->json([
        'message'=>'registered successfully',
        'user'=>$user,
        'token'=>$token,
    ],201);
 }

 public function login(Request $request){
    $validated=$request->validate([
        'email'=>'required|string|email|max:255',
        'password'=>'required|string|min:8',
    ]);
   $user=User::where('email',$validated ['email'])->first();
 if(!$user || !Hash::check($validated['password'], $user->password))
    {
        return response()->json([
            'message' => 'Invalid email or password'
        ], 401);
    }
  $token=$user->createToken('auth-token')->plainTextToken;
    return response()->json([
        'message'=>'logged in  successfully',
        'user'=>$user,
'token'=>$token,
    ],200);

 }
 public function logout(Request $request){

          $token=$request->user()
          ->currentAccessToken()->delete();
    return response()->json([
        'message'=>'logged out successfully'
    ],200);
 }
}
