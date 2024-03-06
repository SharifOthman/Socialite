<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    // public function login()
    // {
    //     return Socialite::driver('github')->redirect();
    // }
    // public function redirect()
    // {
    //     $socialiteUser = Socialite::driver('github')->user();
    //     $user = User::updateOrCreate([
    //         'provider_id' => $socialiteUser->getId(),
    //     ], [
    //         'name' => $socialiteUser->getName(),
    //         'email' => $socialiteUser->getEmail(),
    //     ]);
    //     // auth user
    //     Auth::login($user, true);
    //     // redirect to dashboard
    //     return to_route('dashboard');
    // }
    // // dribbble
    // public function dribbble_login()
    // {
    //     return Socialite::driver('dribbble')->redirect();
    // }
    // public function dribbble_redirect()
    // {
    //     $socialiteUser = Socialite::driver('dribbble')->user();
    //     $user = User::updateOrCreate([
    //         'dribbble_id' => $socialiteUser->getId(),
    //     ], [
    //         'name' => $socialiteUser->getName(),
    //         'email' => $socialiteUser->getEmail(),
    //     ]);
    //     // auth user
    //     Auth::login($user, true);
    //     // redirect to dashboard
    //     return to_route('dashboard');
    // }

    // refactor
    public function login($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function redirect($provider)
    {
        $socialiteUser = Socialite::driver($provider)->user();

        $user = User::updateOrCreate([
            'provider' => $provider,
            'provider_id' => $socialiteUser->getId(),
        ], [
            'name' => $socialiteUser->getName(),
            'email' => $socialiteUser->getEmail(),
        ]);

        // auth user
        Auth::login($user, true);

        // redirect to dashboard
        return to_route('dashboard');
    }
}
