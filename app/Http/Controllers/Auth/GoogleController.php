<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            
            $existingUser = User::where('email', $user->email)->first();

            if ($existingUser) {
                auth()->login($existingUser);
                return redirect()->route('user/dashboard');
            } else {
               
                return redirect()->route('unauthorized');
            }
        } catch (Exception $e) {
            // Handle exception
            dd($e->getMessage());
        }
    }
}
