<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\AddProjects;
use App\Models\User;
use App\Models\addworkesEmployee;
use Illuminate\Http\Request;
use App\Models\employees;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserAllocatedToProject;
use Illuminate\Support\Facades\Validator;
use App\Mail\UserAllocatedChangeToProject;





use Illuminate\Support\Facades\Redirect;

use Collective\Html\FormFacade as Form;


class AddworkemployeeController extends Controller
{
    // public function addWorksEmployee($id)
    // {
    //     $modules = Session::get('user_modules_' . auth()->id());
    //     $projectData = AddProjects::find($id);
    //     if (Auth::user()->status == 0) {

    //         if ($projectData) {
    //             $addworkesEmployees = addworkesEmployee::where('project_id', $projectData->id)->paginate(5);
    //             $employeeIds = $addworkesEmployees->pluck('employee_Id')->toArray();
    //             $usersDetails = employees::whereIn('id', $employeeIds)->pluck('name', 'id');
    //             return view('addWorkEmployee', [
    //                 'modules' => $modules,
    //                 'projectData' => $projectData,
    //                 'addworkesEmployees' => $addworkesEmployees,
    //                 'usersDetails' => $usersDetails
    //             ]);
    //         }
    //     }
    //     elseif(Auth::user()->status == 1){
    //         if ($projectData) {
    //             $addworkesEmployees = addworkesEmployee::where('project_id', $projectData->id)->paginate(5);
    //             $employeeIds = $addworkesEmployees->pluck('employee_Id')->toArray();
    //             $usersDetails = employees::whereIn('id', $employeeIds)->pluck('name', 'id');
    //             return view('users.addWorkEmployeeUser', [
                   
    //                 'projectData' => $projectData,
    //                 'addworkesEmployees' => $addworkesEmployees,
    //                 'usersDetails' => $usersDetails
    //             ]);
    //         }
    //     }
    // }

    public function addWorksEmployee($id)
    {
        $modules = Session::get('user_modules_' . auth()->id());
        $projectData = AddProjects::find($id);
    
        if (!$projectData) {
            Session::flash('error', 'Project not found.');
            return redirect()->back();
        }
    
        // Check user status and filter accordingly
        if (Auth::user()->status == 0) {
            // Fetch employees related to the project where is_deleted is 0
            $addworkesEmployees = addworkesEmployee::where('project_id', $projectData->id)
                ->where('is_deleted', 0) // Ensure is_deleted is 0
                ->paginate(5);
    
            // Extract employee IDs
            $employeeIds = $addworkesEmployees->pluck('employee_Id')->toArray();
            
            // Fetch user details
            $usersDetails = employees::whereIn('id', $employeeIds)
                // ->where('is_deleted', 0) // Ensure is_deleted is 0
                ->pluck('name', 'id');
            
            return view('addWorkEmployee', [
                'modules' => $modules,
                'projectData' => $projectData,
                'addworkesEmployees' => $addworkesEmployees,
                'usersDetails' => $usersDetails
            ]);
        } elseif (Auth::user()->status == 1) {
            // Fetch employees related to the project regardless of is_deleted status
            $addworkesEmployees = addworkesEmployee::where('project_id', $projectData->id)->where('is_deleted', 0 )->paginate(5);
            
            // Extract employee IDs
            $employeeIds = $addworkesEmployees->pluck('employee_Id')->toArray();
            
            // Fetch user details regardless of is_deleted status
            $usersDetails = employees::whereIn('id', $employeeIds)->pluck('name', 'id');
            
            return view('users.addWorkEmployeeUser', [
                'projectData' => $projectData,
                'addworkesEmployees' => $addworkesEmployees,
                'usersDetails' => $usersDetails
            ]);
        }
    }
    public function fetchUsersByDesignation($designation)
    {
        $users = User::where('designation', $designation)->get();
        return response()->json($users);
    }


    // public function addworkesEmployeeStore(Request $request)
    // {
    //     $employeeId = $request->input('employee_id');
    //     $addworkesEmployee = [
    //         'project_id' => $request->input('projectId'),
    //         'userDepartment' => $request->input('userDepartment'),
    //         'userDesignation' => $request->input('userDesignation'),
    //         'employee_Id' => $request->input('employee_Id'),
    //         'allocationpercentage' => $request->input('allocationpercentage'),
    //         'status' => 1,
    //         'startdate' => $request->input('startdate'),
    //         'enddate' => $request->input('enddate'),
    //     ];

    //     $existingProject = AddworkesEmployee::find($employeeId);

    //     if ($existingProject) {
    //         $newTotalAllocation = $request->input('allocationpercentage');

    //         $totalAllocation = AddworkesEmployee::where('employee_Id', $request->input('employee_Id'))
    //             ->where('id', '!=', $employeeId)
    //             ->sum('allocationpercentage');

    //         $newTotalAllocation += $totalAllocation;

    //         if ($newTotalAllocation > 100) {
    //             $errorMessage = 'Total allocation percentage for this user exceeds 100%';
    //             return redirect()->back()->withInput()->withErrors(['allocationpercentage' => $errorMessage]);
    //         }

    //         $existingProject->fill($addworkesEmployee)->save();
    //         return redirect()->route('addWorksEmployee.id', ['id' => $addworkesEmployee['project_id']])->with('status', 'Employee Updated Successfully');
    //     } else {
    //         $totalAllocation = AddworkesEmployee::where('employee_Id', $request->input('employee_Id'))->sum('allocationpercentage');
    //         $newTotalAllocation = $totalAllocation + $request->input('allocationpercentage');

    //         if ($newTotalAllocation > 100) {
    //             $errorMessage = 'Total allocation percentage for this user exceeds 100%';
    //             return redirect()->back()->withInput()->withErrors(['allocationpercentage' => $errorMessage]);
    //         }

    //         $project = AddworkesEmployee::create($addworkesEmployee);

    //         if ($project) {
    //             return redirect()->back()->with('status', 'Employee Added Successfully');
    //         } else {
    //             return redirect()->back()->with('status', 'Failed to Create Employee');
    //         }
    //     }
    // }
    // public function addworkesEmployeeStore(Request $request)
    // {

    //     $employeeId = $request->input('employee_id');
    //     $addworkesEmployee = [
    //         'project_id' => $request->input('projectId'),
    //         'userDepartment' => $request->input('userDepartment'),
    //         'userDesignation' => $request->input('userDesignation'),
    //         'employee_Id' => $request->input('employee_Id'),
    //         'allocationpercentage' => $request->input('allocationpercentage'),
    //         'status' => 1,
    //         'startdate' => $request->input('startdate'),
    //         'enddate' => $request->input('enddate'),
    //     ];
    
    //     $existingProject = AddworkesEmployee::find($employeeId);
    
    //     if ($existingProject) {
    //         $newTotalAllocation = $request->input('allocationpercentage');
    
    //         $totalAllocation = AddworkesEmployee::where('employee_Id', $request->input('employee_Id'))
    //             ->where('id', '!=', $employeeId)
    //             ->sum('allocationpercentage');
    
    //         $newTotalAllocation += $totalAllocation;
    
    //         if ($newTotalAllocation > 100) {
    //             $errorMessage = 'Total allocation percentage for this user exceeds 100%';
    //             return redirect()->back()->withInput()->withErrors(['allocationpercentage' => $errorMessage]);
    //         }
    
    //         $existingProject->fill($addworkesEmployee)->save();
    //         $project = AddProjects::find($request->input('projectId'));
    //         $employee = employees::where('id', $request->input('employee_Id'))->first();
    //         $allocationPercentage = $request->input('allocationpercentage');
    //         Mail::to($employee->officialemail)->send(new UserAllocatedToProject($employee, $project, $allocationPercentage));
    //         return redirect()->route('addWorksEmployee.id', ['id' => $addworkesEmployee['project_id']])->with('status', 'Employee Updated Successfully');
    //     } else {
    //         $totalAllocation = AddworkesEmployee::where('employee_Id', $request->input('employee_Id'))->sum('allocationpercentage');
    //         $newTotalAllocation = $totalAllocation + $request->input('allocationpercentage');
    
    //         if ($newTotalAllocation > 100) {
    //             $errorMessage = 'Total allocation percentage for this user exceeds 100%';
    //             return redirect()->back()->withInput()->withErrors(['allocationpercentage' => $errorMessage]);
    //         }
    
    //         $project = AddworkesEmployee::create($addworkesEmployee);
    
    //         if ($project) {
    //             $project = AddProjects::find($request->input('projectId'));
    //             $employee = employees::where('id', $request->input('employee_Id'))->first();
    //             $allocationPercentage = $request->input('allocationpercentage');
    //             // dd($employee->email);
    //             Mail::to($employee->officialemail)->send(new UserAllocatedToProject($employee, $project, $allocationPercentage));
    //             return redirect()->back()->with('status', 'Employee Added Successfully');
    //         } else {
    //             return redirect()->back()->with('status', 'Failed to Create Employee');
    //         }
    //     }
    // }
    // public function addworkesEmployeeUpdateStore(Request $request)
    // {
    //     // Validate the request inputs
    //     $validator = Validator::make($request->all(), [
    //         'employee_Id' => 'required|exists:employees,id',
    //         'projectId' => 'required|exists:projects,id',
    //         'userDepartment' => 'required|string',
    //         'userDesignation' => 'required|string',
    //         'allocationpercentage' => 'required|numeric|min:1|max:100',
    //         'startdate' => 'required|date',
    //         'enddate' => 'required|date|after_or_equal:startdate',
    //         'employee_id' => 'required|exists:addworkes_employees,id' // ID for the record to update
    //     ]);
    
    //     if ($validator->fails()) {
    //         return redirect()->back()->withInput()->withErrors($validator);
    //     }
    
    //     $employeeId = $request->input('employee_id'); // ID for the record to update
    //     $projectId = $request->input('projectId');
    //     $userId = $request->input('employee_Id');
    //     $allocationPercentage = $request->input('allocationpercentage');
    
    //     // Check if the employee record to update exists
    //     $existingProject = AddworkesEmployee::find($employeeId);
    
    //     if (!$existingProject) {
    //         return redirect()->back()->with('status', 'Employee record not found.');
    //     }
    
    //     // Check for duplicate assignment
    //     $duplicateAssignment = AddworkesEmployee::where('employee_Id', $userId)
    //         ->where('project_id', $projectId)
    //         ->where('id', '!=', $employeeId) // Exclude current record from the check
    //         ->first();
    
    //     if ($duplicateAssignment) {
    //         return redirect()->back()->withInput()->withErrors(['employee_Id' => 'This employee is already assigned to the selected project.']);
    //     }
    
    //     // Check the total allocation percentage
    //     $totalAllocation = AddworkesEmployee::where('employee_Id', $userId)
    //         ->where('id', '!=', $employeeId) // Exclude current record from the check
    //         ->sum('allocationpercentage');
    //     $newTotalAllocation = $totalAllocation + $allocationPercentage;
    
    //     if ($newTotalAllocation > 100) {
    //         return redirect()->back()->withInput()->withErrors(['allocationpercentage' => 'Total allocation percentage for this user exceeds 100%.']);
    //     }
    
    //     // Prepare data for updating
    //     $updateData = [
    //         'project_id' => $projectId,
    //         'userDepartment' => $request->input('userDepartment'),
    //         'userDesignation' => $request->input('userDesignation'),
    //         'allocationpercentage' => $allocationPercentage,
    //         'status' => 1,
    //         'startdate' => $request->input('startdate'),
    //         'enddate' => $request->input('enddate'),
    //     ];
    
    //     // Update the existing record
    //     $existingProject->update($updateData);
    
    //     // Send notification email
    //     $project = AddProjects::find($projectId);
    //     $employee = employees::find($userId);
    //     Mail::to($employee->officialemail)->send(new UserAllocatedToProject($employee, $project, $allocationPercentage));
    
    //     return redirect()->route('addWorksEmployee.id', ['id' => $projectId])->with('status', 'Employee Updated Successfully');
    // }
    // public function addworkesEmployeeUpdateStore(Request $request)
    // {
    //     // Validate the request inputs
    //     $validator = Validator::make($request->all(), [
    //         'employee_Id' => 'required|exists:employees,id',
    //         'projectId' => 'required|exists:projects,id',
    //         'userDepartment' => 'required|string',
    //         'userDesignation' => 'required|string',
    //         'allocationpercentage' => 'required|numeric|min:1|max:100',
    //         'startdate' => 'required|date',
    //         'enddate' => 'required|date|after_or_equal:startdate',
    //         'employee_id' => 'required|exists:addworkes_employees,id' // ID for the record to update
    //     ]);
    
    //     if ($validator->fails()) {
    //         return redirect()->back()->withInput()->withErrors($validator);
    //     }
    
    //     $employeeId = $request->input('employee_id'); // ID for the record to update
    //     $projectId = $request->input('projectId');
    //     $userId = $request->input('employee_Id');
    //     $allocationPercentage = $request->input('allocationpercentage');
    //     $startdate = $request->input('startdate');
    //     $enddate = $request->input('enddate');
    
    //     // Check if the employee record to update exists
    //     $existingProject = AddworkesEmployee::find($employeeId);
    //     if (!$existingProject) {
    //         return redirect()->back()->with('status', 'Employee record not found.');
    //     }
    
    //     // Get the old allocation percentage
    //     $oldAllocationPercentage = $existingProject->allocationpercentage;
    
    //     // Check for duplicate assignment
    //     $duplicateAssignment = AddworkesEmployee::where('employee_Id', $userId)
    //         ->where('project_id', $projectId)
    //         ->where('id', '!=', $employeeId) // Exclude current record from the check
    //         ->first();
    
    //     if ($duplicateAssignment) {
    //         return redirect()->back()->withInput()->withErrors(['employee_Id' => 'This employee is already assigned to the selected project.']);
    //     }
    
    //     // Check the total allocation percentage
    //     $currentAllocationPercentage = $existingProject->allocationpercentage;
    //     $totalAllocation = AddworkesEmployee::where('employee_Id', $userId)
    //         ->where('id', '!=', $employeeId) // Exclude current record from the check
    //         ->sum('allocationpercentage');
    //     $newTotalAllocation = $totalAllocation + $allocationPercentage - $currentAllocationPercentage;
    
    //     if ($newTotalAllocation > 100) {
    //         return redirect()->back()->withInput()->withErrors(['allocationpercentage' => 'Total allocation percentage for this user exceeds 100%.']);
    //     }
    
    //     // Prepare data for updating
    //     $updateData = [
    //         'project_id' => $projectId,
    //         'userDepartment' => $request->input('userDepartment'),
    //         'userDesignation' => $request->input('userDesignation'),
    //         'allocationpercentage' => $allocationPercentage,
    //         'status' => 1,
    //         'startdate' => $startdate,
    //         'enddate' => $enddate,
    //     ];
    
    //     // Update the existing record
    //     $existingProject->update($updateData);
    
    //     // Send notification email with old allocation percentage
    //     $project = AddProjects::find($projectId);
    //     $employee = employees::find($userId);
    
    //     Mail::to($employee->officialemail)->send(new UserAllocatedChangeToProject($employee, $project, $allocationPercentage, $oldAllocationPercentage, $startdate, $enddate));
    
    //     return redirect()->route('addWorksEmployee.id', ['id' => $projectId])->with('status', 'Employee Updated Successfully');
    // }
    public function addworkesEmployeeUpdateStore(Request $request)
{
    // Validate the request inputs
    $validator = Validator::make($request->all(), [
        'employee_Id' => 'required|exists:employees,id',
        // 'projectId' => 'required|exists:projects,id', // Ensure the project ID is validated
        'userDepartment' => 'required|string',
        'userDesignation' => 'required|string',
        'allocationpercentage' => 'required|numeric|min:1|max:100',
        'startdate' => 'required|date',
        'enddate' => 'required|date|after_or_equal:startdate',
        'employee_id' => 'required|exists:addworkes_employees,id' // ID for the record to update
    ], [
        'employee_Id.required' => 'The employee ID is required.',
        'employee_Id.exists' => 'The selected employee does not exist.',
        'projectId.required' => 'The project ID is required.',
        'projectId.exists' => 'The selected project does not exist.',
        'userDepartment.required' => 'The department field is required.',
        'userDesignation.required' => 'The designation field is required.',
        'allocationpercentage.required' => 'The allocation percentage is required.',
        'allocationpercentage.numeric' => 'The allocation percentage must be a number.',
        'allocationpercentage.min' => 'The allocation percentage must be at least :min%.',
        'allocationpercentage.max' => 'The allocation percentage may not be greater than :max%.',
        'startdate.required' => 'The start date is required.',
        'startdate.date' => 'The start date must be a valid date.',
        'enddate.required' => 'The end date is required.',
        'enddate.date' => 'The end date must be a valid date.',
        'enddate.after_or_equal' => 'The end date must be a date after or equal to the start date.',
        'employee_id.required' => 'The employee ID for updating is required.',
        'employee_id.exists' => 'The record to update does not exist.'
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withInput()->withErrors($validator);
    }

    // Extract input values
    $employeeId = $request->input('employee_id'); // ID for the record to update
    $projectId = $request->input('projectId');
    $userId = $request->input('employee_Id');
    $allocationPercentage = $request->input('allocationpercentage');
    $startdate = $request->input('startdate');
    $enddate = $request->input('enddate');

    // Check if the employee record to update exists
    $existingProject = AddworkesEmployee::find($employeeId);
    if (!$existingProject) {
        return redirect()->back()->with('status', 'Employee record not found.');
    }

    // Get the old allocation percentage
    $oldAllocationPercentage = $existingProject->allocationpercentage;

    // Check for duplicate assignment
    $duplicateAssignment = AddworkesEmployee::where('employee_Id', $userId)
        ->where('project_id', $projectId)
        ->where('id', '!=', $employeeId) // Exclude current record from the check
        ->where('is_deleted', 0) // Ensure to consider only non-deleted records
        ->first();
        // dd($duplicateAssignment);

    if ($duplicateAssignment) {
        return redirect()->back()->withInput()->withErrors(['employee_Id' => 'This employee is already assigned to the selected project.']);
    }

    // Check the total allocation percentage considering only non-deleted records
    $currentAllocationPercentage = $existingProject->allocationpercentage;
    $totalAllocation = AddworkesEmployee::where('employee_Id', $userId)
        ->where('id', '!=', $employeeId) // Exclude current record from the check
        ->where('is_deleted', 0) // Consider only non-deleted records
        ->sum('allocationpercentage');
    $newTotalAllocation = $totalAllocation + $allocationPercentage - $currentAllocationPercentage;

    if ($newTotalAllocation > 100) {
        return redirect()->back()->withInput()->withErrors(['allocationpercentage' => 'Total allocation percentage for this user exceeds 100%.']);
    }

    // Prepare data for updating
    $updateData = [
        'project_id' => $projectId,
        'userDepartment' => $request->input('userDepartment'),
        'userDesignation' => $request->input('userDesignation'),
        'allocationpercentage' => $allocationPercentage,
        'status' => 1,
        'is_deleted' => 0,
        'startdate' => $startdate,
        'enddate' => $enddate,
    ];

    // Update the existing record
    $existingProject->update($updateData);

    // Send notification email with old allocation percentage
    $project = AddProjects::find($projectId);
    $employee = employees::find($userId);

    Mail::to($employee->officialemail)->send(new UserAllocatedChangeToProject($employee, $project, $allocationPercentage, $oldAllocationPercentage, $startdate, $enddate));

    return redirect()->route('addWorksEmployee.id', ['id' => $projectId])->with('status', 'Employee Updated Successfully');
}
    //     public function addworkesEmployeeStore(Request $request)
    // {
    //     $employeeId = $request->input('employee_id');
    //     $projectId = $request->input('projectId');
    //     $userId = $request->input('employee_Id');
    //     $allocationPercentage = $request->input('allocationpercentage');
    
    //     // Validate request inputs
    //     $request->validate([
    //         'employee_Id' => 'required|exists:employees,id',
    //         'projectId' => 'required|exists:projects,id',
    //         'userDepartment' => 'required|string',
    //         'userDesignation' => 'required|string',
    //         'allocationpercentage' => 'required|numeric|min:0|max:100',
    //         'startdate' => 'required|date',
    //         'enddate' => 'required|date|after_or_equal:startdate',
    //     ]);
    
    //     // Check for duplicate entry
    //     $existingEntry = AddworkesEmployee::where('employee_Id', $userId)
    //         ->where('project_id', $projectId)
    //         ->first();
    
    //     if ($existingEntry) {
    //         $errorMessage = 'This employee is already assigned to the selected project.';
    //         return redirect()->back()->withInput()->withErrors(['employee_Id' => $errorMessage]);
    //     }
    
    //     $addworkesEmployee = [
    //         'project_id' => $projectId,
    //         'userDepartment' => $request->input('userDepartment'),
    //         'userDesignation' => $request->input('userDesignation'),
    //         'employee_Id' => $userId,
    //         'allocationpercentage' => $allocationPercentage,
    //         'status' => 1,
    //         'startdate' => $request->input('startdate'),
    //         'enddate' => $request->input('enddate'),
    //     ];
    
    //     // Check if updating an existing record or creating a new one
    //     if ($employeeId) {
    //         $existingProject = AddworkesEmployee::find($employeeId);
    
    //         if ($existingProject) {
    //             $totalAllocation = AddworkesEmployee::where('employee_Id', $userId)
    //                 ->where('id', '!=', $employeeId)
    //                 ->sum('allocationpercentage');
    //             $newTotalAllocation = $totalAllocation + $allocationPercentage;
    
    //             if ($newTotalAllocation > 100) {
    //                 $errorMessage = 'Total allocation percentage for this user exceeds 100%';
    //                 return redirect()->back()->withInput()->withErrors(['allocationpercentage' => $errorMessage]);
    //             }
    
    //             $existingProject->fill($addworkesEmployee)->save();
    //             $project = AddProjects::find($projectId);
    //             $employee = employees::where('id', $userId)->first();
    //             Mail::to($employee->officialemail)->send(new UserAllocatedToProject($employee, $project, $allocationPercentage));
    //             return redirect()->route('addWorksEmployee.id', ['id' => $projectId])->with('status', 'Employee Updated Successfully');
    //         }
    //     } else {
    //         // Check total allocation for new record
    //         $totalAllocation = AddworkesEmployee::where('employee_Id', $userId)->sum('allocationpercentage');
    //         $newTotalAllocation = $totalAllocation + $allocationPercentage;
    
    //         if ($newTotalAllocation > 100) {
    //             $errorMessage = 'Total allocation percentage for this user exceeds 100%';
    //             return redirect()->back()->withInput()->withErrors(['allocationpercentage' => $errorMessage]);
    //         }
    
    //         $project = AddworkesEmployee::create($addworkesEmployee);
    
    //         if ($project) {
    //             $project = AddProjects::find($projectId);
    //             $employee = employees::where('id', $userId)->first();
    //             Mail::to($employee->officialemail)->send(new UserAllocatedToProject($employee, $project, $allocationPercentage));
    //             return redirect()->back()->with('status', 'Employee Added Successfully');
    //         } else {
    //             return redirect()->back()->with('status', 'Failed to Create Employee');
    //         }
    //     }
    // }
    public function addworkesEmployeeStore(Request $request)
{
    $employeeId = $request->input('employee_id');
    $projectId = $request->input('projectId');
    $userId = $request->input('employee_Id');
    $allocationPercentage = $request->input('allocationpercentage');
    $startDate = $request->input('startdate');
    $endDate = $request->input('enddate');

    // Custom validation messages
    $messages = [
        'employee_Id.required' => 'Employee ID is required.',
        'employee_Id.exists' => 'The selected employee does not exist.',
        'projectId.required' => 'Project ID is required.',
        'projectId.exists' => 'The selected project does not exist.',
        'userDepartment.required' => 'User department is required.',
        'userDepartment.string' => 'User department must be a string.',
        'userDesignation.required' => 'User designation is required.',
        'userDesignation.string' => 'User designation must be a string.',
        'allocationpercentage.required' => 'Allocation percentage is required.',
        'allocationpercentage.numeric' => 'Allocation percentage must be a number.',
        'allocationpercentage.min' => 'Allocation percentage must be at least 0.',
        'allocationpercentage.max' => 'Allocation percentage may not be greater than 100.',
        'startdate.required' => 'Start date is required.',
        'startdate.date' => 'Start date must be a valid date.',
        'enddate.required' => 'End date is required.',
        'enddate.date' => 'End date must be a valid date.',
        'enddate.after_or_equal' => 'End date must be a date after or equal to the start date.',
    ];

    // Validate request inputs with custom messages
    $request->validate([
        'employee_Id' => 'required|exists:employees,id',
        'projectId' => 'required|exists:projects,id',
        'userDepartment' => 'required|string',
        'userDesignation' => 'required|string',
        'allocationpercentage' => 'required|numeric|min:0|max:100',
        'startdate' => 'required|date',
        'enddate' => 'required|date|after_or_equal:startdate',
    ], $messages);

    // Check for duplicate entry within the date range
    $existingEntry = AddworkesEmployee::where('employee_Id', $userId)
        ->where('project_id', $projectId)
        ->where(function ($query) use ($startDate, $endDate) {
            $query->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('startdate', [$startDate, $endDate])
                      ->orWhereBetween('enddate', [$startDate, $endDate])
                      ->orWhere(function ($query) use ($startDate, $endDate) {
                          $query->where('startdate', '<=', $startDate)
                                ->where('enddate', '>=', $endDate);
                      });
            });
        })
        ->where('is_deleted', 0) // Ensure the entry is not deleted
        ->first();

    if ($existingEntry) {
        $errorMessage = 'This employee is already assigned to the selected project during the specified date range.';
        return redirect()->back()->withInput()->withErrors(['employee_Id' => $errorMessage]);
    }

    // Prepare data for insertion or update
    $addworkesEmployee = [
        'project_id' => $projectId,
        'userDepartment' => $request->input('userDepartment'),
        'userDesignation' => $request->input('userDesignation'),
        'employee_Id' => $userId,
        'allocationpercentage' => $allocationPercentage,
        'status' => 1, // Assuming status should be 1 for active
        'is_deleted' => 0, // Mark as not deleted
        'startdate' => $startDate,
        'enddate' => $endDate,
    ];

    // Check if updating an existing record or creating a new one
    if ($employeeId) {
        $existingProject = AddworkesEmployee::find($employeeId);

        if ($existingProject) {
            // Check total allocation for the employee
            $totalAllocation = AddworkesEmployee::where('employee_Id', $userId)
                ->where('is_deleted', 0) // Only include records where is_deleted = 0
                ->where('id', '!=', $employeeId)
                ->sum('allocationpercentage');
            $newTotalAllocation = $totalAllocation + $allocationPercentage;

            if ($newTotalAllocation > 100) {
                $errorMessage = 'Total allocation percentage for this user exceeds 100%';
                return redirect()->back()->withInput()->withErrors(['allocationpercentage' => $errorMessage]);
            }

            $existingProject->fill($addworkesEmployee)->save();
            $project = AddProjects::find($projectId);
            $employee = employees::where('id', $userId)->first();
            Mail::to($employee->officialemail)->send(new UserAllocatedToProject(
                $employee,
                $project,
                $allocationPercentage,
                $startDate,
                $endDate
            ));
            return redirect()->route('addWorksEmployee.id', ['id' => $projectId])->with('status', 'Employee Updated Successfully');
        }
    } else {
        // Check total allocation for a new record
        $totalAllocation = AddworkesEmployee::where('employee_Id', $userId)
            ->where('is_deleted', 0) // Only include records where is_deleted = 0
            ->sum('allocationpercentage');
        $newTotalAllocation = $totalAllocation + $allocationPercentage;

        if ($newTotalAllocation > 100) {
            $errorMessage = 'Total allocation percentage for this user exceeds 100%';
            return redirect()->back()->withInput()->withErrors(['allocationpercentage' => $errorMessage]);
        }

        $addworkesEmployee = AddworkesEmployee::create($addworkesEmployee);

        if ($addworkesEmployee) {
            $project = AddProjects::find($projectId);
            $employee = employees::where('id', $userId)->first();
            Mail::to($employee->officialemail)->send(new UserAllocatedToProject(
                $employee,
                $project,
                $allocationPercentage,
                $startDate,
                $endDate
            ));
            return redirect()->back()->with('status', 'Employee Added Successfully');
        } else {
            return redirect()->back()->with('status', 'Failed to Create Employee');
        }
    }
}

    public function editEmployeeWork($id)
    {
        $modules = Session::get('user_modules_' . auth()->id());
        $employee = AddworkesEmployee::findOrFail($id);
        if(Auth::user()->status == 0){
            return view('editEmployee', ['employee' => $employee], ['modules' => $modules]);

        }elseif(Auth::user()->status == 1){
            return view('users.editEmployeeUser', ['employee' => $employee]);


        }
    }
    public function fetchEmployeeName($employeeId)
    {
        $employee = employees::find($employeeId);

        if ($employee) {
            return response()->json([
                'id' => $employee->id,
                'name' => $employee->name,
            ]);
        } else {
            return response()->json(['error' => 'Employee not found'], 404);
        }
    }

    // public function deleteEmployee($id)
    // {
    //     $employee = AddworkesEmployee::find($id);

    //     if ($employee) {
    //         $employee->delete();
    //         Session::flash('success', 'Employee record deleted successfully.');
    //     } else {
    //         Session::flash('error', 'Failed to delete employee record.');
    //     }

    //     return redirect()->back();
    // }
    public function deleteEmployee($id)
    {
        $employee = AddworkesEmployee::find($id);

        if ($employee) {
            // $employee->delete();
            $employee->update(['is_deleted' => 1]); // Set status to 1 (marked as deleted)
            Session::flash('success', 'Employee record deleted successfully.');
        } else {
            Session::flash('error', 'Failed to delete employee record.');
        }

        return redirect()->back();
    }
//     public function checkAllocation(Request $request)
//     {
//         // dd($request->all());
//         $validatedData = $request->validate([
//             'employee_id' => 'required|exists:addworkes_employees,employee_id',
//             'allocation_percentage' => 'required|numeric|between:1,100',
//         ]);

//         $employeeId = $validatedData['employee_id'];
//         $allocationPercentage = $validatedData['allocation_percentage'];

//         $currentAllocation = AddworkesEmployee::where('employee_id', $employeeId)->sum('allocationpercentage');
// // dd($currentAllocation);
//         if ($currentAllocation + $allocationPercentage > 100) {
//             // dd('hle');
//             return response()->json([
//                 'error' => true,
//                 'message' => 'Total allocation percentage for this employee exceeds 100%.',
//             ]);
//         }

//         return response()->json([
          
//             'error' => false,
//             'message' => 'this user not allocation in Any projects.',
//         ]);
//     }
public function checkAllocation(Request $request)
{
    // Validate request inputs
    $validatedData = $request->validate([
        'employee_id' => 'required|exists:addworkes_employees,employee_id',
        'allocation_percentage' => 'required|numeric|between:1,100',
    ]);

    $employeeId = $validatedData['employee_id'];
    $allocationPercentage = $validatedData['allocation_percentage'];

    // Sum allocation percentages where is_deleted = 0
    $currentAllocation = AddworkesEmployee::where('employee_id', $employeeId)
        ->where('is_deleted', 0) // Only include records where is_deleted = 0
        ->sum('allocationpercentage');

    // Check if the new allocation exceeds the allowed limit
    if ($currentAllocation + $allocationPercentage > 100) {
        return response()->json([
            'error' => true,
            'message' => 'Total allocation percentage for this employee exceeds 100%.',
        ]);
    }

    return response()->json([
        'error' => false,
        'message' => 'This user is not allocated to any projects or has sufficient allocation available.',
    ]);
}
   

}
