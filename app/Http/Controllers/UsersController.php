<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\employees;
use App\Models\AddworkesEmployee;
use App\Models\EmployeeImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\AddProjects;
use App\Models\TimeEntry;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;




class UsersController extends Controller
{


    // public function usersLogin(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         $user = Auth::user();
    //         $userDepartment = $user->userDepartment;
    //         $user->last_login_at = Carbon::now('Asia/Kolkata');

    //         $user->save();

    //         if (in_array($userDepartment, ['Delivery', 'Marketing', 'Business', 'HR', 'Business Admin'])) {
    //             $employeeId = $user->employee_Id;
    //             $usersImageCheck = EmployeeImage::where('employee_Id', $employeeId)->first();

    //             if ($usersImageCheck === null) {
    //                 $request->session()->flash('update_image', true);
    //             }

    //             return redirect('/user/dashboard');
    //         }
    //     } else {
    //         return redirect()->route('loginpage')->with('error', 'Invalid email or password');
    //     }
    // }
    //     public function usersLogin(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         $user = Auth::user();
    //         $userDepartment = $user->userDepartment;
    //         $employeeIds = $user->employee_Id;

    //         // Check if the user is an active employee
    //         $employeeDetails = employees::FindOrFail($employeeIds)->pluck('employeestatus');
    //         // dd($employeeDetails);



    //         if ($employeeDetails === 1) {
    //             // dd('hete');
    //             // die();
    //             Auth::logout(); // Log out the user
    //             return redirect()->route('loginpage')->with('error', 'Your account is not active.');
    //         }

    //         // Update last login time
    //         $user->last_login_at = Carbon::now('Asia/Kolkata');
    //         $user->save();

    //         if (in_array($userDepartment, ['Delivery', 'Marketing', 'Business', 'HR', 'Business Admin'])) {
    //             $employeeId = $user->employee_Id;
    //             $usersImageCheck = EmployeeImage::where('employee_Id', $employeeId)->first();

    //             if ($usersImageCheck === null) {
    //                 $request->session()->flash('update_image', true);
    //             }

    //             return redirect('/user/dashboard');
    //         }
    //     } else {
    //         return redirect()->route('loginpage')->with('error', 'Invalid email or password');
    //     }
    // }
    // public function usersLogin(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         $user = Auth::user();
    //         $userDepartment = $user->userDepartment;
    //         $employeeId = $user->employee_Id;

    //         // Check if the user is an active employee
    //         $employee = employees::find($employeeId);

    //         if ($employee && $employee->employeestatus === 1) { // Assuming 1 indicates inactive
    //             Auth::logout(); // Log out the user
    //             return redirect()->route('loginpage')->with('error', 'Your account is not active.');
    //         }else{

    //             $user->last_login_at = Carbon::now('Asia/Kolkata');
    //             $user->save();

    //             if (in_array($userDepartment, ['Delivery', 'Marketing', 'Business', 'HR', 'Business Admin'])) {
    //                 $usersImageCheck = EmployeeImage::where('employee_Id', $employeeId)->first();

    //                 if ($usersImageCheck === null) {
    //                     $request->session()->flash('update_image', true);
    //                 }

    //                 return redirect('/user/dashboard');
    //             }
    //         }

    //         // Update last login time
    //     } else {
    //         return redirect()->route('loginpage')->with('error', 'Invalid email or password');
    //     }
    // }
    public function usersLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $userDepartment = $user->userDepartment;
            $employeeId = $user->employee_Id;

            // Check if the user is an active employee
            $employee = employees::find($employeeId);

            if ($employee->employeestatus == 1) { // Assuming 1 indicates inactive
                Auth::logout(); // Log out the user
                return redirect()->route('loginpage')->with('error', 'Your account is not active.');
            }

            // Update last login time
            $user->last_login_at = Carbon::now('Asia/Kolkata');
            $user->save();

            if (in_array($userDepartment, ['Delivery', 'Marketing', 'Business', 'HR', 'Business Admin'])) {
                $usersImageCheck = EmployeeImage::where('employee_Id', $employeeId)->first();

                if ($usersImageCheck === null) {
                    $request->session()->flash('update_image', true);
                }

                return redirect('/user/dashboard');
            }
        } else {
            return redirect()->route('loginpage')->with('error', 'Invalid email or password');
        }
    }





    public function dashboard(Request $request)
    {

        $usersDetails = Auth::user()->employee_Id;
        $employeeDetailsId = $usersDetails;
        $usersImageCheck = EmployeeImage::where('employee_Id', $usersDetails)->first();
        $usersImage = $usersImageCheck ? $usersImageCheck->imageName : null;
        Session::put('usersImage', $usersImage);

        $employeeDetails = employees::where('id', $usersDetails)->first();
        $usersDetailsGet = \App\Models\addworkesEmployee::where('employee_Id', $usersDetails)->where('is_deleted', 0)->with('project')->paginate(10);
        $projectIds = $usersDetailsGet->pluck('project_id');
        // dd($projectIds);
        $projectManagersName = [];

        foreach ($projectIds as $projectId) {
            $projectManagers = \App\Models\addworkesEmployee::where('project_id', $projectId)
                ->where('userDesignation', 'Project Manager')
                ->get();
            $projectManagerEmployeeIds = $projectManagers->pluck('employee_Id');
            $projectManagersData =
                User::whereIn('employee_Id', $projectManagerEmployeeIds)->get();

            $projectManagerNames = $projectManagersData->pluck('name')->implode(', ');
            $projectManagersName[$projectId] = $projectManagerNames;
        }

        $projectDetails = AddProjects::where('pmemployeeId', $usersDetails)->get();
        $projectIds = $projectDetails->pluck('id')->toArray();

        $approvedCount = TimeEntry::where(function ($query) use ($projectIds) {
            $query->whereIn('project_id', $projectIds)
                ->where('status', 1);
        })->count();
        $rejectedCount = TimeEntry::where(function ($query) use ($projectIds) {
            $query->whereIn('project_id', $projectIds)
                ->where('status', 2);
        })->count();
        $pendingCount = TimeEntry::where(function ($query) use ($projectIds) {
            $query->whereIn('project_id', $projectIds)
                ->where('status', 0);
        })->count();
        $currentMonthStart = now()->startOfMonth();
        $currentMonthEnd = now()->endOfMonth();

        $employeeDetailsWithProjects = \App\Models\addworkesEmployee::whereIn('project_id', $projectIds)
            ->where('is_deleted', 0)
            ->whereHas('project', function ($query) use ($currentMonthStart, $currentMonthEnd) {
                $query->whereBetween('enddate', [$currentMonthStart, $currentMonthEnd]);
            })
            ->get();
        $expiringCount = $employeeDetailsWithProjects->count();

        $expiringEmployeeData = $employeeDetailsWithProjects->map(function ($employee) {
            $pmEmployeeId = $employee->project->pmemployeeId;

            $pmEmployeeName = employees::where('id', $pmEmployeeId)->value('name');

            return [
                'employee_id' => $employee->employee_Id,
                'employee_name' => $employee->employee->name,
                'project_id' => $employee->project->id,
                'pm_employee_id' => $pmEmployeeId,
                'pm_employee_name' => $pmEmployeeName, // Add the PM name here
                'project_name' => $employee->project->projectname,
                'start_date' => $employee->startdate,
                'end_date' => $employee->enddate,
                'allocationpercentage' => $employee->allocationpercentage,
            ];
        });


        if (auth()->user()->isProjectManager()) {
            return view('users.usersDashboard', compact('usersDetailsGet', 'projectManagersName', 'approvedCount', 'rejectedCount', 'pendingCount', 'expiringCount'));
        } else {

            return view('users.usersDashboard', compact('usersDetailsGet', 'projectManagersName'));
        }
    }


    public function approvedDataByPm()
    {
        // dd('here');
        $usersDetails = Auth::user()->employee_Id;

        $projectDetails = AddProjects::where('pmemployeeId', $usersDetails)->get();
        $projectIds = $projectDetails->pluck('id')->toArray();

        $approvedData = TimeEntry::whereIn('project_id', $projectIds)
            ->where('status', 1)
            ->with(['project', 'employee'])
            ->orderBy('date', 'desc')
            ->paginate(15);

        $data = $approvedData->map(function ($timeEntry) {
            return [
                'employeeName' => $timeEntry['employee']['name'],
                'weeksDate' => $timeEntry['date'],
                'projectName' => $timeEntry['project']['projectname'],
            ];
        });

        return view('users.dashboardApprovedDataPm', [
            'approvedData' => $data,
            'pagination' => $approvedData,
        ]);
    }

    public function pendingDataByPm()
    {
        $usersDetails = Auth::user()->employee_Id;

        $projectDetails = AddProjects::where('pmemployeeId', $usersDetails)->get();
        $projectIds = $projectDetails->pluck('id')->toArray();
        $approvedData = TimeEntry::whereIn('project_id', $projectIds)
            ->where('status', 0)
            ->with(['project', 'employee'])
            ->orderBy('date', 'desc')
            ->paginate(15);
        $data = [];
        foreach ($approvedData as $timeEntry) {
            $data[] = [
                'employeeName' => $timeEntry['employee']['name'],
                'weeksDate' => $timeEntry['date'],
                'projectName' => $timeEntry['project']['projectname'],
            ];
        }
        return view('users.dashboarpendingDataPm', [
            'approvedData' => $data,
            'pagination' => $approvedData,
        ]);
    }
    public function rejectedDataByPm()
    {
        $usersDetails = Auth::user()->employee_Id;

        $projectDetails = AddProjects::where('pmemployeeId', $usersDetails)->get();
        $projectIds = $projectDetails->pluck('id')->toArray();
        $approvedData = TimeEntry::whereIn('project_id', $projectIds)
            ->where('status', 2)
            ->with(['project', 'employee'])
            ->orderBy('date', 'desc')
            ->paginate(10);

        $data = [];
        foreach ($approvedData as $timeEntry) {
            $data[] = [
                'employeeName' => $timeEntry['employee']['name'],
                'weeksDate' => $timeEntry['date'],
                'projectName' => $timeEntry['project']['projectname'],
            ];
        }
        return view('users.dashboardRejectedDataPm', [
            'approvedData' => $data,
            'pagination' => $approvedData
        ]);
    }


    public function fetchdataProjectManager(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $employeeid = $request->input('employeeid');

        // Debug: Print received inputs

        $projectsDetails = AddProjects::where('pmemployeeId', $employeeid)->get();
        $projectIds = $projectsDetails->pluck('id');

        // Debug: Print project IDs

        $entries = DB::table('time_entries')
            ->whereIn('project_id', $projectIds)
            ->where('employee_id', $employeeid)
            ->whereBetween('date', [$start_date, $end_date])
            ->whereIn('status', [0, 1, 2])
            ->orderBy('date', 'desc')
            ->get();

        // Debug: Print fetched entries
        // dd($entries);

        $approvedCount = $entries->where('status', 1)->count();
        $rejectedCount = $entries->where('status', 2)->count();
        $pendingCount = $entries->where('status', 0)->count();

        return response()->json([
            'approvedCount' => $approvedCount,
            'pendingCount' => $pendingCount,
            'rejectedCount' => $rejectedCount,
        ]);
    }



    public function userView()
    {
        $usersDetails = Auth::user()->employee_Id;
        $usersImageCheck = EmployeeImage::where('employee_Id', $usersDetails)->first();
        $usersImage = $usersImageCheck ? $usersImageCheck->imageName : null;

        $employeeDetails = employees::where('id', $usersDetails)->first();
        return view('users.usersProfile', compact('employeeDetails', 'usersImage'));
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'employeeImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('employeeImage')) {
            $image = $request->file('employeeImage');
            $employeeId = auth()->user()->employee_Id;
            $imageName = $employeeId . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('usersImage'), $imageName);

            $employeeImage = new EmployeeImage();
            $employeeImage->employee_Id = $employeeId;
            $employeeImage->imageName = $imageName;
            $employeeImage->save();

            return redirect('/user/dashboard')->with('success', 'Image uploaded successfully!');
        } else {
            return redirect('/user/dashboard')->with('error', 'Image upload failed!');
        }
    }
    public function expiringDataPM(){
        // dd('here');
        $usersDetails = Auth::user()->employee_Id;
        $employeeDetailsId = $usersDetails;
        $usersImageCheck = EmployeeImage::where('employee_Id', $usersDetails)->first();
        $usersImage = $usersImageCheck ? $usersImageCheck->imageName : null;
        Session::put('usersImage', $usersImage);

        $employeeDetails = employees::where('id', $usersDetails)->first();
        $usersDetailsGet = \App\Models\addworkesEmployee::where('employee_Id', $usersDetails)->where('is_deleted', 0)->with('project')->paginate(10);
        $projectIds = $usersDetailsGet->pluck('project_id');
        $currentMonthStart = now()->startOfMonth();
        $currentMonthEnd = now()->endOfMonth();

        $employeeDetailsWithProjects = \App\Models\addworkesEmployee::whereIn('project_id', $projectIds)
            ->where('is_deleted', 0)
            ->whereHas('project', function ($query) use ($currentMonthStart, $currentMonthEnd) {
                $query->whereBetween('enddate', [$currentMonthStart, $currentMonthEnd]);
            })
            ->get();
        $expiringCount = $employeeDetailsWithProjects->count();

        $expiringEmployeeData = $employeeDetailsWithProjects->map(function ($employee) {
            $pmEmployeeId = $employee->project->pmemployeeId;

            $pmEmployeeName = employees::where('id', $pmEmployeeId)->value('name');

            return [
                'employee_id' => $employee->employee_Id,
                'employee_name' => $employee->employee->name,
                'project_id' => $employee->project->id,
                'pm_employee_id' => $pmEmployeeId,
                'pm_employee_name' => $pmEmployeeName, // Add the PM name here
                'project_name' => $employee->project->projectname,
                'start_date' => $employee->startdate,
                'end_date' => $employee->enddate,
                'allocationpercentage' => $employee->allocationpercentage,
            ];
        });
        // echo('<pre>');
        // print_r($expiringEmployeeData);
        // echo('</pre>');
        // die();
        return view('users.expiringDataPM',compact('expiringEmployeeData'));
    }
}
