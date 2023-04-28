<?php

namespace App\Http\Controllers;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\user;

class AuthController extends Controller
{
  use HttpResponses;

public function login(LoginUserRequest $request){
 $request->validated($request->all());

 if (!auth()->attempt($request->only('email','password'))) {
return $this->error('','Credential do not match',401);
 }
    $user = user::where('email',$request->email)->first();
    return $this->success([
        'user'=>$user,
        'token'=>$user->createToken('Api TokEn of ' . $user->email)->plainTextToken, 
    ]);
}
public function register(StoreUserRequest $request){
    $request->validated($request->all());
    $user = user::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
    ]);
    return  $this->success([
        'user'=>$user,
        'token'=>$user->createToken('Api Token Of'. $user->name)->plainTextToken
    ]);
}
public function logout(){
    return response()->json('this is logout method');
}
}
