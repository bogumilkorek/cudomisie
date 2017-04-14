<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    // Check if user is admin and whether user has complete profile
    public function checkUser(Request $request)
    {
      alert()->success(__('You are now logged in'), __('Success'))->persistent('OK');

      if(Auth::user()->admin == true)
        return redirect('/admin');

      else if(Auth::user())
      {
        if($request->session()->has('shopping'))
          return redirect()->route('user.orders.create');
        else
        {
          $user = User::where('id', Auth::user()->id)->first();
          if(empty($user->street))
              return redirect('/profile');
          else
              return redirect('/');
        }
      }
    }

    public function showProfile()
    {
      return view('users.showProfile')
      ->withUser(Auth::user());
    }

    public function updateProfile(UserRequest $request, User $user)
    {
      $user->update($request->all());
      alert()->success( __('Profile updated!'), __('Success'))->persistent('OK');
      return redirect()->route('user.profile.show');
    }
}
