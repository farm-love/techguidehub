<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Redirect to provider's authentication page
     */
    public function redirect($provider)
    {
        if (!in_array($provider, ['google', 'github', 'twitter'])) {
            abort(404);
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle callback from provider
     */
    public function callback($provider)
    {
        if (!in_array($provider, ['google', 'github', 'twitter'])) {
            abort(404);
        }

        try {
            $socialUser = Socialite::driver($provider)->user();
            
            // Find or create user
            $user = User::where('email', $socialUser->getEmail())->first();
            
            if (!$user) {
                $user = User::create([
                    'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? 'User',
                    'email' => $socialUser->getEmail(),
                    'password' => Hash::make(Str::random(16)),
                    'email_verified_at' => now(),
                    'avatar' => $socialUser->getAvatar(),
                ]);
            } else {
                // Update avatar if not set
                if (!$user->avatar && $socialUser->getAvatar()) {
                    $user->update(['avatar' => $socialUser->getAvatar()]);
                }
            }
            
            Auth::login($user, true);
            
            return redirect()->intended('/');
            
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Unable to authenticate. Please try again.');
        }
    }
}
