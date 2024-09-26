<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\addworkesEmployee;
use Illuminate\Support\Facades\Auth;
use App\Models\TimeEntry;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;

class ReopenTimesheetController extends Controller
{
    public function ReopenTimesheetView()
    {
        $userDetails = Auth::user()->userDesignation;
        $userLoginDetails = Auth::user()->employee_Id;

        $TotalSubmitedData = [];

        if ($userDetails === 'Project Manager') {
            $assignedProjects = AddworkesEmployee::where('employee_Id', $userLoginDetails)->pluck('project_id')->toArray();
            $timeEntries = TimeEntry::whereIn('project_id', $assignedProjects)
                ->where('status', 3)
                ->with('employee', 'project', 'addworkesEmployees')
                ->orderBy('date', 'desc')
                ->get();
            foreach ($timeEntries as $timeEntry) {
                $timesheetId = $timeEntry->id;
                $is_ProjectManagers = $timeEntry->is_ProjectManagers;
                $reopenReasonUser = $timeEntry->reopen_reason_user;
                $projectId = $timeEntry->project_id;
                $projectSubmitedDate = $timeEntry->date;
                $projectSubmitedStatus = $timeEntry->status;
                $totalHours = $timeEntry->total_hours;
                $employeeName = $timeEntry->employee->name;
                $projectName = $timeEntry->project->projectname;

                $projectManagerStatus = null;



                $TotalSubmitedData[] = [
                    'timesheetId' => $timesheetId,
                    'date' => $projectSubmitedDate,
                    'status' => $projectSubmitedStatus,
                    'total_hours' => $totalHours,
                    'employeeName' => $employeeName,
                    'projectName' => $projectName,
                    'projectId' => $projectId,
                    'is_ProjectManagers' => $is_ProjectManagers,
                    'approvedBy' => $userLoginDetails,
                    'reopenReasonUser' => $reopenReasonUser,
                ];
            }
            return view('users.ReopenTimesheet', ['assignedProjects' => $assignedProjects, 'TotalSubmitedData' => $TotalSubmitedData]);
        } else {
            return view('users.ReopenTimesheet')->with('error', 'You are not authorized to access this page.');
        }
    }


    public function updateApprovalStatus(Request $request)
    {
        $request->validate([
            'status' => 'required|integer',
            'reason' => 'sometimes|required|string',
        ], [], [
            'reason' => 'Reason',
        ]);
    
        if ($request->status == 0) {
            $request->validate([
                'reason' => 'required|string',
            ]);
        }

        $date = Carbon::now()->setTimezone('Asia/Kolkata');

        $timesheetId = $request->input('id');
        $status = $request->input('status');
        $reason = $request->input('reason');



        $record = TimeEntry::find($timesheetId);

        if ($record) {
            $record->is_ProjectManagers = $status;
            $record->reopen_rejected_reason_pm = $reason;
            $record->approved_rejected_date = $date;
            $record->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }


    // public function timesheetReOpen()
    // {
    //     $userDetails = Auth::user()->userDepartment;
    //     $modules = Session::get('user_modules_' . auth()->id());
    //     if ($userDetails === 'Admin' || 'Delivery Head') {
    //         $reopenTimesheet = TimeEntry::where('status', 3)->with('employee', 'project', 'addworkesEmployees')->get();
    //         $TotalSubmitedData = [];
    //         foreach ($reopenTimesheet as $timeEntry) {
    //             $timesheetId = $timeEntry->id;
    //             $is_ProjectManagers = $timeEntry->is_ProjectManagers;
    //             $pmRejectReason = $timeEntry->reopen_rejected_reason_pm;
    //             $pmApproveRejectedTime = $timeEntry->approved_rejected_date;
    //             $userRejectReason = $timeEntry->reopen_reason_user;
    //             $is_Admin = $timeEntry->is_Admin;



    //             $projectId = $timeEntry->project_id;
    //             $projectSubmitedDate = $timeEntry->date;
    //             $projectSubmitedStatus = $timeEntry->status;
    //             $totalHours = $timeEntry->total_hours;
    //             $employeeName = $timeEntry->employee->name;
    //             $projectName = $timeEntry->project->projectname;

    //             $projectManagerStatus = null;



    //             $TotalSubmitedData[] = [
    //                 'timesheetId' => $timesheetId,
    //                 'date' => $projectSubmitedDate,
    //                 'pmRejectReason' =>$pmRejectReason,
    //                 'pmApproveRejectedTime' => $pmApproveRejectedTime,
    //                 'userRejectReason' => $userRejectReason,
    //                 'status' => $projectSubmitedStatus,
    //                 'total_hours' => $totalHours,
    //                 'employeeName' => $employeeName,
    //                 'projectName' => $projectName,
    //                 'projectId' => $projectId,
    //                 'is_ProjectManagers' => $is_ProjectManagers,
    //                 'is_Admin' => $is_Admin,
    //             ];
    //         }
    //         return view('ReopenTimesheet', ['TotalSubmitedData' => $TotalSubmitedData, 'modules' => $modules]);
    //     } else {
    //         return view('ReopenTimesheet')->with('error', 'You are not authorized to access this page.');
    //     }
    // }

<<<<<<< HEAD
=======
    public function updateAdminApprovalStatus(Request $request)
    {
        $status = $request->input('status');
        $status2 = $request->input('status2');
        $id = $request->input('id');

        $timesheet = TimeEntry::find($id);
        if ($timesheet) {
            $timesheet->is_Admin = $status;
            $timesheet->status = $status2;
            $timesheet->save();


            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
//     public function timesheetReOpen()
// {
//     $userDetails = Auth::user()->userDepartment;
//     $modules = Session::get('user_modules_' . auth()->id());

//     if (in_array($userDetails, ['Admin', 'Delivery Head'])) {
//         $reopenTimesheet = TimeEntry::where('status', 3)
//                                     ->with('employee', 'project', 'addworkesEmployees')
//                                     ->get();
        
//         $TotalSubmitedData = [];

//         foreach ($reopenTimesheet as $timeEntry) {
//             $TotalSubmitedData[] = [
//                 'timesheetId' => $timeEntry->id,
//                 'date' => $timeEntry->date,
//                 'pmRejectReason' => $timeEntry->reopen_rejected_reason_pm,
//                 'pmApproveRejectedTime' => $timeEntry->approved_rejected_date,
//                 'userRejectReason' => $timeEntry->reopen_reason_user,
//                 'status' => $timeEntry->status,
//                 'total_hours' => $timeEntry->total_hours,
//                 'employeeName' => $timeEntry->employee->name,
//                 'projectName' => $timeEntry->project->projectname,
//                 'projectId' => $timeEntry->project_id,
//                 'is_ProjectManagers' => $timeEntry->is_ProjectManagers,
//                 'is_Admin' => $timeEntry->is_Admin,
//             ];
//         }

//         return view('ReopenTimesheet', compact('TotalSubmitedData', 'modules'));
//     } else {
//         return view('ReopenTimesheet')->with('error', 'You are not authorized to access this page.');
//     }
// }
public function timesheetReOpen()
{
    $userDetails = Auth::user()->userDepartment;
    $modules = Session::get('user_modules_' . auth()->id());

    if (in_array($userDetails, ['Admin', 'Delivery Head'])) {
        $reopenTimesheet = TimeEntry::where('status', 3)
                                    ->with('employee', 'project', 'addworkesEmployees')
                                    ->get();
        
        $TotalSubmitedData = [];

        foreach ($reopenTimesheet as $timeEntry) {
            $TotalSubmitedData[] = [
                'timesheetId' => $timeEntry->id,
                'date' => $timeEntry->date,
                'pmRejectReason' => $timeEntry->reopen_rejected_reason_pm,
                'pmApproveRejectedTime' => $timeEntry->approved_rejected_date,
                'userRejectReason' => $timeEntry->reopen_reason_user,
                'status' => $timeEntry->status,
                'total_hours' => $timeEntry->total_hours,
                'employeeName' => $timeEntry->employee->name,
                'projectName' => $timeEntry->project->projectname,
                'projectId' => $timeEntry->project_id,
                'is_ProjectManagers' => $timeEntry->is_ProjectManagers,
                'is_Admin' => $timeEntry->is_Admin,
            ];
        }

        // Debug output
        \Log::info('TotalSubmitedData:', $TotalSubmitedData);

        return view('ReopenTimesheet', compact('TotalSubmitedData', 'modules'));
    } else {
        return view('ReopenTimesheet')->with('error', 'You are not authorized to access this page.');
    }
}

<<<<<<< HEAD

    public function updateAdminApprovalStatus(Request $request)
    {
        $status = $request->input('status');
        $status2 = $request->input('status2');
        $id = $request->input('id');

        $timesheet = TimeEntry::find($id);
        if ($timesheet) {
            $timesheet->is_Admin = $status;
            $timesheet->status = $status2;
            $timesheet->save();


            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
=======
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
}
