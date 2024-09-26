<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\addworkesEmployee;
use App\Models\TimeEntry;
use App\Models\AddProjects;





class TeammatesheetController extends Controller
{

    public function teamMateSheet()
    {
        $userDetails = Auth::user()->userDesignation;
        $userLoginDetails = Auth::user()->employee_Id;

        if ($userDetails === 'Project Manager') {
            $assignedProjects = AddworkesEmployee::where('employee_Id', $userLoginDetails)->paginate(10);
            $projectManagerAssignedProjectIds = $assignedProjects->pluck('project_id')->toArray();
            $timeEntries = TimeEntry::whereIn('project_id', $projectManagerAssignedProjectIds)
                        ->where('status', 1)
                        ->with('employee')
                        ->get()
                        ->toArray();

            $projectHours = [];
            foreach ($timeEntries as $timeEntry) {
                $projectId = $timeEntry['project_id'];
                $projectName = AddProjects::find($projectId)->projectname;
                $projectStartDate = AddProjects::find($projectId)->projectstartdate;
                $projectEndDate = AddProjects::find($projectId)->projectenddate;

                $totalHours = $timeEntry['total_hours'];

                if (isset($projectHours[$projectId])) {
                    $projectHours[$projectId]['total_hours'] += $totalHours;
                } else {
                    $projectHours[$projectId] = [
                        'name' => $projectName,
                        'projectStartDate' => $projectStartDate,
                        'projectEndDate' => $projectEndDate,
                        'total_hours' => $totalHours,
                        'projectId' => $projectId,
                    ];
                }
            }

            return view('users.Teamsheet', compact('projectHours', 'assignedProjects'));
        } else {
            return view('users.Teamsheet')->with('error', 'You are not authorized to access this page.');
        }
    }


    // public function teamMateSheetHour($id)
    // {
    //     $projectId = $id;
    //     $timeEntries = TimeEntry::where('project_id', $projectId)
    //                     ->where('status', 1)
    //                     ->with('employee', 'addworkesEmployees')
    //                     ->get()
    //                     ->toArray();

    //     $employeeTotalHours = [];

    //     foreach ($timeEntries as $timeEntry) {
    //         $employeeId = $timeEntry['employee']['id'];
    //         $employeeName = $timeEntry['employee']['name'];
    //         $totalHours = $timeEntry['total_hours'];
    //         $relevantEmployeeAllocation = array_filter($timeEntry['addworkes_employees'], function ($allocation) use ($employeeId) {
    //             return $allocation['employee_Id'] == $employeeId;
    //         });
    //         $employeeAllcationStartDate = reset($relevantEmployeeAllocation)['startdate'];
    //         $employeeAllcationEndDate = reset($relevantEmployeeAllocation)['enddate'];
    //         $startDate = strtotime($employeeAllcationStartDate);
    //         $endDate = strtotime($employeeAllcationEndDate);
    //         $mondaysCount = 0;
    //         $mondaysDates = [];
    //         $submittedTimesheetDates = [];
    //         $pendingTimesheetDates = [];

    //         for ($currentDate = $startDate; $currentDate <= $endDate; $currentDate += 86400) {
    //             if (date('N', $currentDate) == 1) {
    //                 $mondaysCount++;
    //                 $mondaysDates[] = date('Y-m-d', $currentDate);
    //             }
    //         }

    //         $submittedTimesheets = TimeEntry::whereIn('date', $mondaysDates)
    //                              ->where('employee_id', $employeeId)
    //                              ->where('status', 1)
    //                              ->get();

    //         foreach ($submittedTimesheets as $timesheet) {
    //             $submittedTimesheetDates[] = $timesheet->date;
    //         }
    //         $submittedTimesheetsCount = count($submittedTimesheetDates);

    //         $pendingTimesheetDates = array_diff($mondaysDates, $submittedTimesheetDates);
    //         $pendingTimesheetsCount = count($pendingTimesheetDates);

    //         if (isset($employeeTotalHours[$employeeId])) {
    //             $employeeTotalHours[$employeeId]['total_hours'] += $totalHours;
    //         } else {
    //             $employeeTotalHours[$employeeId] = [
    //                 'name' => $employeeName,
    //                 'total_hours' => $totalHours,
    //                 'startDate' => $employeeAllcationStartDate,
    //                 'endDate' => $employeeAllcationEndDate,
    //                 'mondaysCount' => $mondaysCount,
    //                 'mondaysDates' => $mondaysDates,
    //                 'submittedTimesheetsCount' => $submittedTimesheetsCount,
    //                 'submittedTimesheetDates' => $submittedTimesheetDates,
    //                 'pendingTimesheetsCount' => $pendingTimesheetsCount,
    //                 'pendingTimesheetDates' => $pendingTimesheetDates,
    //             ];
    //         }
    //     }
    //     return view('users/employeeHours', compact('employeeTotalHours'));
    // }
<<<<<<< HEAD
    public function teamMateSheetHour($id)
=======
//     public function teamMateSheetHour($id)
// {
//     $projectId = $id;
//     $timeEntries = TimeEntry::where('project_id', $projectId)
//                     ->where('status', 1)
//                     ->with('employee', 'addworkesEmployees')
//                     ->get()
//                     ->toArray();

//     $employeeTotalHours = [];
//     $currentDate = strtotime(date('Y-m-d'));

//     foreach ($timeEntries as $timeEntry) {
//         $employeeId = $timeEntry['employee']['id'];
//         $employeeName = $timeEntry['employee']['name'];
//         $totalHours = $timeEntry['total_hours'];
//         $relevantEmployeeAllocation = array_filter($timeEntry['addworkes_employees'], function ($allocation) use ($employeeId) {
//             return $allocation['employee_Id'] == $employeeId;
//         });
//         $employeeAllcationStartDate = reset($relevantEmployeeAllocation)['startdate'];
//         $employeeAllcationEndDate = reset($relevantEmployeeAllocation)['enddate'];
//         $startDate = strtotime($employeeAllcationStartDate);
//         $endDate = strtotime($employeeAllcationEndDate);
//         $mondaysCount = 0;
//         $mondaysDates = [];
//         $submittedTimesheetDates = [];
//         $pendingTimesheetDates = [];
//         $pendingTimesheetDatesBeforeCurrent = [];

//         for ($currentDateLoop = $startDate; $currentDateLoop <= $endDate; $currentDateLoop += 86400) {
//             if (date('N', $currentDateLoop) == 1) {
//                 $mondaysCount++;
//                 $mondaysDates[] = date('Y-m-d', $currentDateLoop);
//             }
//         }

//         $submittedTimesheets = TimeEntry::whereIn('date', $mondaysDates)
//                              ->where('employee_id', $employeeId)
//                              ->where('status', 1)
//                              ->get();

//         foreach ($submittedTimesheets as $timesheet) {
//             $submittedTimesheetDates[] = $timesheet->date;
//         }
//         $submittedTimesheetsCount = count($submittedTimesheetDates);

//         $pendingTimesheetDates = array_diff($mondaysDates, $submittedTimesheetDates);

//         foreach ($pendingTimesheetDates as $date) {
//             if (strtotime($date) < $currentDate) {
//                 $pendingTimesheetDatesBeforeCurrent[] = $date;
//             }
//         }

//         $pendingTimesheetsCount = count($pendingTimesheetDatesBeforeCurrent);

//         if (isset($employeeTotalHours[$employeeId])) {
//             $employeeTotalHours[$employeeId]['total_hours'] += $totalHours;
//         } else {
//             $employeeTotalHours[$employeeId] = [
//                 'name' => $employeeName,
//                 'total_hours' => $totalHours,
//                 'startDate' => $employeeAllcationStartDate,
//                 'endDate' => $employeeAllcationEndDate,
//                 'mondaysCount' => $mondaysCount,
//                 'mondaysDates' => $mondaysDates,
//                 'submittedTimesheetsCount' => $submittedTimesheetsCount,
//                 'submittedTimesheetDates' => $submittedTimesheetDates,
//                 'pendingTimesheetsCount' => $pendingTimesheetsCount,
//                 'pendingTimesheetDates' => $pendingTimesheetDatesBeforeCurrent,
//             ];
//         }
//     }
//     // dd($employeeTotalHours);
//     return view('users/employeeHours', compact('employeeTotalHours'));
// }
// public function teamMateSheetHour($id)
// {
//     $projectId = $id;
//     $timeEntries = TimeEntry::where('project_id', $projectId)
//                     ->where('status', 1)
//                     ->with('employee', 'addworkesEmployees')
//                     ->get()
//                     ->toArray();

//     $employeeTotalHours = [];
//     $currentDate = strtotime(date('Y-m-d'));

//     foreach ($timeEntries as $timeEntry) {
//         $employeeId = $timeEntry['employee']['id'];
//         $employeeName = $timeEntry['employee']['name'];
//         $totalHours = $timeEntry['total_hours'];

//         // Filter relevant allocations
//         $relevantEmployeeAllocation = array_filter($timeEntry['addworkes_employees'], function ($allocation) use ($employeeId) {
//             return $allocation['employee_Id'] == $employeeId;
//         });

//         // Ensure $relevantEmployeeAllocation is not empty and is an array
//         if (!empty($relevantEmployeeAllocation) && is_array($relevantEmployeeAllocation)) {
//             $allocation = reset($relevantEmployeeAllocation);
//             $employeeAllcationStartDate = $allocation['startdate'] ?? null;
//             $employeeAllcationEndDate = $allocation['enddate'] ?? null;
//         } else {
//             $employeeAllcationStartDate = null;
//             $employeeAllcationEndDate = null;
//         }

//         // Convert dates to timestamps
//         $startDate = $employeeAllcationStartDate ? strtotime($employeeAllcationStartDate) : 0;
//         $endDate = $employeeAllcationEndDate ? strtotime($employeeAllcationEndDate) : $currentDate;

//         $mondaysCount = 0;
//         $mondaysDates = [];
//         $submittedTimesheetDates = [];
//         $pendingTimesheetDates = [];
//         $pendingTimesheetDatesBeforeCurrent = [];

//         // Loop through dates from startDate to endDate
//         for ($currentDateLoop = $startDate; $currentDateLoop <= $endDate; $currentDateLoop += 86400) {
//             if (date('N', $currentDateLoop) == 1) {
//                 $mondaysCount++;
//                 $mondaysDates[] = date('Y-m-d', $currentDateLoop);
//             }
//         }

//         // Get submitted timesheets for the given Mondays
//         $submittedTimesheets = TimeEntry::whereIn('date', $mondaysDates)
//                              ->where('employee_id', $employeeId)
//                              ->where('status', 1)
//                              ->get();

//         foreach ($submittedTimesheets as $timesheet) {
//             $submittedTimesheetDates[] = $timesheet->date;
//         }

//         $submittedTimesheetsCount = count($submittedTimesheetDates);

//         $pendingTimesheetDates = array_diff($mondaysDates, $submittedTimesheetDates);

//         foreach ($pendingTimesheetDates as $date) {
//             if (strtotime($date) < $currentDate) {
//                 $pendingTimesheetDatesBeforeCurrent[] = $date;
//             }
//         }

//         $pendingTimesheetsCount = count($pendingTimesheetDatesBeforeCurrent);

//         if (isset($employeeTotalHours[$employeeId])) {
//             $employeeTotalHours[$employeeId]['total_hours'] += $totalHours;
//         } else {
//             $employeeTotalHours[$employeeId] = [
//                 'name' => $employeeName,
//                 'total_hours' => $totalHours,
//                 'startDate' => $employeeAllcationStartDate,
//                 'endDate' => $employeeAllcationEndDate,
//                 'mondaysCount' => $mondaysCount,
//                 'mondaysDates' => $mondaysDates,
//                 'submittedTimesheetsCount' => $submittedTimesheetsCount,
//                 'submittedTimesheetDates' => $submittedTimesheetDates,
//                 'pendingTimesheetsCount' => $pendingTimesheetsCount,
//                 'pendingTimesheetDates' => $pendingTimesheetDatesBeforeCurrent,
//             ];
//         }
//     }
//     dd($employeeTotalHours);

//     return view('users/employeeHours', compact('employeeTotalHours'));
// }
// public function teamMateSheetHour($id)
// {
//     $projectId = $id;
//     $timeEntries = TimeEntry::where('project_id', $projectId)
//                     ->where('status', 1)
//                     ->with('employee', 'addworkesEmployees')
//                     ->get()
//                     ->toArray();

//     $employeeTotalHours = [];
//     $currentDate = strtotime(date('Y-m-d'));

//     foreach ($timeEntries as $timeEntry) {
//         $employeeId = $timeEntry['employee']['id'];
//         $employeeName = $timeEntry['employee']['name'];
//         $totalHours = $timeEntry['total_hours'];

//         // Filter relevant allocations
//         $relevantEmployeeAllocation = array_filter($timeEntry['addworkes_employees'], function ($allocation) use ($employeeId) {
//             return $allocation['employee_Id'] == $employeeId;
//         });

//         // Default allocation dates if not available
//         $employeeAllcationStartDate = null;
//         $employeeAllcationEndDate = null;

//         if (!empty($relevantEmployeeAllocation) && is_array($relevantEmployeeAllocation)) {
//             $allocation = reset($relevantEmployeeAllocation);
//             $employeeAllcationStartDate = $allocation['startdate'] ?? null;
//             $employeeAllcationEndDate = $allocation['enddate'] ?? null;
//         }

//         // Convert dates to timestamps, handle defaults
//         $startDate = $employeeAllcationStartDate ? strtotime($employeeAllcationStartDate) : 0;
//         $endDate = $employeeAllcationEndDate ? strtotime($employeeAllcationEndDate) : $currentDate;

//         $mondaysCount = 0;
//         $mondaysDates = [];
//         $submittedTimesheetDates = [];
//         $pendingTimesheetDates = [];
//         $pendingTimesheetDatesBeforeCurrent = [];

//         // Loop through dates from startDate to endDate
//         for ($currentDateLoop = $startDate; $currentDateLoop <= $endDate; $currentDateLoop += 86400) {
//             if (date('N', $currentDateLoop) == 1) {
//                 $mondaysCount++;
//                 $mondaysDates[] = date('Y-m-d', $currentDateLoop);
//             }
//         }

//         // Get submitted timesheets for the given Mondays
//         $submittedTimesheets = TimeEntry::whereIn('date', $mondaysDates)
//                              ->where('employee_id', $employeeId)
//                              ->where('status', 1)
//                              ->get();

//         foreach ($submittedTimesheets as $timesheet) {
//             $submittedTimesheetDates[] = $timesheet->date;
//         }

//         $submittedTimesheetsCount = count($submittedTimesheetDates);

//         $pendingTimesheetDates = array_diff($mondaysDates, $submittedTimesheetDates);

//         foreach ($pendingTimesheetDates as $date) {
//             if (strtotime($date) < $currentDate) {
//                 $pendingTimesheetDatesBeforeCurrent[] = $date;
//             }
//         }

//         $pendingTimesheetsCount = count($pendingTimesheetDatesBeforeCurrent);

//         if (isset($employeeTotalHours[$employeeId])) {
//             $employeeTotalHours[$employeeId]['total_hours'] += $totalHours;
//         } else {
//             $employeeTotalHours[$employeeId] = [
//                 'name' => $employeeName,
//                 'total_hours' => $totalHours,
//                 'startDate' => $employeeAllcationStartDate,
//                 'endDate' => $employeeAllcationEndDate,
//                 'mondaysCount' => $mondaysCount,
//                 'mondaysDates' => $mondaysDates,
//                 'submittedTimesheetsCount' => $submittedTimesheetsCount,
//                 'submittedTimesheetDates' => $submittedTimesheetDates,
//                 'pendingTimesheetsCount' => $pendingTimesheetsCount,
//                 'pendingTimesheetDates' => $pendingTimesheetDatesBeforeCurrent,
//             ];
//         }
//     }

//     // Debug output
//     dd($employeeTotalHours);

//     return view('users/employeeHours', compact('employeeTotalHours'));
// }
public function teamMateSheetHour($id)
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
{
    $projectId = $id;
    $timeEntries = TimeEntry::where('project_id', $projectId)
                    ->where('status', 1)
                    ->with('employee', 'addworkesEmployees')
                    ->get()
                    ->toArray();

    $employeeTotalHours = [];
    $currentDate = strtotime(date('Y-m-d'));

    foreach ($timeEntries as $timeEntry) {
        $employeeId = $timeEntry['employee']['id'];
        $employeeName = $timeEntry['employee']['name'];
        $totalHours = $timeEntry['total_hours'];
<<<<<<< HEAD
        $relevantEmployeeAllocation = array_filter($timeEntry['addworkes_employees'], function ($allocation) use ($employeeId) {
            return $allocation['employee_Id'] == $employeeId;
        });
        $employeeAllcationStartDate = reset($relevantEmployeeAllocation)['startdate'];
        $employeeAllcationEndDate = reset($relevantEmployeeAllocation)['enddate'];
        $startDate = strtotime($employeeAllcationStartDate);
        $endDate = strtotime($employeeAllcationEndDate);
=======

        // Filter relevant allocations
        $relevantEmployeeAllocation = array_filter($timeEntry['addworkes_employees'], function ($allocation) use ($employeeId) {
            return $allocation['employee_Id'] == $employeeId;
        });

        // Default allocation dates if not available
        $employeeAllcationStartDate = null;
        $employeeAllcationEndDate = null;

        if (!empty($relevantEmployeeAllocation) && is_array($relevantEmployeeAllocation)) {
            $allocation = reset($relevantEmployeeAllocation);
            $employeeAllcationStartDate = $allocation['startdate'] ?? null;
            $employeeAllcationEndDate = $allocation['enddate'] ?? null;
        }

        // Convert dates to timestamps, handle defaults
        $startDate = $employeeAllcationStartDate ? strtotime($employeeAllcationStartDate) : $currentDate - (365 * 86400); // Default to 1 year ago
        $endDate = $employeeAllcationEndDate ? strtotime($employeeAllcationEndDate) : $currentDate;

>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
        $mondaysCount = 0;
        $mondaysDates = [];
        $submittedTimesheetDates = [];
        $pendingTimesheetDates = [];
        $pendingTimesheetDatesBeforeCurrent = [];

<<<<<<< HEAD
=======
        // Ensure loop runs only within a reasonable range
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
        for ($currentDateLoop = $startDate; $currentDateLoop <= $endDate; $currentDateLoop += 86400) {
            if (date('N', $currentDateLoop) == 1) {
                $mondaysCount++;
                $mondaysDates[] = date('Y-m-d', $currentDateLoop);
            }
        }

<<<<<<< HEAD
=======
        // Get submitted timesheets for the given Mondays
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
        $submittedTimesheets = TimeEntry::whereIn('date', $mondaysDates)
                             ->where('employee_id', $employeeId)
                             ->where('status', 1)
                             ->get();

        foreach ($submittedTimesheets as $timesheet) {
            $submittedTimesheetDates[] = $timesheet->date;
        }
<<<<<<< HEAD
=======

>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
        $submittedTimesheetsCount = count($submittedTimesheetDates);

        $pendingTimesheetDates = array_diff($mondaysDates, $submittedTimesheetDates);

        foreach ($pendingTimesheetDates as $date) {
            if (strtotime($date) < $currentDate) {
                $pendingTimesheetDatesBeforeCurrent[] = $date;
            }
        }

        $pendingTimesheetsCount = count($pendingTimesheetDatesBeforeCurrent);

        if (isset($employeeTotalHours[$employeeId])) {
            $employeeTotalHours[$employeeId]['total_hours'] += $totalHours;
        } else {
            $employeeTotalHours[$employeeId] = [
                'name' => $employeeName,
                'total_hours' => $totalHours,
                'startDate' => $employeeAllcationStartDate,
                'endDate' => $employeeAllcationEndDate,
                'mondaysCount' => $mondaysCount,
                'mondaysDates' => $mondaysDates,
                'submittedTimesheetsCount' => $submittedTimesheetsCount,
                'submittedTimesheetDates' => $submittedTimesheetDates,
                'pendingTimesheetsCount' => $pendingTimesheetsCount,
                'pendingTimesheetDates' => $pendingTimesheetDatesBeforeCurrent,
            ];
        }
    }
<<<<<<< HEAD
    // dd($employeeTotalHours);
    return view('users/employeeHours', compact('employeeTotalHours'));
}
=======

    // Debug output
    // dd($employeeTotalHours);

    return view('users/employeeHours', compact('employeeTotalHours'));
}


>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
public function fetchProjectData(Request $request)
{
    $projectId = $request->input('project_id');
    
    // Fetch project data based on the selected project ID
    $project = AddProjects::find($projectId);
    $timeEntries = TimeEntry::where('project_id', $projectId)
                            ->where('status', 1)
                            ->with('employee')
                            ->get()
                            ->toArray();
// dd($timeEntries);
$projectHours = [];
foreach ($timeEntries as $timeEntry) {
    $projectId = $timeEntry['project_id'];
    $projectName = AddProjects::find($projectId)->projectname;
    $projectStartDate = AddProjects::find($projectId)->projectstartdate;
    $projectEndDate = AddProjects::find($projectId)->projectenddate;

    $totalHours = $timeEntry['total_hours'];

    if (isset($projectHours[$projectId])) {
        $projectHours[$projectId]['total_hours'] += $totalHours;
    } else {
        $projectHours[$projectId] = [
            'name' => $projectName,
            'projectStartDate' => $projectStartDate,
            'projectEndDate' => $projectEndDate,
            'total_hours' => $totalHours,
            'projectId' => $projectId,
        ];
    }
}
    // dd($projectData);

    return response()->json([
        'projectData' => $projectHours,
    ]);
}


}
