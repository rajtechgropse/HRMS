<?php

namespace App\Http\Controllers;

use App\Models\employees;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function fetchUsersByDesignation($userDesignation)
    {
<<<<<<< HEAD
        // $users = employees::where('designation', $userDesignation)->whereIn('employeestatus',0)->get();
        $users = employees::where('designation', $userDesignation)->whereIn('employeestatus', [0])->get();

        // dd($users);
=======
        $users = employees::where('designation', $userDesignation)->whereIn('employeestatus', [0])->get();

>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
        return response()->json($users);
    }
    public function fetchEmployeeDetails($employeeName)
    {
        
        $employee = employees::where('name', $employeeName)->first();

        return response()->json($employee);
    }
}
