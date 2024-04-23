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
            
            // Now you have the user details, you can create a new user or log in the existing user
            // For example, you can check if the user already exists by their email and log them in

            $existingUser = User::where('email', $user->email)->first();

            if ($existingUser) {
                // Log in the existing user
                auth()->login($existingUser);
            } else {
                // Create a new user
                $newUser = new User();
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                // Add other necessary fields as needed
                $newUser->save();
                
                // Log in the newly created user
                auth()->login($newUser);
            }

            // Redirect the user to the desired page after successful login
            return redirect()->route('dashboard');
        } catch (Exception $e) {
            // Handle exception
            dd($e->getMessage());
        }
    }
}

