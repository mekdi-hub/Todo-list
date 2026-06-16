<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class Authcontroller extends Controller
{
 public function register(request $request){
    $user=User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>$request->password,
    ]);
    return response()->json([
'message'=>'registered successfully'
    ]);
 }
}
