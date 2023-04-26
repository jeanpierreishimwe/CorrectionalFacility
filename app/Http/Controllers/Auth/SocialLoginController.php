<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\inaHttp\Request;
use Laravel\Socialite\Facades\Socialite;
use  App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Socialite\Facades\Hash;
class SocialLoginController extends Controller
{
    //
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
       $user = Socialite::driver($provider)->user();
       dd($user);

      $user = User::where([
        
        'provider' => $provider,
        'provider_id'=> $provider_user->id,

      ])->first();

      if (!$user) {
        User::create([
              'name'=>$provider_user->name,
              'email'=>$provider_user->email,
              'provider'=>$provider,
              'provider_id'=> $provider_user->id,
              'password'=>Hash::make(Str::random(8)),
        ]);
      }
    }
}
