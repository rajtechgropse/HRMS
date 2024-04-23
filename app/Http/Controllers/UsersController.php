<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\employees;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function usersLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->userDepartment == 'Delivery') {
                return redirect('/user/dashboard');
            } 
        } else {
            return redirect()->route('loginpage')->with('error', 'Invalid email or password');
        }
    }
    public function dashboard()
    {
        return view('users.dashboard');
    }
    public function userView()
    {
        
        $usersDetails = Auth::user()->employee_Id;
        $employeeDetails = employees::where('id', $usersDetails)->first();
        return view('users.usersProfile', compact('employeeDetails'));
    }
}
