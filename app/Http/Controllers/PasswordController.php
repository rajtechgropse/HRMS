<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class PasswordController extends Controller
{

    // public function changePassword(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'user_id' => ['required', 'exists:users,id'],
    //         'current_password' => ['required'],
    //         'new_password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $user = User::find($request->user_id);
    //     if (!$user) {
    //         return redirect()->back()->withErrors(['user_id' => 'User not found.'])->withInput();
    //     }

    //     if (!Hash::check($request->current_password, $user->password)) {
    //         return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.'])->withInput();
    //     }

    //     $user->password = Hash::make($request->new_password);
    //     $user->save();

    //     return redirect()->back()->with('status', 'Password changed successfully!');
    // }
    //     public function changePassword(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'user_id' => ['required', 'exists:users,id'],
    //         'current_password' => ['required'],
    //         'new_password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator, 'password_change')->withInput();
    //     }

    //     $user = User::find($request->user_id);
    //     if (!$user) {
    //         return redirect()->back()->withErrors(['user_id' => 'User not found.'], 'password_change')->withInput();
    //     }

    //     if (!Hash::check($request->current_password, $user->password)) {
    //         return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.'], 'password_change')->withInput();
    //     }

    //     $user->password = Hash::make($request->new_password);
    //     $user->save();

    //     return redirect()->back()->with('status', 'Password changed successfully!');
    // }

    // public function changePassword(Request $request)
    // {
    //     // Define validation rules
    //     $validator = Validator::make($request->all(), [
    //         'user_id' => ['required', 'exists:users,id'],
    //         'current_password' => ['required'],
    //         'new_password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);

    //     // Check if validation fails
    //     if ($validator->fails()) {
    //         // Redirect back with validation errors and old input
    //         return redirect()->back()
    //             ->withErrors($validator, 'password_change')
    //             ->withInput();
    //     }

    //     // Find the user by ID
    //     $user = User::find($request->user_id);

    //     // Check if user exists
    //     if (!$user) {
    //         // Redirect back with custom error
    //         return redirect()->back()
    //             ->withErrors(['user_id' => 'User not found.'], 'password_change')
    //             ->withInput();
    //     }

    //     // Check if the current password is correct
    //     if (!Hash::check($request->current_password, $user->password)) {
    //         // Redirect back with custom error
    //         return redirect()->back()
    //             ->withErrors(['current_password' => 'The current password is incorrect.'], 'password_change')
    //             ->withInput();
    //     }

    //     // Update the user's password
    //     $user->password = Hash::make($request->new_password);
    //     $user->save();

    //     // Redirect back with success message
    //     return redirect()->back()->with('status', 'Password changed successfully!');
    // }
    // public function changePassword(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'user_id' => ['required', 'exists:users,id'],
    //         'current_password' => ['required'],
    //         'new_password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);

    //     if ($validator->fails()) {
    //         // Use a specific error bag to isolate errors for this form
    //         return redirect()->back()
    //             ->withErrors($validator, 'password_change')
    //             ->withInput();
    //     }

    //     $user = User::find($request->user_id);
    //     if (!$user) {
    //         return redirect()->back()
    //             ->withErrors(['user_id' => 'User not found.'], 'password_change')
    //             ->withInput();
    //     }

    //     if (!Hash::check($request->current_password, $user->password)) {
    //         return redirect()->back()
    //             ->withErrors(['current_password' => 'The current password is incorrect.'], 'password_change')
    //             ->withInput();
    //     }

    //     $user->password = Hash::make($request->new_password);
    //     $user->save();

    //     return redirect()->back()->with('status', 'Password changed successfully!');
    // }
    // public function changePassword(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'user_id' => ['required', 'exists:users,id'],
    //         'current_password' => ['required'],
    //         'new_password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);

    //     if ($validator->fails()) {
    //         // Redirect back with errors for the password change form
    //         return redirect()->back()
    //             ->withErrors($validator, 'password_change')
    //             ->withInput();
    //     }

    //     $user = User::find($request->user_id);
    //     if (!$user) {
    //         return redirect()->back()
    //             ->withErrors(['user_id' => 'User not found.'], 'password_change')
    //             ->withInput();
    //     }

    //     if (!Hash::check($request->current_password, $user->password)) {
    //         return redirect()->back()
    //             ->withErrors(['current_password' => 'The current password is incorrect.'], 'password_change')
    //             ->withInput();
    //     }

    //     $user->password = Hash::make($request->new_password);
    //     $user->save();

    //     return redirect()->back()->with('status', 'Password changed successfully!');
    // }
    // public function changePassword(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'user_id' => ['required', 'exists:users,id'],
    //         'current_password' => ['required'],
    //         'new_password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator, 'password_change')
    //             ->withInput();
    //     }

    //     $user = User::find($request->user_id);
    //     if (!$user) {
    //         return redirect()->back()
    //             ->withErrors(['user_id' => 'User not found.'], 'password_change')
    //             ->withInput();
    //     }

    //     if (!Hash::check($request->current_password, $user->password)) {
    //         return redirect()->back()
    //             ->withErrors(['current_password' => 'The current password is incorrect.'], 'password_change')
    //             ->withInput();
    //     }

    //     $user->password = Hash::make($request->new_password);
    //     $user->save();

    //     return redirect()->back()->with('status', 'Password changed successfully!');
    // }
    // public function changePassword(Request $request)
    // {
    //     // Define validation rules
    //     $validator = Validator::make($request->all(), [
    //         'user_id' => ['required', 'exists:users,id'],
    //         'current_password' => ['required'],
    //         'new_password' => ['required', 'string', 'min:8', 'confirmed'],
    //         'new_password_confirmation' => ['required_with:new_password', 'same:new_password'],
    //     ]);

    //     // Check if validation fails
    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator, 'password_change')
    //             ->withInput();
    //     }

    //     $user = User::find($request->user_id);

    //     // Check if user exists
    //     if (!$user) {
    //         return redirect()->back()
    //             ->withErrors(['user_id' => 'User not found.'], 'password_change')
    //             ->withInput();
    //     }

    //     // Check if the current password is correct
    //     if (!Hash::check($request->current_password, $user->password)) {
    //         return redirect()->back()
    //             ->withErrors(['current_password' => 'The current password is incorrect.'], 'password_change')
    //             ->withInput();
    //     }

    //     // Check if the new password is the same as the current password
    //     if (Hash::check($request->new_password, $user->password)) {
    //         return redirect()->back()
    //             ->withErrors(['new_password' => 'The new password cannot be the same as the current password.'], 'password_change')
    //             ->withInput();
    //     }

    //     // Update the user's password
    //     $user->password = Hash::make($request->new_password);
    //     $user->save();

    //     return redirect()->back()->with('status', 'Password changed successfully!');
    // }
    // public function changePassword(Request $request)
    // {
    //     // Define validation rules
    //     $validator = Validator::make($request->all(), [
    //         'user_id' => ['required', 'exists:users,id'],
    //         'current_password' => ['required'],
    //         'new_password' => ['required', 'string', 'min:8', 'confirmed'],
    //         'new_password_confirmation' => ['required_with:new_password', 'same:new_password'],
    //     ]);

    //     // Check if validation fails
    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator, 'password_change')
    //             ->withInput();
    //     }

    //     $user = User::find($request->user_id);

    //     // Check if user exists
    //     if (!$user) {
    //         return redirect()->back()
    //             ->withErrors(['user_id' => 'User not found.'], 'password_change')
    //             ->withInput();
    //     }

    //     // Check if the current password is correct
    //     if (!Hash::check($request->current_password, $user->password)) {
    //         return redirect()->back()
    //             ->withErrors(['current_password' => 'The current password is incorrect.'], 'password_change')
    //             ->withInput();
    //     }

    //     // Check if the new password is the same as the current password
    //     if (Hash::check($request->new_password, $user->password)) {
    //         return redirect()->back()
    //             ->withErrors(['new_password' => 'The new password cannot be the same as the current password.'], 'password_change')
    //             ->withInput();
    //     }

    //     // Update the user's password
    //     $user->password = Hash::make($request->new_password);
    //     $user->save();

    //     return redirect()->back()->with('status', 'Password changed successfully!');
    // }
    // public function changePassword(Request $request)
    // {
    //     // Define validation rules
    //     $validator = Validator::make($request->all(), [
    //         'user_id' => ['required', 'exists:users,id'],
    //         'current_password' => ['required'],
    //         'new_password' => ['required', 'string', 'min:8', 'confirmed'],
    //         'new_password_confirmation' => ['required_with:new_password', 'same:new_password'],
    //     ]);

    //     // Check if validation fails
    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator, 'password_change')
    //             ->withInput();
    //     }

    //     $user = User::find($request->user_id);

    //     // Check if user exists
    //     if (!$user) {
    //         return redirect()->back()
    //             ->withErrors(['user_id' => 'User not found.'], 'password_change')
    //             ->withInput();
    //     }

    //     // Check if the current password is correct
    //     if (!Hash::check($request->current_password, $user->password)) {
    //         return redirect()->back()
    //             ->withErrors(['current_password' => 'The current password is incorrect.'], 'password_change')
    //             ->withInput();
    //     }

    //     // Check if the new password is the same as the current password
    //     if (Hash::check($request->new_password, $user->password)) {
    //         return redirect()->back()
    //             ->withErrors(['new_password' => 'The new password cannot be the same as the current password.'], 'password_change')
    //             ->withInput();
    //     }

    //     // Update the user's password
    //     $user->password = Hash::make($request->new_password);
    //     $user->save();

    //     return redirect()->back()->with('status', 'Password changed successfully!');
    // }
    public function checkPassword(Request $request)
    {
        $user = Auth::user();
        if (Hash::check($request->current_password, $user->password)) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'The current password is incorrect.']);
        }
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);
        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The provided current password does not match our records.']);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        Auth::logout();
        return redirect()->back()->with('status', 'Password changed successfully!');
    }
}
