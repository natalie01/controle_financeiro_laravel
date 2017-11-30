<?php

namespace projeto_laravel\Http\Controllers;
 
use Illuminate\Http\Request;
use Socialite;
 use projeto_laravel\Providers\SocialFacebookAccountService;

class FacebookAuthController extends Controller
{
  /**
   * Create a redirect method to facebook api.
   *
   * @return void
   */
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
 
    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callback()
    {
	$user = Socialite::driver('facebook')->user();
        auth()->login($user);
        return redirect()->to('/home');
	
        
    }
}