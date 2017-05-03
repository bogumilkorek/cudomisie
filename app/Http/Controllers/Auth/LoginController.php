<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Illuminate\Foundation\Auth\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "/check-user";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function redirectToProvider($provider)
    {
      return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {

      $user = Socialite::driver($provider)->user();

      $authUser = User::where('provider_id', $user->id)->first();

      if(!$authUser)
      {
        $authUser = new User();
        $authUser->name = $user->name;
        $authUser->email = $user->email;
        $authUser->provider = $provider;
        $authUser->provider_id = $user->id;
        $authUser->save();
      }

      auth()->login($authUser);

      alert()->success(__('You are now logged in'), __('Success'))->persistent('OK');
      return redirect('/check-user');
    }

}
