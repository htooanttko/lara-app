<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FindFriendController;

Route::middleware('auth:sanctum')->get('/', function (Request $request) {
    return $request->user();
});

Route::get('/users',function(){
    $user = User::get();
    return response()->json([
        'user'=> $user,
    ]);
});

Route::post('/users',function(Request $request){
    $data = [
        'name'=> $request->name,
        'phone' => $request->phone,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ];

    $user = User::create($data);
    return response()->json([
        'user'=> $user,
    ]);
});



