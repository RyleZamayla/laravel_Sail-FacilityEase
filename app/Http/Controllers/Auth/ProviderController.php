<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {

        try {

            $googleUser = Socialite::driver($provider)->user();

            $user = User::where([
                'provider' => $provider,
                'provider_id' => $googleUser->id,
            ])->first();

            if(!$user){

                if(User::where('email', $googleUser->getEmail())->exists()){
                    return redirect('/login')->withErrors(['email' => 'This email is already registered']);
                }

                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'provider' => $provider,
                    'provider_id' => $googleUser->getId(),
                    'provider_token' => $googleUser->token,
                ]);
                $user->sendEmailVerificationNotification();
            }

            Auth::login($user);

            return redirect('/dashboard');

        } catch (\Exception $e) {

        }

    }
}
