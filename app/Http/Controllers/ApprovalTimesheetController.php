<?php

namespace App\Http\Controllers;
<<<<<<< HEAD

=======
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\addworkesEmployee;
use App\Models\TimeEntry;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\TimeSheetApproved;
use App\Mail\TimeSheetRejected;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;


class ApprovalTimesheetController extends Controller
{
<<<<<<< HEAD




    public function approvalTimesheet()
    {
        $userDetails = Auth::user()->userDesignation;
        $userLoginDetails = Auth::user()->employee_Id;

        $TotalSubmitedData = [];

        if ($userDetails === 'Project Manager') {
            $assignedProjects = AddworkesEmployee::where('employee_Id', $userLoginDetails)->pluck('project_id')->toArray();

            // $timeEntries = TimeEntry::whereIn('project_id', $assignedProjects)
            //     ->with('employee', 'project', 'addworkesEmployees')
            //     ->get();
            $timeEntries = TimeEntry::whereIn('project_id', $assignedProjects)
            ->with('employee', 'project', 'addworkesEmployees')
            ->orderBy('date', 'desc') // Order by date descending
            ->get();

            foreach ($timeEntries as $timeEntry) {
                $timesheetId = $timeEntry->id;
                $projectId = $timeEntry->project_id;
                $projectSubmitedDate = $timeEntry->date;
                $projectSubmitedStatus = $timeEntry->status;
                $totalHours = $timeEntry->total_hours;
                $employeeName = $timeEntry->employee->name;
                $projectName = $timeEntry->project->projectname;

                $projectManagerStatus = null;

                foreach ($timeEntry->addworkesEmployees as $worker) {
                    if ($worker->employee_Id == $userLoginDetails) {
                        $projectManagerStatus = $worker->status;
                        break;
                    }
                }

                $TotalSubmitedData[] = [
                    'timesheetId' => $timesheetId,
                    'date' => $projectSubmitedDate,
                    'status' => $projectSubmitedStatus,
                    'total_hours' => $totalHours,
                    'employeeName' => $employeeName,
                    'projectName' => $projectName,
                    'projectId' => $projectId,
                    'projectManagerStatus' => $projectManagerStatus,
                    'approvedBy' => $userLoginDetails,
                ];
            }

            $collection = collect($TotalSubmitedData);

            $perPage = 15;
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $currentItems = $collection->forPage($currentPage, $perPage);

            $paginator = new LengthAwarePaginator(
                $currentItems,
                $collection->count(),
                $perPage,
                $currentPage,
                ['path' => Paginator::resolveCurrentPath()]
            );
            // dd($paginator);
            return view('users.approvalTimeSheet', ['TotalSubmitedData' => $paginator, 'assignedProjects' => $assignedProjects]);
        } else {
            return view('users.approvalTimeSheet')->with('error', 'You are not authorized to access this page.');
        }
    }
    public function description($id)
    {
        $timeEntry = TimeEntry::findOrFail($id);

        $description = $timeEntry->descriptions;

        // dd($description);

        // Return a view with the fetched description (optional)
        return view('users.timesheetdescription', compact('timeEntry'));
    }




=======
   


    
    public function approvalTimesheet()
{
    $userDetails = Auth::user()->userDesignation;
    $userLoginDetails = Auth::user()->employee_Id;

    $TotalSubmitedData = [];

    if ($userDetails === 'Project Manager') {
        $assignedProjects = AddworkesEmployee::where('employee_Id', $userLoginDetails)->pluck('project_id')->toArray();

       
        $timeEntries = TimeEntry::whereIn('project_id', $assignedProjects)
        ->with('employee', 'project', 'addworkesEmployees')
        ->orderBy('date', 'desc') // Order by date descending
        ->get();

        foreach ($timeEntries as $timeEntry) {
            $timesheetId = $timeEntry->id;
            $projectId = $timeEntry->project_id;
            $projectSubmitedDate = $timeEntry->date;
            $projectSubmitedStatus = $timeEntry->status;
            $totalHours = $timeEntry->total_hours;
            $employeeName = $timeEntry->employee->name;
            $projectName = $timeEntry->project->projectname;

            $projectManagerStatus = null;

            foreach ($timeEntry->addworkesEmployees as $worker) {
                if ($worker->employee_Id == $userLoginDetails) {
                    $projectManagerStatus = $worker->status;
                    break;
                }
            }

            $TotalSubmitedData[] = [
                'timesheetId' => $timesheetId,
                'date' => $projectSubmitedDate,
                'status' => $projectSubmitedStatus,
                'total_hours' => $totalHours,
                'employeeName' => $employeeName,
                'projectName' => $projectName,
                'projectId' => $projectId,
                'projectManagerStatus' => $projectManagerStatus,
                'approvedBy' => $userLoginDetails,
            ];
        }

        $collection = collect($TotalSubmitedData);

        $perPage = 15;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $collection->forPage($currentPage, $perPage);

        $paginator = new LengthAwarePaginator(
            $currentItems,
            $collection->count(),
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath()]
        );
// dd($paginator);
        return view('users.approvalTimeSheet', ['TotalSubmitedData' => $paginator, 'assignedProjects' => $assignedProjects]);
    } else {
        return view('users.approvalTimeSheet')->with('error', 'You are not authorized to access this page.');
    }
}
public function description($id)
{
    $timeEntry = TimeEntry::findOrFail($id);

    $description = $timeEntry->descriptions;

    // dd($description);

    // Return a view with the fetched description (optional)
    return view('users.timesheetdescription', compact('timeEntry'));
}
// public function approvalTimesheet()
//     {
//         $userDetails = Auth::user()->userDesignation;
//         $userLoginDetails = Auth::user()->employee_Id;

//         $TotalSubmitedData = [];

//         if ($userDetails === 'Project Manager') {
//             $assignedProjects = AddworkesEmployee::where('employee_Id', $userLoginDetails)->paginate(10);
//             $projectManagerAssignedProjectIds = $assignedProjects->pluck('project_id')->toArray();
//             $timeEntries = TimeEntry::whereIn('project_id', $projectManagerAssignedProjectIds)
//                 ->with('employee', 'project', 'addworkesEmployees')->get()->toArray();

//             foreach ($timeEntries as $timeEntry) {
//                 $timesheetId = $timeEntry['id'];
//                 $projectId = $timeEntry['project_id'];
//                 $projectSubmitedDate = $timeEntry['date'];
//                 $projectSubmitedStatus = $timeEntry['status'];
//                 $totalHours = $timeEntry['total_hours'];
//                 $employeeName = $timeEntry['employee']['name'];
//                 $projectName = $timeEntry['project']['projectname'];

//                 $projectManagerStatus = null;

//                 foreach ($timeEntry['addworkes_employees'] as $worker) {
//                     if ($worker['employee_Id'] == $userLoginDetails) {
//                         $projectManagerStatus = $worker['status'];
//                         break;
//                     }
//                 }

//                 $TotalSubmitedData[] = [
//                     'timesheetId' => $timesheetId,
//                     'date' => $projectSubmitedDate,
//                     'status' => $projectSubmitedStatus,
//                     'total_hours' => $totalHours,
//                     'employeeName' => $employeeName,
//                     'projectName' => $projectName,
//                     'projectId' => $projectId,
//                     'projectManagerStatus' => $projectManagerStatus,
//                     'approvedBy' => $userLoginDetails,
//                 ];
//             }
//             return view('users.approvalTimeSheet', compact('TotalSubmitedData', 'assignedProjects'));
//         } else {
//             return view('users.approvalTimeSheet')->with('error', 'You are not authorized to access this page.');
//         }
//     }


   
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
    public function updateStatusApprovalTimesheet(Request $request)
    {
        $request->validate([
            'status' => 'required|in:1,2',
            'timeSheet_Id' => 'required|exists:time_entries,id',
            'reason' => 'required_if:status,2',
            'approvedBy' => 'required_if:status,1',
        ]);

        $newStatus = $request->input('status');
        $timeSheetId = $request->input('timeSheet_Id');
        $approvedByEmployeeId = $request->input('approvedBy');

        $timeEntry = TimeEntry::findOrFail($timeSheetId);

        $timeEntry->status = $newStatus;
        $timeEntry->approvedby_employee_id = $approvedByEmployeeId;

        if ($newStatus == 2) {
            $rejectionReason = $request->input('reason');
            $timeEntry->rejectionReason = $rejectionReason;
        }

        $timeEntry->save();
        $userEmployeeId = $timeEntry->employee_id;
        $user = User::where('employee_Id', $userEmployeeId)->first();
        $projectManager = User::find($approvedByEmployeeId);
        $weekDates = $timeEntry->date;
        $totalHours = $timeEntry->total_hours;

        if ($newStatus == 1 && $user) {
            Mail::to($user->email)->send(new TimeSheetApproved($timeEntry, $user, $weekDates, $totalHours));
        } elseif ($newStatus == 2 && $user) {
            Mail::to($user->email)->send(new TimeSheetRejected($timeEntry, $user, $weekDates, $totalHours, $request->input('reason')));
        }
        return redirect()->back()->with('success', 'Time entry status updated successfully.');
    }


<<<<<<< HEAD

=======
   
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c

    public function get_project_data_by_projectmanager(Request $request)
    {
        $projectId = $request->input('projectId');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $userLoginDetails = Auth::user()->employee_Id;
<<<<<<< HEAD

        // Log the input values
        \Log::info("Project ID: $projectId, Start Date: $startDate, End Date: $endDate");

        $timeEntriesQuery = TimeEntry::with('employee', 'project');

=======
    
        // Log the input values
        \Log::info("Project ID: $projectId, Start Date: $startDate, End Date: $endDate");
    
        $timeEntriesQuery = TimeEntry::with('employee', 'project');
    
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
        if ($projectId && $projectId !== "All Projects") {
            $assignedProjects = AddworkesEmployee::where('employee_Id', $userLoginDetails)
                ->where('project_id', $projectId)
                ->pluck('project_id')
                ->toArray();
<<<<<<< HEAD

=======
    
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
            $timeEntriesQuery->whereIn('project_id', $assignedProjects);
        } else {
            $assignedProjects = AddworkesEmployee::where('employee_Id', $userLoginDetails)
                ->pluck('project_id')
                ->toArray();
<<<<<<< HEAD

            $timeEntriesQuery->whereIn('project_id', $assignedProjects);
        }

=======
    
            $timeEntriesQuery->whereIn('project_id', $assignedProjects);
        }
    
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
        if ($startDate) {
            $timeEntriesQuery->where('date', '>=', $startDate);
        }
        if ($endDate) {
            $timeEntriesQuery->where('date', '<=', $endDate);
        }
<<<<<<< HEAD

        \Log::info($timeEntriesQuery->toSql());

        $timeEntries = $timeEntriesQuery->get();

        return response()->json($timeEntries);
    }
=======
    
        \Log::info($timeEntriesQuery->toSql());
    
        $timeEntries = $timeEntriesQuery->get();
    
        return response()->json($timeEntries);
    }
    

>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
}
