<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddworkesEmployee;
use App\Models\employees;
use App\Models\AddProjects;
use App\Models\User;
<<<<<<< HEAD
=======
use Illuminate\Http\JsonResponse;

>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c








class ApiController extends Controller
{
<<<<<<< HEAD
    public function userDetails()
   {
    // $projectManagers = 'Project Manager';
    // $arr = [1,2,3]
        $usersDetails = User::where('userDesignation','Project Manager')->get();
        return $usersDetails;

        //  if (Auth::user()->userDesignation == 'Project Manager') {
        //     $userAssignedProject = Auth::user()->employee_Id;
        //     $assignedProjects = AddworkesEmployee::where('employee_Id', $userAssignedProject)
        //        ->pluck('project_id')
        //        ->toArray();

        //     $projects = AddProjects::whereIn('id', $assignedProjects)->paginate(15);
        //     // dd($projects);
        //     $projectManagersIds = $projects->pluck('pmemployeeId')->unique();

        //     $projectManagers = employees::whereIn('id', $projectManagersIds)->get()->keyBy('id');

        //     return view("users.projectManageProject", [
        //        'users' => $projects,
        //        'projectManagers' => $projectManagers

        //     ]);
        //  } else {
        //     return redirect()->back()->with('error', 'You are Not Authorized');
        //  }
      
   }
=======
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
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
}
