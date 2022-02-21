<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Laravel\Socialite\Facades\Socialite;

use App\User;

class SocialController extends Controller
{
  public function redirect($provider)
  {
    return Socialite::driver($provider)->redirect();
  }

  public function callback(Request $request, $provider)
  {
    $user = Socialite::driver($provider)->user();

    $isUser = User::where('oauth_id', $user->id)->orWhere('email', $user->email)->first();

    if(!$isUser) {
    	$createdUser = new User([
        'name' => $user->name,
        'email' => $user->email,
        'oauth_provider' => 'facebook',
        'oauth_id' => $user->id,
        'slug' => Str::slug($user->name, '-'),
      ]);

      $createdUser->save();

      auth()->login($createdUser);
    } else {
    	auth()->login($isUser);
    }

    return redirect()->route('home');
  }
}
