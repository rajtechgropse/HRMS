<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddworkesEmployee;
use App\Models\employees;
use App\Models\AddProjects;
use App\Models\User;
use Illuminate\Http\JsonResponse;









class ApiController extends Controller
{
    public function getUserDetails()
    {
        try {
            // Fetch user details where designation is 'Project Manager'
            $usersDetails = User::where('userDesignation', 'Project Manager')->get();

            // Check if any users were found
            if ($usersDetails->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No users found with the designation Project Manager',
                ], 404); // Not Found
            }

            // Return the details as a JSON response with success code
            return response()->json([
                'success' => true,
                'data' => $usersDetails,
                'message' => 'Users retrieved successfully',
            ], 200); // OK

        } catch (\Exception $e) {
            // Handle any errors that occur
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving user details',
                'error' => $e->getMessage(),
            ], 500); // Internal Server Error
        }
    }
}
