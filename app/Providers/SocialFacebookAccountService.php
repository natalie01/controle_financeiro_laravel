<?php
namespace projeto_laravel\Providers;
use projeto_laravel\SocialFacebookAccount;
use projeto_laravel\User;
use Laravel\Socialite\Contracts\User as ProviderUser;
 
class SocialFacebookAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = SocialFacebookAccount::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();
 
        if ($account) {
            return $account->user;
        } else {
 
            $account = new SocialFacebookAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);
 
            $user = User::whereEmail($providerUser->getEmail())->first();
 
            if (!$user) {
 
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'password' => md5(rand(1,10000)),
                ]);
            }
 
            $account->user()->associate($user);
            $account->save();
 
            return $user;
        }
    }
}

