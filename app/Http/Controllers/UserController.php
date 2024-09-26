<?php

namespace App\Http\Controllers;

use App\Models\employees;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function fetchUsersByDesignation($userDesignation)
    {
        $users = employees::where('designation', $userDesignation)->whereIn('employeestatus', [0])->get();

        return response()->json($users);
    }
    public function fetchEmployeeDetails($employeeName)
    {
        
        $employee = employees::where('name', $employeeName)->first();

        return response()->json($employee);
    }
}
