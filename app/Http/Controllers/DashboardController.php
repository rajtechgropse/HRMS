<?php

namespace App\Http\Controllers;

use App\Models\employees;
use Illuminate\Support\Facades\Session;
use App\Models\TimeEntry;
use App\Models\addworkesEmployee;
use Carbon\Carbon;



use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // public function dashboard()
    // {

    //     $approvedCount = TimeEntry::where('status', 1)->count();
    //     $pendingCount = TimeEntry::where('status', 0)->count();
    //     $rejectedCount = TimeEntry::where('status', 2)->count();
    //     $allEmployeeIds = employees::where('department', '0')->pluck('id');

    //     $employeesWithAddWorkRecords = addworkesEmployee::pluck('employee_id')->unique();

    //     $employeesWithoutAddWorkRecords = $allEmployeeIds->diff($employeesWithAddWorkRecords);

    //     $employeesWithoutAddWorkRecordsDetails = employees::whereIn('id', $employeesWithoutAddWorkRecords)->get();
    //     $employeesWithoutAddWorkRecordsDetailsCount = employees::whereIn('id', $employeesWithoutAddWorkRecords)->count();

    //     $modules = Session::get('user_modules_' . auth()->id());

    //     // dd($beachDetailsCount);

    //     if (!array_key_exists($key, $employeeData) && !empty($pendingTimesheetDatesBeforeCurrent)) {
    //         $employeeData[$key] = [
    //             'employee_name' => $employeeName,
    //             'project_name' => $projectName,
    //             'pending_dates' => $pendingTimesheetDatesBeforeCurrent,
    //             'beachDetailsCount' => $beachDetailsCount,

    //         ];
    //     }


    //     $employeeDataCollection = collect(array_values($employeeData)); // Use array_values to reindex

    //     // Count the total number of entries
    //     $totalEntries = $employeeDataCollection->count();

    //     return view('dashboard', ['modules' => $modules, 'approvedCount' => $approvedCount, 'pendingCount' => $pendingCount, 'rejectedCount' => $rejectedCount, 'employeesWithoutAddWorkRecordsDetailsCount' => $employeesWithoutAddWorkRecordsDetailsCount, 'totalEntries' => $totalEntries, 'beachDetailsCount' => $beachDetailsCount]);
    // }
    public function dashboard()
    {
        // Count the status of time entries
        $currentDate = \Carbon\Carbon::now()->format('Y-m-d');

        $approvedCount = TimeEntry::where('status', 1)->count();
        $pendingCount = TimeEntry::where('status', 0)->count();
        $rejectedCount = TimeEntry::where('status', 2)->count();

        // Get employee IDs for the department '0'
        $allEmployeeIds = employees::where('department', '0')->pluck('id');

        // Get employees with add work records
        $employeesWithAddWorkRecords = addworkesEmployee::pluck('employee_id')->unique();

        // Determine employees without add work records
        $employeesWithoutAddWorkRecords = $allEmployeeIds->diff($employeesWithAddWorkRecords);
        $employeesWithoutAddWorkRecordsDetails = employees::whereIn('id', $employeesWithoutAddWorkRecords)->get();
        $employeesWithoutAddWorkRecordsDetailsCount = $employeesWithoutAddWorkRecordsDetails->count();

        // Fetch the user's modules from the session
        $modules = Session::get('user_modules_' . auth()->id());

        // Fetch distinct time entries with status=1
        $employeeIdsWithAddWork = addworkesEmployee::pluck('employee_id')->unique();
        $timeEntries = TimeEntry::whereIn('employee_id', $employeeIdsWithAddWork)
            ->where('status', 1)
            ->with(['employee', 'project'])
            ->get();

        $employeeData = [];
        $currentDate = Carbon::now();
        $currentWeekStart = $currentDate->copy()->startOfWeek();

        foreach ($timeEntries as $timeEntry) {
            $employeeId = $timeEntry->employee->id;
            $employeeName = $timeEntry->employee->name;
            $projectName = $timeEntry->project->projectname;
            $relevantEmployeeAllocation = $timeEntry->addworkesEmployees->first();

            if ($relevantEmployeeAllocation) {
                $employeeAllocationStartDate = Carbon::parse($relevantEmployeeAllocation->startdate);
                $employeeAllocationEndDate = Carbon::parse($relevantEmployeeAllocation->enddate);

                $mondaysDates = [];
                $currentDate = $employeeAllocationStartDate->copy()->startOfWeek();

                while ($currentDate <= $employeeAllocationEndDate) {
                    if ($currentDate->dayOfWeek === Carbon::MONDAY) {
                        $mondaysDates[] = $currentDate->toDateString();
                    }
                    $currentDate->addWeek();
                }

                // Filter out dates that are not before the current week
                $mondaysDates = array_filter($mondaysDates, fn($date) => strtotime($date) < strtotime($currentWeekStart));
                $mondaysDates = array_unique($mondaysDates);

                // Get dates with submitted timesheets
                $submittedTimesheets = TimeEntry::whereIn('date', $mondaysDates)
                    ->where('employee_id', $employeeId)
                    ->where('status', 1)
                    ->pluck('date')
                    ->toArray();

                $submittedTimesheets = array_unique($submittedTimesheets);
                $pendingTimesheetDates = array_diff($mondaysDates, $submittedTimesheets);
                $pendingTimesheetDatesBeforeCurrent = array_filter($pendingTimesheetDates, fn($date) => strtotime($date) < strtotime(date('Y-m-d')));

                // Check if the employee and project combination already exists
                $key = $employeeName . '|' . $projectName;

                if (!array_key_exists($key, $employeeData) && !empty($pendingTimesheetDatesBeforeCurrent)) {
                    $employeeData[$key] = [
                        'employee_name' => $employeeName,
                        'project_name' => $projectName,
                        'pending_dates' => $pendingTimesheetDatesBeforeCurrent,
                    ];
                }
            }
        }
        $employeeIds = addworkesEmployee::select('employee_Id')
            ->distinct()
            ->get()
            ->pluck('employee_Id');

        $allBeachDetails = [];

        foreach ($employeeIds as $employeeId) {
            $allocations = addworkesEmployee::where('employee_Id', $employeeId)
                ->orderBy('startdate')
                ->get();

            $beachDetails = [];

            // Create an array to keep track of all dates with allocations
            $dateAllocations = [];

            // Loop through allocations and record dates and allocations
            foreach ($allocations as $allocation) {
                $startDate = Carbon::parse($allocation->startdate);
                $endDate = Carbon::parse($allocation->enddate);
                $percentage = $allocation->allocationpercentage;

                // Loop through each date in the range and record allocations
                for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                    $dateKey = $date->toDateString();
                    if (!isset($dateAllocations[$dateKey])) {
                        $dateAllocations[$dateKey] = 0;
                    }
                    $dateAllocations[$dateKey] += $percentage;
                }
            }

            // Fetch employee name
            $employeeName = employees::where('id', $employeeId)->value('name');

            // Calculate beach dates and percentages
            foreach ($dateAllocations as $date => $totalAllocation) {
                if ($totalAllocation < 100) {
                    $beachPercentage = 100 - $totalAllocation;
                    $beachDetails[] = [
                        'employee_id' => $employeeId,
                        'employee_name' => $employeeName,
                        'date' => $date,
                        'beach_percentage' => $beachPercentage,
                    ];
                }
            }

            // Sort beachDetails by date
            usort($beachDetails, function ($a, $b) {
                return strcmp($a['date'], $b['date']);
            });

            // Add beach details for this employee to the overall list
            // $allBeachDetails = array_merge($allBeachDetails, $beachDetails);
            // $allBeachDetailsCount = $allBeachDetails->count();
            $allBeachDetails = collect($allBeachDetails)->merge($beachDetails);
            $allBeachDetailsCount = $allBeachDetails->count();
        }
        // dd($allBeachDetailsCount);
        $employeeDataCollection = collect(array_values($employeeData));
        $totalEntries = $employeeDataCollection->count();
        // dd($allBeachDetails);
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();

        // $currentMonthAllocationExpire = addworkesEmployee::with('project')
        //     ->whereHas('project', function ($query) use ($currentMonthStart, $currentMonthEnd) {
        //         $query->whereBetween('enddate', [$currentMonthStart, $currentMonthEnd]);
        //     })
        //     ->get();
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();

        // Fetch employees whose projects expire in the current month
        $expiringEmployees = addworkesEmployee::with('project')
            ->where('is_deleted', 0)
            ->whereHas('project', function ($query) use ($currentMonthStart, $currentMonthEnd) {
                $query->whereBetween('enddate', [$currentMonthStart, $currentMonthEnd]);
            })
            ->get();
        $expiringCount = $expiringEmployees->count();

        // Optional: Prepare the data for view or debugging
        // $expiringEmployeeData = $expiringEmployees->map(function ($employee) {
        //     return [
        //         'employee_id' => $employee->employee_Id,
        //         'employee_name' => $employee->employee->name, // Assuming there's a relationship
        //         'project_id' => $employee->project->id,       // Adjust if necessary
        //         'project_name' => $employee->project->projectname,
        //         'start_date' => $employee->startdate,
        //         'end_date' => $employee->enddate,
        //         'allocationpercentage' =>$employee->allocationpercentage,   // End date of the project
        //             // End date of the project
        //     ];
        // });

        // Convert to an array (if needed)

        // Debug output
        // dd($employeeProjectArray);

        // Debug output
        // echo ('<pre>');
        // print_r($expiringCount);
        // echo ('</pre>');
        // die();
        // dd($currentMonthAllocationExpire);

        return view('dashboard', [
            'modules' => $modules,
            'approvedCount' => $approvedCount,
            'pendingCount' => $pendingCount,
            'rejectedCount' => $rejectedCount,
            'employeesWithoutAddWorkRecordsDetailsCount' => $employeesWithoutAddWorkRecordsDetailsCount,
            'totalEntries' => $totalEntries,
            'allBeachDetailsCount' => $allBeachDetailsCount,
            'expiringCount' => $expiringCount,

        ]);
    }



    public function approvedData()
    {
        $modules = Session::get('user_modules_' . auth()->id());

        // Fetch approved time entries
        $approvedData = TimeEntry::where('status', 1)->get();
        $employeeIds = $approvedData->pluck('employee_id');

        $timeEntriesQuery = TimeEntry::whereIn('employee_id', $employeeIds)
            ->where('status', 1)
            ->with(['employee', 'project'])
            ->orderBy('date', 'desc'); // Order by date in descending order


        // Paginate the results with 15 items per page
        $timeEntries = $timeEntriesQuery->paginate(15);

        // Transform the paginated results
        $data = $timeEntries->map(function ($timeEntry) {
            return [
                'employeeName' => $timeEntry['employee']['name'],
                'weeksDate' => $timeEntry['date'],
                'projectName' => $timeEntry['project']['projectname'],
                'projectPm' => $timeEntry['project']['pmallocation'],
            ];
        });

        return view('dashboardApprovedData', [
            'modules' => $modules,
            'approvedData' => $data,
            'timeEntries' => $timeEntries, // Pass the paginated results to the view
        ]);
    }



    public function pendingData()
    {
        $modules = Session::get('user_modules_' . auth()->id());

        $pendingData = TimeEntry::where('status', 0)->pluck('employee_id')->toArray();

        $timeEntriesQuery = TimeEntry::whereIn('employee_id', $pendingData)
            ->where('status', 0)
            ->with(['employee', 'project'])
            ->orderBy('date', 'desc');

        $timeEntries = $timeEntriesQuery->paginate(15);

        $data = $timeEntries->map(function ($timeEntry) {
            return [
                'employeeName' => $timeEntry->employee->name,
                'weeksDate' => $timeEntry->date,
                'projectName' => $timeEntry->project->projectname,
            ];
        });

        return view('dashboardPendingData', [
            'modules' => $modules,
            'approvedData' => $data,
            'timeEntries' => $timeEntries, // Pass the paginated results to the view
        ]);
    }


    public function rejectedData()
    {
        $modules = Session::get('user_modules_' . auth()->id());
        $rejectedData = TimeEntry::where('status', 2)->get();
        $employeeIds = $rejectedData->pluck('employee_id');
        $timeEntries = collect();

        if (!$employeeIds->isEmpty()) {
            $timeEntries = TimeEntry::whereIn('employee_id', $employeeIds)
                ->where('status', 2)
                ->with(['employee', 'project'])
                ->orderBy('date', 'desc')
                ->paginate(10);
        }

        $data = $timeEntries->map(function ($timeEntry) {
            return [
                'employeeName' => $timeEntry->employee->name,
                'weeksDate' => $timeEntry->date,
                'projectName' => $timeEntry->project->projectname,
            ];
        });

        return view('dashboardrejectedData', [
            'modules' => $modules,
            'approvedData' => $data,
            'timeEntries' => $timeEntries, // Pass paginated result
        ]);
    }
    public function nonAllocationUser()
    {
        $modules = Session::get('user_modules_' . auth()->id());
        // $allEmployeeIds = employees::where('department', '0')->whereIn('employeestatus',1)->pluck('id');
        $allEmployeeIds = employees::where('department', 0)
            ->where('employeestatus', 0)
            ->pluck('id');

        $employeesWithAddWorkRecords = addworkesEmployee::pluck('employee_id')->unique();
        // dd($employeesWithAddWorkRecords);
        $employeesWithoutAddWorkRecords = $allEmployeeIds->diff($employeesWithAddWorkRecords);
        $employeesWithoutAddWorkRecordsDetails = employees::whereIn('id', $employeesWithoutAddWorkRecords)->paginate(15);
        $employeesWithoutAddWorkRecordsCount = $employeesWithoutAddWorkRecordsDetails->count();
        $employeeNames = $employeesWithoutAddWorkRecordsDetails->pluck('name');
        // dd($employeeNames);
        return view('non_allocation_user',  [
            'modules' => $modules,
            'data' => $employeeNames,
            'user' => $employeesWithoutAddWorkRecordsDetails,
        ]);
    }




    // public function fetchData(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'start_date' => 'required|date',
    //         'end_date' => 'required|date|after_or_equal:start_date',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()->all()], 400);
    //     }

    //     // Retrieve input dates
    //     $start_date = $request->input('start_date');
    //     $end_date = $request->input('end_date');

    //     $entries = TimeEntry::whereBetween('date', [$start_date, $end_date])
    //         ->whereIn('status', [0, 1, 2]) // Adjust status filters as needed
    //         ->get();

    //     $approvedCount = $entries->where('status', 1)->count();
    //     $rejectedCount = $entries->where('status', 2)->count();
    //     $pendingCount = $entries->where('status', 0)->count();

    //     #non allocation user
    //     $allEmployeeIds = employees::where('department', '0')->pluck('id');
    //     $employeesWithAddWorkRecords = addworkesEmployee::pluck('employee_id')->unique();
    //     // dd($employeesWithAddWorkRecords);
    //     $employeesWithoutAddWorkRecords = $allEmployeeIds->diff($employeesWithAddWorkRecords);
    //     $employeesWithoutAddWorkRecordsDetails = employees::whereIn('id', $employeesWithoutAddWorkRecords)->paginate(15);
    //     $employeesWithoutAddWorkRecordsCount = $employeesWithoutAddWorkRecordsDetails->count();
    //     $employeeNames = $employeesWithoutAddWorkRecordsDetails->pluck('name');


    //     return response()->json([
    //         'approvedCount' => $approvedCount,
    //         'pendingCount' => $pendingCount,
    //         'rejectedCount' => $rejectedCount,
    //     ]);
    // }
    //     public function fetchData(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'start_date' => 'required|date',
    //         'end_date' => 'required|date|after_or_equal:start_date',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()->all()], 400);
    //     }

    //     // Retrieve input dates
    //     $start_date = $request->input('start_date');
    //     $end_date = $request->input('end_date');

    //     // Retrieve time entries and count statuses
    //     $entries = TimeEntry::whereBetween('date', [$start_date, $end_date])
    //         ->whereIn('status', [0, 1, 2]) // Adjust status filters as needed
    //         ->get();

    //     $approvedCount = $entries->where('status', 1)->count();
    //     $rejectedCount = $entries->where('status', 2)->count();
    //     $pendingCount = $entries->where('status', 0)->count();

    //     // Find employees who are not allocated during the period
    //     $allEmployeeIds = employees::where('department', '0')->pluck('id');


    // $employeesWithAddWorkRecords = addworkesEmployee::where(function ($query) use ($start_date, $end_date) {
    //     $query->whereBetween('startdate', [$start_date, $end_date])
    //           ->orWhereBetween('enddate', [$start_date, $end_date])
    //           ->orWhere(function ($query) use ($start_date, $end_date) {
    //               $query->where('startdate', '<=', $start_date)
    //                     ->where('enddate', '>=', $end_date);
    //           });
    // })
    // ->pluck('employee_id')
    // ->unique();


    // // dd($employeesWithAddWorkRecords);
    //     // Get employees who do not have add work records in the specified date range
    //     $employeesWithoutAddWorkRecords = $allEmployeeIds->diff($employeesWithAddWorkRecords);

    //     $employeesWithoutAddWorkRecordsDetails = employees::whereIn('id', $employeesWithoutAddWorkRecords)
    //         // ->select('id', 'name', 'start_date', 'end_date') // Include other fields as needed
    //         ->paginate(15);
    // // dd($employeesWithoutAddWorkRecordsDetails);
    //     $employeesWithoutAddWorkRecordsCount = $employeesWithoutAddWorkRecordsDetails->total(); // Use total() for paginated results

    //     // Get names of employees without add work records
    //     $employeeNames = $employeesWithoutAddWorkRecordsDetails->pluck('name');
    // // dd($employeesWithoutAddWorkRecordsCount);
    //     return response()->json([
    //         'approvedCount' => $approvedCount,
    //         'pendingCount' => $pendingCount,
    //         'rejectedCount' => $rejectedCount,
    //         'employeesWithoutAddWorkRecordsCount' => $employeesWithoutAddWorkRecordsCount,
    //         'employeeNames' => $employeeNames,
    //         'employeesWithoutAddWorkRecordsDetails' => $employeesWithoutAddWorkRecordsDetails->items(), // Include paginated results in response
    //     ]);
    // }
    // public function fetchData(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'start_date' => 'required|date',
    //         'end_date' => 'required|date|after_or_equal:start_date',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()->all()], 400);
    //     }

    //     $start_date = $request->input('start_date');
    //     $end_date = $request->input('end_date');

    //     // Fetch time entries
    //     $entries = TimeEntry::whereBetween('date', [$start_date, $end_date])
    //         ->whereIn('status', [0, 1, 2])
    //         ->get();

    //     $approvedCount = $entries->where('status', 1)->count();
    //     $rejectedCount = $entries->where('status', 2)->count();
    //     $pendingCount = $entries->where('status', 0)->count();

    //     // Find employees without add work records
    //     $allEmployeeIds = employees::where('department', '0')->pluck('id');

    //     $employeesWithAddWorkRecords = addworkesEmployee::where(function ($query) use ($start_date, $end_date) {
    //         $query->whereBetween('startdate', [$start_date, $end_date])
    //               ->orWhereBetween('enddate', [$start_date, $end_date])
    //               ->orWhere(function ($query) use ($start_date, $end_date) {
    //                   $query->where('startdate', '<=', $start_date)
    //                         ->where('enddate', '>=', $end_date);
    //               });
    //     })
    //     ->pluck('employee_id')
    //     ->unique();

    //     $employeesWithoutAddWorkRecords = $allEmployeeIds->diff($employeesWithAddWorkRecords);

    //     $employeesWithoutAddWorkRecordsDetails = employees::whereIn('id', $employeesWithoutAddWorkRecords)
    //         ->paginate(15);

    //     return response()->json([
    //         'approvedCount' => $approvedCount,
    //         'pendingCount' => $pendingCount,
    //         'rejectedCount' => $rejectedCount,
    //         'employeesWithoutAddWorkRecordsCount' => $employeesWithoutAddWorkRecordsDetails->total(),
    //         'employeeNames' => $employeesWithoutAddWorkRecordsDetails->pluck('name'),
    //         'employeesWithoutAddWorkRecordsDetails' => $employeesWithoutAddWorkRecordsDetails->items(),
    //     ]);
    // }
    public function fetchData(Request $request)
    {
        // dd($request->all());
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if ($start_date && $end_date) {
            // Validate the date range
            $validator = Validator::make($request->all(), [
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->all()], 400);
            }

            $entries = TimeEntry::whereBetween('date', [$start_date, $end_date])
                ->whereIn('status', [0, 1, 2])
                ->get();
        } else {
            // Default behavior: Fetch all data
            $entries = TimeEntry::whereIn('status', [0, 1, 2])->get();
        }

        $approvedCount = $entries->where('status', 1)->count();
        $rejectedCount = $entries->where('status', 2)->count();
        $pendingCount = $entries->where('status', 0)->count();

        // Find employees who are not allocated during the period
        $allEmployeeIds = employees::where('department', '0')->pluck('id');

        $employeesWithAddWorkRecords = addworkesEmployee::where(function ($query) use ($start_date, $end_date) {
            if ($start_date && $end_date) {
                $query->whereBetween('startdate', [$start_date, $end_date])
                    ->orWhereBetween('enddate', [$start_date, $end_date])
                    ->orWhere(function ($query) use ($start_date, $end_date) {
                        $query->where('startdate', '<=', $start_date)
                            ->where('enddate', '>=', $end_date);
                    });
            }
        })
            ->pluck('employee_id')
            ->unique();

        $employeesWithoutAddWorkRecords = $allEmployeeIds->diff($employeesWithAddWorkRecords);

        $employeesWithoutAddWorkRecordsDetails = employees::whereIn('id', $employeesWithoutAddWorkRecords)
            ->paginate(15);

        return response()->json([
            'approvedCount' => $approvedCount,
            'pendingCount' => $pendingCount,
            'rejectedCount' => $rejectedCount,
            'employeesWithoutAddWorkRecordsCount' => $employeesWithoutAddWorkRecordsDetails->total(),
            'employeeNames' => $employeesWithoutAddWorkRecordsDetails->pluck('name'),
            'employeesWithoutAddWorkRecordsDetails' => $employeesWithoutAddWorkRecordsDetails->items(),
        ]);
    }




    public function notSubmitedData()
    {
        $modules = Session::get('user_modules_' . auth()->id());
        $employeeIds = addworkesEmployee::pluck('employee_id')->unique();

        $timeEntries = TimeEntry::whereIn('employee_id', $employeeIds)
            ->where('status', 1)
            ->with(['employee', 'project', 'addworkesEmployees'])
            ->distinct()
            ->get();

        $employeeData = [];
        $currentDate = Carbon::now(); // Today's date
        $currentWeekStart = $currentDate->copy()->startOfWeek(); // Monday of the current week
        $currentWeekEnd = $currentDate->copy()->endOfWeek(); // Sunday of the current week

        foreach ($timeEntries as $timeEntry) {
            $employeeId = $timeEntry->employee->id;
            $employeeName = $timeEntry->employee->name;
            $projectName = $timeEntry->project->projectname;
            $relevantEmployeeAllocation = $timeEntry->addworkesEmployeesByEmployee->first();


            if ($relevantEmployeeAllocation) {
                $employeeAllocationStartDate = Carbon::parse($relevantEmployeeAllocation->startdate);
                $employeeAllocationEndDate = Carbon::parse($relevantEmployeeAllocation->enddate);

                $mondaysDates = [];
                $currentDate = $employeeAllocationStartDate->copy()->startOfWeek(); // Start from the first Monday in the allocation period

                while ($currentDate <= $employeeAllocationEndDate) {
                    if ($currentDate->dayOfWeek === Carbon::MONDAY) {
                        // Avoid adding duplicate Mondays
                        if (!in_array($currentDate->toDateString(), $mondaysDates)) {
                            $mondaysDates[] = $currentDate->toDateString();
                        }
                    }
                    $currentDate->addWeek();
                }

                // Filter out the current week
                $mondaysDates = array_filter($mondaysDates, function ($date) use ($currentWeekStart) {
                    return strtotime($date) < strtotime($currentWeekStart);
                });

                // Ensure mondaysDates has unique dates
                $mondaysDates = array_unique($mondaysDates);


                // Get the dates for which timesheets are submitted
                $submittedTimesheets = TimeEntry::whereIn('date', $mondaysDates)
                    ->where('employee_id', $employeeId)
                    ->where('status', 1)
                    ->pluck('date')
                    ->toArray();

                // Ensure submittedTimesheets has unique dates
                $submittedTimesheets = array_unique($submittedTimesheets);

                // Determine pending dates
                $pendingTimesheetDates = array_diff($mondaysDates, $submittedTimesheets);
                $pendingTimesheetDatesBeforeCurrent = [];

                foreach ($pendingTimesheetDates as $date) {
                    if (strtotime($date) < strtotime(date('Y-m-d'))) {
                        $pendingTimesheetDatesBeforeCurrent[] = $date;
                    }
                }

                // Check if the employee and project combination already exists
                $key = $employeeName . '|' . $projectName;

                if (!array_key_exists($key, $employeeData) && !empty($pendingTimesheetDatesBeforeCurrent)) {
                    $employeeData[$key] = [
                        'employee_name' => $employeeName,
                        'project_name' => $projectName,
                        'pending_dates' => $pendingTimesheetDatesBeforeCurrent,
                    ];
                }
            }
        }

        $employeeDataCollection = collect(array_values($employeeData)); // Use array_values to reindex

        return view('weekssubmissionReminder', [
            'modules' => $modules,
            'data' => $employeeDataCollection, // Pass data to the view
        ]);
    }
    // public function beachLog(){
    //     $allEmployeeDetails = addworkesEmployee::pluck('allocationpercentage');
    //     dd($allEmployeeDetails);
    // }
    // public function getBeachDetailsForAllEmployees()
    // {
    //     // Fetch all employees
    //     $employees = addworkesEmployee::select('employee_Id')
    //                                   ->distinct()
    //                                   ->get()
    //                                   ->pluck('employee_Id');

    //     $allBeachDetails = [];

    //     foreach ($employees as $employeeId) {
    //         // Fetch all project allocations for the given employee
    //         $allocations = addworkesEmployee::where('employee_Id', $employeeId)
    //                                           ->orderBy('startdate')
    //                                           ->get();

    //         $beachDetails = [];

    //         // Create an array to keep track of all dates with allocations
    //         $dateAllocations = [];

    //         // Loop through allocations and record dates and allocations
    //         foreach ($allocations as $allocation) {
    //             $startDate = Carbon::parse($allocation->startdate);
    //             $endDate = Carbon::parse($allocation->enddate);
    //             $percentage = $allocation->allocationpercentage;

    //             // Loop through each date in the range and record allocations
    //             for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
    //                 $dateKey = $date->toDateString();
    //                 if (!isset($dateAllocations[$dateKey])) {
    //                     $dateAllocations[$dateKey] = 0;
    //                 }
    //                 $dateAllocations[$dateKey] += $percentage;
    //             }
    //         }

    //         // Calculate beach dates and percentages
    //         foreach ($dateAllocations as $date => $totalAllocation) {
    //             if ($totalAllocation < 100) {
    //                 $beachPercentage = 100 - $totalAllocation;
    //                 $beachDetails[] = [
    //                     'employee_id' => $employeeId,
    //                     'date' => $date,
    //                     'beach_percentage' => $beachPercentage
    //                 ];
    //             }
    //         }

    //         // Sort beachDetails by date
    //         usort($beachDetails, function($a, $b) {
    //             return strcmp($a['date'], $b['date']);
    //         });

    //         // Add beach details for this employee to the overall list
    //         $allBeachDetails = array_merge($allBeachDetails, $beachDetails);
    //     }

    //     // Print the details for debugging
    //     echo('<pre>');
    //     print_r($allBeachDetails);
    //     echo('</pre>');
    //     die();

    //     // Display the list of beach dates and percentages
    //     return view('beach-details', ['beachDetails' => $allBeachDetails]);
    // }
    //     public function getBeachDetailsForAllEmployees()
    // {
    //     // Fetch all employees
    //     $employees = addworkesEmployee::select('employee_Id')
    //                                   ->distinct()
    //                                   ->get()
    //                                   ->pluck('employee_Id');

    //     $allBeachDetails = [];

    //     foreach ($employees as $employeeId) {
    //         // Fetch all project allocations for the given employee
    //         $allocations = addworkesEmployee::where('employee_Id', $employeeId)
    //                                           ->orderBy('startdate')
    //                                           ->get();

    //         $beachDetails = [];

    //         // Create an array to keep track of all dates with allocations
    //         $dateAllocations = [];

    //         // Loop through allocations and record dates and allocations
    //         foreach ($allocations as $allocation) {
    //             $startDate = Carbon::parse($allocation->startdate);
    //             $endDate = Carbon::parse($allocation->enddate);
    //             $percentage = $allocation->allocationpercentage;

    //             // Loop through each date in the range and record allocations
    //             for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
    //                 $dateKey = $date->toDateString();
    //                 if (!isset($dateAllocations[$dateKey])) {
    //                     $dateAllocations[$dateKey] = 0;
    //                 }
    //                 $dateAllocations[$dateKey] += $percentage;
    //             }
    //         }

    //         // Calculate beach dates and percentages
    //         foreach ($dateAllocations as $date => $totalAllocation) {
    //             if ($totalAllocation < 100) {
    //                 $beachPercentage = 100 - $totalAllocation;
    //                 $beachDetails[] = [
    //                     'employee_id' => $employeeId,
    //                     'date' => $date,
    //                     'beach_percentage' => $beachPercentage,
    //                     // 'project_id' => $allocations->firstWhere('startdate', '<=', $date)->project_id ?? null
    //                 ];
    //             }
    //         }

    //         // Sort beachDetails by date
    //         usort($beachDetails, function($a, $b) {
    //             return strcmp($a['date'], $b['date']);
    //         });

    //         // Add beach details for this employee to the overall list
    //         $allBeachDetails = array_merge($allBeachDetails, $beachDetails);
    //     }

    //     // Print the details for debugging
    //     echo('<pre>');
    //     print_r($allBeachDetails);
    //     echo('</pre>');
    //     die();

    //     // Display the list of beach dates and percentages
    //     return view('beach-details', ['beachDetails' => $allBeachDetails]);
    // }
    // public function expiringData()
    // {
    //     // dd('here');
    //     $currentMonthStart = Carbon::now()->startOfMonth();
    //     $currentMonthEnd = Carbon::now()->endOfMonth();

       

    //     // Fetch employees whose projects expire in the current month
    //     $expiringEmployees = addworkesEmployee::with('project')
    //         ->where('is_deleted', 0)
    //         ->whereHas('project', function ($query) use ($currentMonthStart, $currentMonthEnd) {
    //             $query->whereBetween('enddate', [$currentMonthStart, $currentMonthEnd]);
    //         })
    //         ->get();

    //         $PmemployeeName = $expiringEmployees->map(function ($employee) {
    //             'pmIds'=>$employee->project->pmemployeeId,
             
    //         });
    //         dd($PmemployeeName);
            
    //         $expiringEmployeeData = $expiringEmployees->map(function ($employee) {
    //         return [
    //             'employee_id' => $employee->employee_Id,
    //             'employee_name' => $employee->employee->name, 
    //             'project_id' => $employee->project->id,       
    //             'pmIds'=>$employee->project->pmemployeeId,
    //             'project_name' => $employee->project->projectname,
    //             'start_date' => $employee->startdate,
    //             'end_date' => $employee->enddate,
    //             'allocationpercentage' => $employee->allocationpercentage,   // End date of the project
    //             // End date of the project
    //         ];
    //     });
    //     echo ('<pre>');
    //     print_r($expiringEmployeeData);
    //     echo ('</pre>');
    //     die();
    // }
    public function expiringData()
{
        $modules = Session::get('user_modules_' . auth()->id());

    $currentMonthStart = Carbon::now()->startOfMonth();
    $currentMonthEnd = Carbon::now()->endOfMonth();

    // Fetch employees whose projects expire in the current month
    $expiringEmployees = addworkesEmployee::with('project')
        ->where('is_deleted', 0)
        ->whereHas('project', function ($query) use ($currentMonthStart, $currentMonthEnd) {
            $query->whereBetween('enddate', [$currentMonthStart, $currentMonthEnd]);
        })
        ->paginate(15);

    // Retrieve project manager names
    $expiringEmployeeData = $expiringEmployees->map(function ($employee) {
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

    // Debug output
    // echo ('<pre>');
    // print_r($expiringEmployeeData);
    // echo ('</pre>');
    // die();
    return view('expiringAllocationEmployeeData',compact('expiringEmployeeData','modules','expiringEmployees'));
}

}
