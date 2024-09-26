<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddworkesEmployee;
use App\Models\employees;
use App\Models\AddProjects;
use App\Models\User;








class ApiController extends Controller
{
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
}
