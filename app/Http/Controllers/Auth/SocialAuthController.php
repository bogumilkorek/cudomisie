<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use Illuminate\Foundation\Auth\User;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
      return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {

      $user = Socialite::driver($provider)->stateless()->user();

      $authUser = User::firstOrNew(['provider_id' => $user->id]);

    //  if(!$authUser)

      // $authUser->name = $user->name;
      // $authUser->email = $user->email;
      // $authUser->provider = $user->provider;
      //
      // $authUser->save();

      //auth()->login($authUser);

      return redirect('/');
    }
}
