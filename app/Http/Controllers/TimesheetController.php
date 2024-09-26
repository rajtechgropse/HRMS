<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
<<<<<<< HEAD
=======
// use App\Models\AddworkesEmployee;
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
use App\Models\TimeEntry;
use App\Models\TimeEntriesTemp;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use App\Models\addworkesEmployee;
use App\Models\employees;
use App\Models\AddProjects;
use App\Models\ReopenTimesheet;








use Illuminate\Support\Facades\Session;

class TimesheetController extends Controller
{
<<<<<<< HEAD

    // public function Timesheet()
    // {
    //     $userLoginDetails = Auth::user()->employee_Id;

    //     $assignedProjects = addworkesEmployee::where('employee_Id', $userLoginDetails)
    //         ->with('project')
    //         ->get();
    //     $permissionTimesheet = Auth::user()->time_managers_status;
    //     // $user = Auth::user()->employee_Id;

    //     // Check if the user is either an admin or a project manager
    //     $reopenTimesheetDates = TimeEntry::where('employee_id', $userLoginDetails)
    //         ->whereIn('status', [3])
    //         ->where(function ($query) {
    //             $query->where('is_admin', 1)
    //                 ->orWhere('is_ProjectManagers', 1);
    //         })
    //         ->pluck('date');

    //     dd($reopenTimesheetDates);

    //     if ($assignedProjects->isEmpty()) {
    //         return view('users.time_Sheet', compact('assignedProjects', 'permissionTimesheet', 'reopenTimesheetDates'));
=======
    // public function Timesheet()
    // {
    //     $userLoginDetails = Auth::user()->employee_Id;
    //     $assignedProjects = addworkesEmployee::where('employee_Id', $userLoginDetails)
    //         ->with('project')
    //         ->get();

    //     if ($assignedProjects->isEmpty()) {
    //         return view('users.time_Sheet', compact('assignedProjects'));
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
    //     }

    //     $projectStartDates = $assignedProjects->pluck('startdate')->toArray();
    //     $projectEndDates = $assignedProjects->pluck('enddate')->toArray();

    //     $minDate = min($projectStartDates);
    //     $maxDate = max($projectEndDates);
<<<<<<< HEAD


=======
    //     $permissionTimeshhet = Auth::user()->time_managers_status;
    //     // dd($permissionTimeshhet);

    //     return view('users.time_Sheet', compact('minDate', 'maxDate', 'assignedProjects','permissionTimesheet'));
    // }

    // public function Timesheet()
    // {
    //     // Get the logged-in user's employee ID
    //     $userLoginDetails = Auth::user()->employee_Id;

    //     // Retrieve projects assigned to the user with their details
    //     $assignedProjects = addworkesEmployee::where('employee_Id', $userLoginDetails)
    //         ->with('project')
    //         ->get();
    //     $permissionTimesheet = Auth::user()->time_managers_status;

    //     // Check if the user has any assigned projects
    //     if ($assignedProjects->isEmpty()) {
    //         // If no projects are assigned, return the view with default values
    //         return view('users.time_Sheet', compact('assignedProjects', 'permissionTimesheet'));
    //     }

    //     // Get the start and end dates for all assigned projects
    //     $projectStartDates = $assignedProjects->pluck('startdate')->toArray();
    //     $projectEndDates = $assignedProjects->pluck('enddate')->toArray();

    //     // Determine the minimum and maximum dates from the projects
    //     $minDate = min($projectStartDates);
    //     $maxDate = max($projectEndDates);

    //     // Get the user's time management permission status

    //     // Pass all relevant data to the view
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
    //     return view('users.time_Sheet', compact('minDate', 'maxDate', 'assignedProjects', 'permissionTimesheet'));
    // }
    public function Timesheet()
    {
        $userLoginDetails = Auth::user()->employee_Id;
    
<<<<<<< HEAD
        $assignedProjects = addworkesEmployee::where('employee_Id', $userLoginDetails)
            ->where('is_deleted', 0)
=======
        $assignedProjects = addworkesEmployee::where('employee_Id', $userLoginDetails)->where('is_deleted',0)
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
            ->with('project')
            ->get();
            
        $permissionTimesheet = Auth::user()->time_managers_status;
    
        // Get the reopen timesheet dates
        $reopenTimesheetDates = TimeEntry::where('employee_id', $userLoginDetails)
            ->whereIn('status', [2])
            ->where(function ($query) {
                $query->where('is_admin', 1)
                    ->orWhere('is_ProjectManagers', 1);
            })
            ->pluck('date')
            ->map(function ($date) {
                return \Carbon\Carbon::parse($date)->toDateString();
            });
    
        // Check if assignedProjects is empty and return view with the necessary variables
        if ($assignedProjects->isEmpty()) {
            return view('users.time_Sheet', compact('assignedProjects', 'permissionTimesheet', 'reopenTimesheetDates'));
        }
        // dd($reopenTimesheetDates);

        if (!$reopenTimesheetDates->isEmpty()){
            // dd($reopenTimesheetDates);
            return view('users.time_Sheet', compact('assignedProjects', 'permissionTimesheet', 'reopenTimesheetDates'));


        }
    
        $projectStartDates = $assignedProjects->pluck('startdate')->toArray();
        $projectEndDates = $assignedProjects->pluck('enddate')->toArray();
    
        $minDate = min($projectStartDates);
        $maxDate = max($projectEndDates);
    
<<<<<<< HEAD
=======

>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
        return view('users.time_Sheet', compact('minDate', 'maxDate', 'assignedProjects', 'permissionTimesheet', 'reopenTimesheetDates'));
    }
    
    // public function Timesheet()
    // {
    //     $userLoginDetails = Auth::user()->employee_Id;
        
    //     // Fetch assigned projects
    //     $assignedProjects = addworkesEmployee::where('employee_Id', $userLoginDetails)
    //         ->with('project')
    //         ->get();
            
    //     // Get permission status
    //     $permissionTimesheet = Auth::user()->time_managers_status;
        
    //     // Get the reopen timesheet dates
    //     $reopenTimesheetDates = TimeEntry::where('employee_id', $userLoginDetails)
    //         ->whereIn('status', [3])
    //         ->where(function ($query) {
    //             $query->where('is_admin', 1)
    //                 ->orWhere('is_ProjectManagers', 1);
    //         })
    //         ->pluck('date')
    //         ->map(function ($date) {
    //             return \Carbon\Carbon::parse($date)->toDateString();
    //         })
    //         ->toArray(); // Convert to array to pass to view
        
    //     // Check if assignedProjects is empty and return view with the necessary variables
    //     if ($assignedProjects->isEmpty()) {
    //         return view('users.time_Sheet', compact('assignedProjects', 'permissionTimesheet', 'reopenTimesheetDates'));
    //     }
    
    //     // If reopen timesheet dates are available, return the view with these dates
    //     if (!empty($reopenTimesheetDates)) {
    //         return view('users.time_Sheet', compact('assignedProjects', 'permissionTimesheet', 'reopenTimesheetDates'));
    //     }
    
    //     // Calculate project date ranges
    //     $projectStartDates = $assignedProjects->pluck('startdate')->toArray();
    //     $projectEndDates = $assignedProjects->pluck('enddate')->toArray();
        
    //     $minDate = min($projectStartDates);
    //     $maxDate = max($projectEndDates);
        
    //     return view('users.time_Sheet', compact('minDate', 'maxDate', 'assignedProjects', 'permissionTimesheet', 'reopenTimesheetDates'));
    // }
    





    // public function enterDateInProject(Request $request)
    // {
    //     $userLoginDetails = Auth::user()->employee_Id;
    //     $selectedDate = $request->input('week_start_date');

    //     $existingEntry = TimeEntry::where('employee_id', $userLoginDetails)
    //         ->where('date', $selectedDate)
    //         ->where('status', 1)
    //         ->get();

    //     if ($existingEntry->isNotEmpty()) {
    //         $projects = $this->getProjects();
    //         $datesAndDays = $this->setupDatesAndDays($selectedDate);
    //         $weekDates = Session::get('week_dates');
    //         return view('users.submite_Data_View', compact('projects', 'datesAndDays', 'weekDates', 'existingEntry'));
    //     } else {
    //         $timeEntries = TimeEntriesTemp::where('date', $selectedDate)
    //             ->where('employee_id', $userLoginDetails)
    //             ->get()->toArray();

    //         $assignedProjects = AddworkesEmployee::where('employee_Id', $userLoginDetails)
    //             ->with('project')
    //             ->get();

    //         $projects = $this->getProjects();
    //         $datesAndDays = $this->setupDatesAndDays($selectedDate);
    //         $weekDates = Session::get('week_dates');
    //         $totalTime = [
    //             'monday_hours' => 0,
    //             'tuesday_hours' => 0,
    //             'wednesday_hours' => 0,
    //             'thursday_hours' => 0,
    //             'friday_hours' => 0,
    //             'saturday_hours' => 0,
    //             'sunday_hours' => 0
    //         ];

    //         for ($i = 0; $i < count($timeEntries); $i++) {
    //             $totalTime['monday_hours'] += $timeEntries[$i]['monday_hours'];
    //             $totalTime['tuesday_hours'] += $timeEntries[$i]['tuesday_hours'];
    //             $totalTime['wednesday_hours'] += $timeEntries[$i]['wednesday_hours'];
    //             $totalTime['thursday_hours'] += $timeEntries[$i]['thursday_hours'];
    //             $totalTime['friday_hours'] += $timeEntries[$i]['friday_hours'];
    //             $totalTime['saturday_hours'] += $timeEntries[$i]['saturday_hours'];
    //             $totalTime['sunday_hours'] += $timeEntries[$i]['sunday_hours'];
    //         }

    //         $totalTime = [
    //             'monday_hours' => number_format($totalTime['monday_hours'], 2),
    //             'tuesday_hours' => number_format($totalTime['tuesday_hours'], 2),
    //             'wednesday_hours' => number_format($totalTime['wednesday_hours'], 2),
    //             'thursday_hours' => number_format($totalTime['thursday_hours'], 2),
    //             'friday_hours' => number_format($totalTime['friday_hours'], 2),
    //             'saturday_hours' => number_format($totalTime['saturday_hours'], 2),
    //             'sunday_hours' => number_format($totalTime['sunday_hours'], 2)
    //         ];

    //         return view('users.enterTimetheProject', compact('projects', 'datesAndDays', 'weekDates', 'timeEntries', 'assignedProjects', 'totalTime'));
    //     }
    // }
    public function enterDateInProject(Request $request)
    {

        $userLoginDetails = Auth::user()->employee_Id;
        $selectedDate = $request->input('week_start_date');

        $query = TimeEntry::where('employee_id', $userLoginDetails)
            ->where('date', $selectedDate)
            ->whereIn('status', [1, 2]);

        \Log::info($query->toSql(), $query->getBindings());

        $existingEntry = $query->get();


        if ($existingEntry->isNotEmpty()) {
            $projects = $this->getProjects();
            $datesAndDays = $this->setupDatesAndDays($selectedDate);
            $weekDates = Session::get('week_dates');
            return view('users.submite_Data_View', compact('projects', 'datesAndDays', 'weekDates', 'existingEntry'));
        } else {
            $timeEntries = TimeEntriesTemp::where('date', $selectedDate)
                ->where('employee_id', $userLoginDetails)
                ->get()->toArray();

            $assignedProjects = AddworkesEmployee::where('employee_Id', $userLoginDetails)
                ->with('project')
                ->get();

            $projects = $this->getProjects();
            $datesAndDays = $this->setupDatesAndDays($selectedDate);
            $weekDates = Session::get('week_dates');
            $totalTime = [
                'monday_hours' => 0,
                'tuesday_hours' => 0,
                'wednesday_hours' => 0,
                'thursday_hours' => 0,
                'friday_hours' => 0,
                'saturday_hours' => 0,
                'sunday_hours' => 0
            ];

            for ($i = 0; $i < count($timeEntries); $i++) {
                $totalTime['monday_hours'] += $timeEntries[$i]['monday_hours'];
                $totalTime['tuesday_hours'] += $timeEntries[$i]['tuesday_hours'];
                $totalTime['wednesday_hours'] += $timeEntries[$i]['wednesday_hours'];
                $totalTime['thursday_hours'] += $timeEntries[$i]['thursday_hours'];
                $totalTime['friday_hours'] += $timeEntries[$i]['friday_hours'];
                $totalTime['saturday_hours'] += $timeEntries[$i]['saturday_hours'];
                $totalTime['sunday_hours'] += $timeEntries[$i]['sunday_hours'];
            }

            $totalTime = [
                'monday_hours' => number_format($totalTime['monday_hours'], 2),
                'tuesday_hours' => number_format($totalTime['tuesday_hours'], 2),
                'wednesday_hours' => number_format($totalTime['wednesday_hours'], 2),
                'thursday_hours' => number_format($totalTime['thursday_hours'], 2),
                'friday_hours' => number_format($totalTime['friday_hours'], 2),
                'saturday_hours' => number_format($totalTime['saturday_hours'], 2),
                'sunday_hours' => number_format($totalTime['sunday_hours'], 2)
            ];

            return view('users.enterTimetheProject', compact('projects', 'datesAndDays', 'weekDates', 'timeEntries', 'assignedProjects', 'totalTime'));
        }
    }
    public function enterTimeInProjectUpdateRejected(Request $request)
    {
        $projectIds = $request->input('selected_project_id');
        $selectedDate = $request->input('selected_date');
        $timeEntryIds = $request->input('selected_id'); // IDs of the entries to update

        if (count($timeEntryIds) !== count($projectIds)) {
            return redirect()->route('user.timeSheet')->with('error', 'Mismatch between project IDs and time entry IDs.');
        }

        foreach ($timeEntryIds as $index => $timeEntryId) {
            $timeEntry = TimeEntry::find($timeEntryId);

            if ($timeEntry) {
                $date = Carbon::createFromFormat('Y-m-d', $selectedDate)->toDateString();
                $day = Carbon::createFromFormat('Y-m-d', $selectedDate)->format('l');
                $mondayHours = $request->input('monday_hours')[$index] ?? '0';
                $tuesdayHours = $request->input('tuesday_hours')[$index] ?? '0';
                $wednesdayHours = $request->input('wednesday_hours')[$index] ?? '0';
                $thursdayHours = $request->input('thursday_hours')[$index] ?? '0';
                $fridayHours = $request->input('friday_hours')[$index] ?? '0';
                $saturdayHours = $request->input('saturday_hours')[$index] ?? '0';
                $sundayHours = $request->input('sunday_hours')[$index] ?? '0'; // Added Sunday hours
                $totalHours = $request->input('total_hours')[$index] ?? '0';
                $descriptions = $request->input('description')[$index] ?? '0';

                $timeEntry->project_id = $projectIds[$index];
                $timeEntry->employee_id = Auth::user()->employee_Id;
                $timeEntry->date = $date;
                $timeEntry->day = $day;
                $timeEntry->monday_hours = $mondayHours;
                $timeEntry->tuesday_hours = $tuesdayHours;
                $timeEntry->wednesday_hours = $wednesdayHours;
                $timeEntry->thursday_hours = $thursdayHours;
                $timeEntry->friday_hours = $fridayHours;
                $timeEntry->saturday_hours = $saturdayHours;
                $timeEntry->sunday_hours = $sundayHours; // Set Sunday hours
                $timeEntry->total_hours = $totalHours;
                $timeEntry->descriptions = $descriptions;
                $timeEntry->status = 0; // Assuming status needs to be set to 0

                $timeEntry->save();
            } else {
                return redirect()->route('user.timeSheet')->with('error', 'Time entry not found for ID: ' . $timeEntryId);
            }
        }

        return redirect()->route('user.timeSheet')->with('status', 'Timesheet Updated Successfully');
    }


    private function getProjects()
    {
        $userLoginDetails = Auth::user()->employee_Id;
        $assignedProjects = AddworkesEmployee::where('employee_Id', $userLoginDetails)->where('is_deleted',0)
            ->with('project')
            ->get();

        $projectNames = [];
        $projectIds = [];

        foreach ($assignedProjects as $assignedProject) {
            $projectId = $assignedProject->project->id;
            $projectName = $assignedProject->project->projectname;
            $projectNames[] = $projectName;
            $projectIds[] = $projectId;
        }

        return array_combine($projectIds, $projectNames);
    }

    private function setupDatesAndDays($selectedDate)
    {
        // $startDate = Carbon::createFromFormat('Y-m-d', $selectedDate);
        $startDate = Carbon::parse($selectedDate);

        $datesAndDays = [];

        $datesAndDays[] = [
            'date' => $startDate->toDateString(),
            'day' => $startDate->format('l'),
        ];

        for ($i = 1; $i <= 6; $i++) {
            $nextDate = $startDate->copy()->addDay($i);

            $datesAndDays[] = [
                'date' => $nextDate->toDateString(),
                'day' => $nextDate->format('l'),
            ];
        }

        Session::put('week_dates', $datesAndDays);
        return $datesAndDays;
    }

    public function checkDataExists(Request $request)
    {
        $selectedDate = $request->input('selected_date');

        $exists = TimeEntry::where('date', $selectedDate)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function enterTimeInProjectUpdate(Request $request)
    {
        $userLoginDetails = Auth::user()->employee_Id;
        $selectedDate = $request->input('selected_date');
        $startDate = Carbon::createFromFormat('Y-m-d', $selectedDate);
        $assignedProjects = AddworkesEmployee::where('employee_Id', $userLoginDetails)
            ->with('project')
            ->get();

        $existingEntry = TimeEntry::where('employee_id', $userLoginDetails)
            ->where('date', $selectedDate)
            ->where('status', 1)
            ->exists();

        if ($existingEntry) {
            return redirect()->back()->with('error', 'Data for this date has already been Submited.');
        } else {
            $datesAndDays = [];

            $datesAndDays[] = [
                'date' => $startDate->toDateString(),
                'day' => $startDate->format('l'),
            ];

            for ($i = 1; $i <= 6; $i++) {
                $nextDate = $startDate->copy()->addDay($i);

                $datesAndDays[] = [
                    'date' => $nextDate->toDateString(),
                    'day' => $nextDate->format('l'),
                ];
            }

            Session::put('week_dates', $datesAndDays);
            $weekDates = Session::get('week_dates');

            $timeEntries = TimeEntriesTemp::where('date', $selectedDate)
                ->where('employee_id', $userLoginDetails)
                ->get()->toArray();





            $alreadyFilledData = TimeEntriesTemp::where('date', $selectedDate)
                ->with('project')
                ->get();


            $startDate = Carbon::createFromFormat('Y-m-d', $selectedDate);

            $datesAndDays = [];

            $datesAndDays[] = [
                'date' => $startDate->toDateString(),
                'day' => $startDate->format('l'),
            ];

            for ($i = 1; $i <= 6; $i++) {
                $nextDate = $startDate->copy()->addDay($i);

                $datesAndDays[] = [
                    'date' => $nextDate->toDateString(),
                    'day' => $nextDate->format('l'),
                ];
            }

            Session::put('week_dates', $datesAndDays);

            $weekDates = Session::get('week_dates');
            $userLoginDetails = Auth::user()->employee_Id;
            $assignedProjects = AddworkesEmployee::where('employee_Id', $userLoginDetails)
                ->with('project')
                ->get();

            $projectNames = [];


            foreach ($assignedProjects as $assignedProject) {
                $projectId = $assignedProject->project->id;

                $projectName = $assignedProject->project->projectname;
                $projectNames[] = $projectName;
                $projectIds[] = $projectId;
            }
            $projects = array_combine($projectIds, $projectNames);
            $projects = $this->getProjects();
            $datesAndDays = $this->setupDatesAndDays($selectedDate);
            $weekDates = Session::get('week_dates');
            $totalTime = [
                'monday_hours' => 0,
                'tuesday_hours' => 0,
                'wednesday_hours' => 0,
                'thursday_hours' => 0,
                'friday_hours' => 0,
                'saturday_hours' => 0,
                'sunday_hours' => 0
            ];

            for ($i = 0; $i < count($timeEntries); $i++) {
                $totalTime['monday_hours'] += $timeEntries[$i]['monday_hours'];
                $totalTime['tuesday_hours'] += $timeEntries[$i]['tuesday_hours'];
                $totalTime['wednesday_hours'] += $timeEntries[$i]['wednesday_hours'];
                $totalTime['thursday_hours'] += $timeEntries[$i]['thursday_hours'];
                $totalTime['friday_hours'] += $timeEntries[$i]['friday_hours'];
                $totalTime['saturday_hours'] += $timeEntries[$i]['saturday_hours'];
                $totalTime['sunday_hours'] += $timeEntries[$i]['sunday_hours'];
            }

            $totalTime = [
                'monday_hours' => number_format($totalTime['monday_hours'], 2),
                'tuesday_hours' => number_format($totalTime['tuesday_hours'], 2),
                'wednesday_hours' => number_format($totalTime['wednesday_hours'], 2),
                'thursday_hours' => number_format($totalTime['thursday_hours'], 2),
                'friday_hours' => number_format($totalTime['friday_hours'], 2),
                'saturday_hours' => number_format($totalTime['saturday_hours'], 2),
                'sunday_hours' => number_format($totalTime['sunday_hours'], 2)
            ];
            return view('users.enterTimetheProject', compact('projects', 'datesAndDays', 'weekDates', 'timeEntries', 'totalTime', 'assignedProjects'));
        }
    }
    public function enterDateInProjectTempSave(Request $request)
    {

        $projectIds = $request->input('selected_project_id');
        $selectedDate = $request->input('selected_date');
        $selectIds = $request->input('selected_id');
        $employeeId = Auth::user()->employee_Id;

        foreach ($projectIds as $index => $projectId) {
            $date = Carbon::createFromFormat('Y-m-d', $selectedDate)->toDateString();
            $day = Carbon::createFromFormat('Y-m-d', $selectedDate)->format('l');
            $mondayHours = $request->input('monday')[$index] ?? '0';
            $tuesdayHours = $request->input('tuesday')[$index] ?? '0';
            $wednesdayHours = $request->input('wednesday')[$index] ?? '0';
            $thursdayHours = $request->input('thursday')[$index] ?? '0';
            $fridayHours = $request->input('friday')[$index] ?? '0';
            $saturdayHours = $request->input('saturday')[$index] ?? '0';

            $totalHours = $request->input('total_Hours')[$index] ?? '0';
            $descriptions = $request->input('description')[$index];

            $selectId = $selectIds[$index] ?? null;

            if ($selectId) {
                $existingEntry = TimeEntriesTemp::find($selectId);

                if ($existingEntry) {
                    $existingEntry->project_id = $projectId;
                    $existingEntry->employee_id = $employeeId;
                    $existingEntry->date = $date;
                    $existingEntry->day = $day;
                    $existingEntry->monday_hours = $mondayHours;
                    $existingEntry->tuesday_hours = $tuesdayHours;
                    $existingEntry->wednesday_hours = $wednesdayHours;
                    $existingEntry->thursday_hours = $thursdayHours;
                    $existingEntry->friday_hours = $fridayHours;
                    $existingEntry->saturday_hours = $saturdayHours;

                    $existingEntry->total_hours = $totalHours;
                    $existingEntry->descriptions = $descriptions;
                    $existingEntry->save();
                }
            } else {

                $newEntry = new TimeEntriesTemp();
                $newEntry->project_id = $projectId;
                $newEntry->employee_id = $employeeId;
                $newEntry->date = $date;
                $newEntry->day = $day;
                $newEntry->monday_hours = $mondayHours;
                $newEntry->tuesday_hours = $tuesdayHours;
                $newEntry->wednesday_hours = $wednesdayHours;
                $newEntry->thursday_hours = $thursdayHours;
                $newEntry->friday_hours = $fridayHours;
                $newEntry->saturday_hours = $saturdayHours;

                $newEntry->total_hours = $totalHours;
                $newEntry->descriptions = $descriptions;
                $newEntry->save();
            }
        }

        return redirect()->route('user.timeSheet')->with('status', 'Timesheet Saved Successfully');
    }

<<<<<<< HEAD

    public function enterTimeInProjectUpdateRejected(Request $request)
    {
        $projectIds = $request->input('selected_project_id');
        $selectedDate = $request->input('selected_date');
        $timeEntryIds = $request->input('selected_id'); // IDs of the entries to update

        if (count($timeEntryIds) !== count($projectIds)) {
            return redirect()->route('user.timeSheet')->with('error', 'Mismatch between project IDs and time entry IDs.');
        }

        foreach ($timeEntryIds as $index => $timeEntryId) {
            $timeEntry = TimeEntry::find($timeEntryId);

            if ($timeEntry) {
                $date = Carbon::createFromFormat('Y-m-d', $selectedDate)->toDateString();
                $day = Carbon::createFromFormat('Y-m-d', $selectedDate)->format('l');
                $mondayHours = $request->input('monday_hours')[$index] ?? '0';
                $tuesdayHours = $request->input('tuesday_hours')[$index] ?? '0';
                $wednesdayHours = $request->input('wednesday_hours')[$index] ?? '0';
                $thursdayHours = $request->input('thursday_hours')[$index] ?? '0';
                $fridayHours = $request->input('friday_hours')[$index] ?? '0';
                $saturdayHours = $request->input('saturday_hours')[$index] ?? '0';
                $sundayHours = $request->input('sunday_hours')[$index] ?? '0'; // Added Sunday hours
                $totalHours = $request->input('total_hours')[$index] ?? '0';
                $descriptions = $request->input('description')[$index] ?? '0';

                $timeEntry->project_id = $projectIds[$index];
                $timeEntry->employee_id = Auth::user()->employee_Id;
                $timeEntry->date = $date;
                $timeEntry->day = $day;
                $timeEntry->monday_hours = $mondayHours;
                $timeEntry->tuesday_hours = $tuesdayHours;
                $timeEntry->wednesday_hours = $wednesdayHours;
                $timeEntry->thursday_hours = $thursdayHours;
                $timeEntry->friday_hours = $fridayHours;
                $timeEntry->saturday_hours = $saturdayHours;
                $timeEntry->sunday_hours = $sundayHours; // Set Sunday hours
                $timeEntry->total_hours = $totalHours;
                $timeEntry->descriptions = $descriptions;
                $timeEntry->status = 0; // Assuming status needs to be set to 0

                $timeEntry->save();
            } else {
                return redirect()->route('user.timeSheet')->with('error', 'Time entry not found for ID: ' . $timeEntryId);
            }
        }

        return redirect()->route('user.timeSheet')->with('status', 'Timesheet Updated Successfully');
    }



    public function EnterTimeInProject(Request $request)
    {

=======
    // public function EnterTimeInProject(Request $request)
    // {
    //     $projectIds = $request->input('selected_project_id');
    //     $selectedDate = $request->input('selected_date');

    //     foreach ($projectIds as $index => $projectId) {
    //         $date = Carbon::createFromFormat('Y-m-d', $selectedDate)->toDateString();
    //         $day = Carbon::createFromFormat('Y-m-d', $selectedDate)->format('l');

    //         $mondayHours = $request->input('monday')[$index];
    //         $tuesdayHours = $request->input('tuesday')[$index];
    //         $wednesdayHours = $request->input('wednesday')[$index];
    //         $thursdayHours = $request->input('thursday')[$index];
    //         $fridayHours = $request->input('friday')[$index];
    //         $totalHours = $request->input('total_Hours')[$index];
    //         $descriptions = $request->input('description')[$index];
    //         $saturdayHours = $request->input('saturday')[$index] ?? '0';
    //         // $sundayHours = $request->input('sunday')[$index];

    //         $timeEntry = new TimeEntry();
    //         $timeEntry->project_id = $projectId;
    //         $timeEntry->employee_id = Auth::user()->employee_Id;
    //         $timeEntry->date = $date;
    //         $timeEntry->day = $day;
    //         $timeEntry->monday_hours = $mondayHours;
    //         $timeEntry->tuesday_hours = $tuesdayHours;
    //         $timeEntry->wednesday_hours = $wednesdayHours;
    //         $timeEntry->thursday_hours = $thursdayHours;
    //         $timeEntry->friday_hours = $fridayHours;
    //         $timeEntry->saturday_hours = $fridayHours;

    //         $timeEntry->total_hours = $totalHours;
    //         $timeEntry->descriptions = $descriptions;

    //         $timeEntry->saturday_hours = $saturdayHours;
    //         // $timeEntry->sunday_hours = $sundayHours;
    //         $timeEntry->status = 0;

    //         $timeEntry->save();
    //     }

    //     return redirect()->route('user.timeSheet')->with('status', 'Timesheet Added Successfully');
    // }
    public function EnterTimeInProject(Request $request)
    {
        // Validate the request
        // dd('hle');
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
        $request->validate([
            'selected_project_id' => 'required|array',
            'selected_date' => 'required|date',
            'monday.*' => 'required|numeric',
            'tuesday.*' => 'required|numeric',
            'wednesday.*' => 'required|numeric',
            'thursday.*' => 'required|numeric',
            'friday.*' => 'required|numeric',
            'total_Hours.*' => 'required|numeric',
<<<<<<< HEAD
            'description.*' => 'nullable|string',
=======
            'description.*' => 'required',
        
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
        ]);

        $projectIds = $request->input('selected_project_id');
        $selectedDate = $request->input('selected_date');

        foreach ($projectIds as $index => $projectId) {
            $date = Carbon::createFromFormat('Y-m-d', $selectedDate)->toDateString();
            $day = Carbon::createFromFormat('Y-m-d', $selectedDate)->format('l');

<<<<<<< HEAD
            $existingEntry = TimeEntry::where('project_id', $projectId)
                ->where('employee_id', Auth::user()->employee_Id)
                ->where('date', $date)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($existingEntry) {
                if ($existingEntry->status == 0 && 3) {
                    dd($existingEntry->status);
                    return redirect()->route('user.timeSheet')->with('error', 'Timesheet already submitted for this date. Please wait for it to be approved or rejected before submitting again.');
                } elseif ($existingEntry->status == 1) {
                    return redirect()->route('user.timeSheet')->with('error', 'Timesheet has already been approved for this date.');
                } elseif ($existingEntry->status == 3) {
                    // dd('reopen');
                    return redirect()->route('user.timeSheet')->with('error', 'Timesheet has already Requested for Reopen.');
                }
            }

            $mondayHours = $request->input('monday')[$index] ?? '0';
            $tuesdayHours = $request->input('tuesday')[$index] ?? '0';
            $wednesdayHours = $request->input('wednesday')[$index] ?? '0';
            $thursdayHours = $request->input('thursday')[$index] ?? '0';
            $fridayHours = $request->input('friday')[$index] ?? '0';
            $totalHours = $request->input('total_Hours')[$index] ?? '0';
            $descriptions = $request->input('description')[$index] ?? '0';
=======
            // Check if a time entry already exists for the same project and date
            $existingEntry = TimeEntry::where('project_id', $projectId)
                ->where('employee_id', Auth::user()->employee_Id)
                ->where('date', $date)
                ->orderBy('created_at', 'desc') // Ensure you get the latest entry
                ->first();
                // dd($existingEntry);

            // Check if the entry exists and its status
            if ($existingEntry) {
                if ($existingEntry->status == 0) {
                    // If the status is 0 (pending), return an error message
                    return redirect()->route('user.timeSheet')->with('error', 'Timesheet already submitted for this date. Please wait for it to be approved or rejected before submitting again.');
                } elseif ($existingEntry->status == 1) {
                    // If the status is 1 (approved), return an error message
                    return redirect()->route('user.timeSheet')->with('error', 'Timesheet has already been approved for this date.');
                }
            }

            $mondayHours = $request->input('monday')[$index];
            $tuesdayHours = $request->input('tuesday')[$index];
            $wednesdayHours = $request->input('wednesday')[$index];
            $thursdayHours = $request->input('thursday')[$index];
            $fridayHours = $request->input('friday')[$index];
            $totalHours = $request->input('total_Hours')[$index];
            $descriptions = $request->input('description')[$index];
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
            $saturdayHours = $request->input('saturday')[$index] ?? '0';
            // $sundayHours = $request->input('sunday')[$index];

            $timeEntry = new TimeEntry();
            $timeEntry->project_id = $projectId;
            $timeEntry->employee_id = Auth::user()->employee_Id;
            $timeEntry->date = $date;
            $timeEntry->day = $day;
            $timeEntry->monday_hours = $mondayHours;
            $timeEntry->tuesday_hours = $tuesdayHours;
            $timeEntry->wednesday_hours = $wednesdayHours;
            $timeEntry->thursday_hours = $thursdayHours;
            $timeEntry->friday_hours = $fridayHours;
            $timeEntry->saturday_hours = $saturdayHours;
            // $timeEntry->sunday_hours = $sundayHours;

            $timeEntry->total_hours = $totalHours;
            $timeEntry->descriptions = $descriptions;
            $timeEntry->status = 0;

            $timeEntry->save();
        }

        return redirect()->route('user.timeSheet')->with('status', 'Timesheet Added Successfully');
    }
//     public function EnterTimeInProject(Request $request)
// {
//     // Validate the request with custom messages
    

//     $projectIds = $request->input('selected_project_id');
//     $selectedDate = $request->input('selected_date');

//     foreach ($projectIds as $index => $projectId) {
//         $date = Carbon::createFromFormat('Y-m-d', $selectedDate)->toDateString();
//         $day = Carbon::createFromFormat('Y-m-d', $selectedDate)->format('l');

//         // Check if a time entry already exists for the same project and date
//         $existingEntry = TimeEntry::where('project_id', $projectId)
//             ->where('employee_id', Auth::user()->employee_Id)
//             ->where('date', $date)
//             ->orderBy('created_at', 'desc') // Ensure you get the latest entry
//             ->first();
//             dd(existingEntry);

//         // Check if the entry exists and its status
//         if ($existingEntry) {
//             if ($existingEntry->status == 0) {
//                 dd('here');
//                 // If the status is 0 (pending), return an error message
//                 return redirect()->route('user.timeSheet')->with('error', 'Timesheet already submitted for this date. Please wait for it to be approved or rejected before submitting again.');
//             } elseif ($existingEntry->status == 1) {
//                 // If the status is 1 (approved), return an error message
//                 return redirect()->route('user.timeSheet')->with('error', 'Timesheet has already been approved for this date.');
//             }
//         }

//         $mondayHours = $request->input('monday')[$index];
//         $tuesdayHours = $request->input('tuesday')[$index];
//         $wednesdayHours = $request->input('wednesday')[$index];
//         $thursdayHours = $request->input('thursday')[$index];
//         $fridayHours = $request->input('friday')[$index];
//         $totalHours = $request->input('total_Hours')[$index];
//         $descriptions = $request->input('description')[$index];
//         $saturdayHours = $request->input('saturday')[$index] ?? '0';
//         // $sundayHours = $request->input('sunday')[$index];

//         $timeEntry = new TimeEntry();
//         $timeEntry->project_id = $projectId;
//         $timeEntry->employee_id = Auth::user()->employee_Id;
//         $timeEntry->date = $date;
//         $timeEntry->day = $day;
//         $timeEntry->monday_hours = $mondayHours;
//         $timeEntry->tuesday_hours = $tuesdayHours;
//         $timeEntry->wednesday_hours = $wednesdayHours;
//         $timeEntry->thursday_hours = $thursdayHours;
//         $timeEntry->friday_hours = $fridayHours;
//         $timeEntry->saturday_hours = $saturdayHours;
//         // $timeEntry->sunday_hours = $sundayHours;

//         $timeEntry->total_hours = $totalHours;
//         $timeEntry->descriptions = $descriptions;
//         $timeEntry->status = 0;

//         $timeEntry->save();
//     }

//     return redirect()->route('user.timeSheet')->with('status', 'Timesheet Added Successfully');
// }


    public function showTimeEntriesByDateAndDay($date, $day)
    {
        $timeEntries = TimeEntry::where('date', $date)
            ->where('day', $day)
            ->get();


        return view('time_entries', compact('timeEntries'));
    }


<<<<<<< HEAD

    public function submitedTimesheet()
    {
        $userLoginDetails = Auth::user()->employee_Id;

        $submitedProjects = TimeEntry::where('employee_Id', $userLoginDetails)
            ->with('project')
            ->orderBy('date', 'desc')
            ->paginate(10);
=======
    // public function submitedTimesheet()
    // {
    //     $userLoginDetails = Auth::user()->employee_Id;
    //     $submitedProjects = TimeEntry::where('employee_Id', $userLoginDetails)
    //         ->with('project')
    //         ->paginate(10);
    //     $timeEntries = TimeEntry::where('employee_Id', $userLoginDetails)
    //         ->with(['employee', 'addworkesEmployees' => function ($query) use ($userLoginDetails) {
    //             $query->where('employee_Id', $userLoginDetails);
    //         }])
    //         ->get()
    //         ->toArray();

    //     $employeeTotalHours = [];
    //     $approvedEmployeeName = null;
    //     $timeSheetStatus = [];

    //     foreach ($timeEntries as $timeEntry) {
    //         $approvedEmployeeIds[] = $timeEntry['approvedby_employee_id'];
    //         $timeSheetStatus[] = $timeEntry['status'];
    //         $employeeId = $timeEntry['employee']['id'];
    //         $employeeName = $timeEntry['employee']['name'];
    //         $employeeEmail = $timeEntry['employee']['officialemail'];
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

    //         $submittedTimesheets = TimeEntry::whereIn('date', $mondaysDates)->where('employee_id', $employeeId)->get();
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
    //                 'approvedEmployeeName' => $approvedEmployeeName,
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
    //                 'employeeEmail' => $employeeEmail,
    //             ];
    //         }
    //         dd($employeeTotalHours);

    //     }



    //     return view('users.submited_timesheet', ['submitedProjects' => $submitedProjects, 'employeeTotalHours' => $employeeTotalHours]);
    // }
    // public function submitedTimesheet()
    // {
    //     $userLoginDetails = Auth::user()->employee_Id;
    //     $submitedProjects = TimeEntry::where('employee_Id', $userLoginDetails)
    //         ->with('project')
    //         ->paginate(10);
    //     $timeEntries = TimeEntry::where('employee_Id', $userLoginDetails)
    //         ->with(['employee', 'addworkesEmployees' => function ($query) use ($userLoginDetails) {
    //             $query->where('employee_Id', $userLoginDetails);
    //         }])
    //         ->get();

    //     $employeeTotalHours = [];

    //     foreach ($timeEntries as $timeEntry) {
    //         $employeeId = $timeEntry->employee->id;
    //         $employeeName = $timeEntry->employee->name;
    //         $employeeEmail = $timeEntry->employee->officialemail;
    //         $totalHours = $timeEntry->total_hours;
    //         $relevantEmployeeAllocation = $timeEntry->addworkesEmployees->first();
    //         $employeeAllocationStartDate = $relevantEmployeeAllocation->startdate;
    //         $employeeAllocationEndDate = $relevantEmployeeAllocation->enddate;
    //         $startDate = strtotime($employeeAllocationStartDate);
    //         $endDate = strtotime($employeeAllocationEndDate);

    //         $mondaysCount = 0;
    //         $mondaysDates = [];
    //         for ($currentDate = $startDate; $currentDate <= $endDate; $currentDate += 86400) {
    //             if (date('N', $currentDate) == 1) {
    //                 $mondaysCount++;
    //                 $mondaysDates[] = date('Y-m-d', $currentDate);
    //             }
    //         }
    //         $submittedTimesheets = TimeEntry::whereIn('date', $mondaysDates)
    //             ->where('employee_Id', $employeeId)
    //             ->get()
    //             ->pluck('date')
    //             ->toArray();

    //         $submittedTimesheetsCount = count($submittedTimesheets);
    //         $pendingTimesheetDates = array_diff($mondaysDates, $submittedTimesheets);
    //         $pendingTimesheetDatesBeforeCurrent = [];
    //         $currentDate = strtotime(date('Y-m-d'));

    //         foreach ($pendingTimesheetDates as $date) {
    //             if (strtotime($date) < $currentDate) {
    //                 $pendingTimesheetDatesBeforeCurrent[] = $date;
    //             }
    //         }

    //         $pendingTimesheetsCount = count($pendingTimesheetDatesBeforeCurrent);
    //         $employeeTotalHours[$employeeId] = [
    //             'name' => $employeeName,
    //             'total_hours' => $totalHours,
    //             'startDate' => $employeeAllocationStartDate,
    //             'endDate' => $employeeAllocationEndDate,
    //             'mondaysCount' => $mondaysCount,
    //             'mondaysDates' => $mondaysDates,
    //             'submittedTimesheetsCount' => $submittedTimesheetsCount,
    //             'submittedTimesheetDates' => $submittedTimesheets,
    //             'pendingTimesheetsCount' => $pendingTimesheetsCount,
    //             'pendingTimesheetDates' => $pendingTimesheetDatesBeforeCurrent,
    //             'employeeEmail' => $employeeEmail,
    //         ];
    //     }

    //     return view('users.submited_timesheet', ['submitedProjects' => $submitedProjects, 'employeeTotalHours' => $employeeTotalHours]);
    // }
    public function submitedTimesheet()
    {
        $userLoginDetails = Auth::user()->employee_Id;
    
        // $submitedProjects = TimeEntry::where('employee_Id', $userLoginDetails)
        //     ->with('project')
        //     ->paginate(10);
        $submitedProjects = TimeEntry::where('employee_Id', $userLoginDetails)
        ->with('project')
        ->orderBy('date', 'desc') // Order projects by date in descending order
        ->paginate(10);
    
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
        $timeEntries = TimeEntry::where('employee_Id', $userLoginDetails)
            ->with(['employee', 'addworkesEmployees' => function ($query) use ($userLoginDetails) {
                $query->where('employee_Id', $userLoginDetails);
            }])
            ->get();
<<<<<<< HEAD

        $employeeTotalHours = [];

        foreach ($timeEntries as $timeEntry) {
            $employeeId = $timeEntry->employee->id;
            $employeeName = $timeEntry->employee->name;
            $employeeEmail = $timeEntry->employee->officialemail;
            $totalHours = $timeEntry->total_hours;
            $relevantEmployeeAllocation = $timeEntry->addworkesEmployees->first();
            $employeeAllocationStartDate = $relevantEmployeeAllocation->startdate;
            $employeeAllocationEndDate = $relevantEmployeeAllocation->enddate;
            $startDate = strtotime($employeeAllocationStartDate);
            $endDate = strtotime($employeeAllocationEndDate);

            $mondaysCount = 0;
            $mondaysDates = [];
            for ($currentDate = $startDate; $currentDate <= $endDate; $currentDate += 86400) {
                if (date('N', $currentDate) == 1) {
                    $mondaysCount++;
                    $mondaysDates[] = date('Y-m-d', $currentDate);
                }
            }
            $submittedTimesheets = TimeEntry::whereIn('date', $mondaysDates)
                ->where('employee_Id', $employeeId)
                ->get()
                ->pluck('date')
                ->toArray();

            $submittedTimesheetsCount = count($submittedTimesheets);
            $pendingTimesheetDates = array_diff($mondaysDates, $submittedTimesheets);
            $pendingTimesheetDatesBeforeCurrent = [];
            $currentDate = strtotime(date('Y-m-d'));

            foreach ($pendingTimesheetDates as $date) {
                if (strtotime($date) < $currentDate) {
                    $pendingTimesheetDatesBeforeCurrent[] = $date;
                }
            }

            $pendingTimesheetsCount = count($pendingTimesheetDatesBeforeCurrent);
            $employeeTotalHours[$employeeId] = [
                'name' => $employeeName,
                'total_hours' => $totalHours,
                'startDate' => $employeeAllocationStartDate,
                'endDate' => $employeeAllocationEndDate,
                'mondaysCount' => $mondaysCount,
                'mondaysDates' => $mondaysDates,
                'submittedTimesheetsCount' => $submittedTimesheetsCount,
                'submittedTimesheetDates' => $submittedTimesheets,
                'pendingTimesheetsCount' => $pendingTimesheetsCount,
                'pendingTimesheetDates' => $pendingTimesheetDatesBeforeCurrent,
                'employeeEmail' => $employeeEmail,
            ];
        }
        return view('users.submited_timesheet', ['submitedProjects' => $submitedProjects, 'employeeTotalHours' => $employeeTotalHours]);
    }


=======
    
        $employeeTotalHours = [];
    
        foreach ($timeEntries as $timeEntry) {
            $employeeId = $timeEntry->employee->id;
            $employeeName = $timeEntry->employee->name;
            $employeeEmail = $timeEntry->employee->officialemail;
            $totalHours = $timeEntry->total_hours;
    
            // Check if there are allocations
            $relevantEmployeeAllocation = $timeEntry->addworkesEmployees->first();
    
            if ($relevantEmployeeAllocation) {
                $employeeAllocationStartDate = $relevantEmployeeAllocation->startdate;
                $employeeAllocationEndDate = $relevantEmployeeAllocation->enddate;
                $startDate = strtotime($employeeAllocationStartDate);
                $endDate = strtotime($employeeAllocationEndDate);
    
                $mondaysCount = 0;
                $mondaysDates = [];
                for ($currentDate = $startDate; $currentDate <= $endDate; $currentDate += 86400) {
                    if (date('N', $currentDate) == 1) {
                        $mondaysCount++;
                        $mondaysDates[] = date('Y-m-d', $currentDate);
                    }
                }
    
                $submittedTimesheets = TimeEntry::whereIn('date', $mondaysDates)
                    ->where('employee_Id', $employeeId)
                    ->get()
                    ->pluck('date')
                    ->toArray();
    
                $submittedTimesheetsCount = count($submittedTimesheets);
                $pendingTimesheetDates = array_diff($mondaysDates, $submittedTimesheets);
                $pendingTimesheetDatesBeforeCurrent = [];
                $currentDate = strtotime(date('Y-m-d'));
    
                foreach ($pendingTimesheetDates as $date) {
                    if (strtotime($date) < $currentDate) {
                        $pendingTimesheetDatesBeforeCurrent[] = $date;
                    }
                }
    
                $pendingTimesheetsCount = count($pendingTimesheetDatesBeforeCurrent);
    
                $employeeTotalHours[$employeeId] = [
                    'name' => $employeeName,
                    'total_hours' => $totalHours,
                    'startDate' => $employeeAllocationStartDate,
                    'endDate' => $employeeAllocationEndDate,
                    'mondaysCount' => $mondaysCount,
                    'mondaysDates' => $mondaysDates,
                    'submittedTimesheetsCount' => $submittedTimesheetsCount,
                    'submittedTimesheetDates' => $submittedTimesheets,
                    'pendingTimesheetsCount' => $pendingTimesheetsCount,
                    'pendingTimesheetDates' => $pendingTimesheetDatesBeforeCurrent,
                    'employeeEmail' => $employeeEmail,
                ];
            } else {
                // Handle cases where there are no allocations
                $employeeTotalHours[$employeeId] = [
                    'name' => $employeeName,
                    'total_hours' => $totalHours,
                    'startDate' => null,
                    'endDate' => null,
                    'mondaysCount' => 0,
                    'mondaysDates' => [],
                    'submittedTimesheetsCount' => 0,
                    'submittedTimesheetDates' => [],
                    'pendingTimesheetsCount' => 0,
                    'pendingTimesheetDates' => [],
                    'employeeEmail' => $employeeEmail,
                ];
            }
        }
    
        return view('users.submited_timesheet', ['submitedProjects' => $submitedProjects, 'employeeTotalHours' => $employeeTotalHours]);
    }
    

>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
    public function getProjectData(Request $request)
    {
        $employeeId = Auth::user()->employee_Id;
        $projectId = $request->input('projectId');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $submitedProjects = TimeEntry::where('employee_id', $employeeId);

        if ($projectId != '') {
            $submitedProjects = $submitedProjects->where('project_id', $projectId);
        }

        if ($startDate != '' && $endDate != '') {
            $submitedProjects = $submitedProjects->whereBetween('date', [$startDate, $endDate]);
        }

        $submitedProjects = $submitedProjects->with('project', 'approvedByEmployee')->get();

        return response()->json($submitedProjects);
    }
<<<<<<< HEAD
    // 
    // public function reopen(Request $request)
    // {
    //     dd($request->all());
    //     $timesheetId = $request->query('timesheetId');
    //     $date = $request->query('date');
    //     $employeeIds = $request->query('employeeIds');
    //     $projectIds = $request->query('projectIds');

    //     $fetchTimesheetData = TimeEntry::find($timesheetId);


    //     if (!$fetchTimesheetData) {
    //         return response()->json(['error' => 'Timesheet not found'], 404);
    //     }

    //     $reopenTimesheet = ReopenTimesheet::updateOrCreate(
    //         ['timesheet_id' => $fetchTimesheetData->id], // Unique identifier for update
    //         [
    //             'project_id' => $projectIds,
    //             'employee_id' => $employeeIds,
    //             'date' => $date,
    //             'day' => $fetchTimesheetData->day,
    //             'status' => 3, // Status for reopening
    //             'approved_by_employee_id' => null, // Not approved yet
    //             'rejection_reason' => null,
    //             'monday_hours' => $fetchTimesheetData->monday_hours,
    //             'tuesday_hours' => $fetchTimesheetData->tuesday_hours,
    //             'wednesday_hours' => $fetchTimesheetData->wednesday_hours,
    //             'thursday_hours' => $fetchTimesheetData->thursday_hours,
    //             'friday_hours' => $fetchTimesheetData->friday_hours,
    //             'saturday_hours' => $fetchTimesheetData->saturday_hours,
    //             'sunday_hours' => $fetchTimesheetData->sunday_hours,
    //             'total_hours' => $fetchTimesheetData->total_hours,
    //             'descriptions' => $fetchTimesheetData->descriptions, 
    //             'is_ProjectManagers' => 3
    //         ]
    //     );
    //     $updateTimesheet = TimeEntry::findOrFail($timesheetId);
    //     $reopenTimesheet = TimeEntry::updateOrCreate(
    //         ['id' => $updateTimesheet->id], 
    //         [
    //             'project_id' => $projectIds,
    //             'employee_id' => $employeeIds,
    //             'date' => $date,
    //             'day' => $updateTimesheet->day,
    //             'status' => 3, // Status for reopening
    //             'approved_by_employee_id' => 0, // Not approved yet
    //             'rejection_reason' => null,
    //             'monday_hours' => $updateTimesheet->monday_hours,
    //             'tuesday_hours' => $updateTimesheet->tuesday_hours,
    //             'wednesday_hours' => $updateTimesheet->wednesday_hours,
    //             'thursday_hours' => $updateTimesheet->thursday_hours,
    //             'friday_hours' => $updateTimesheet->friday_hours,
    //             'saturday_hours' => $updateTimesheet->saturday_hours,
    //             'sunday_hours' => $updateTimesheet->sunday_hours,
    //             'total_hours' => $updateTimesheet->total_hours,
    //             'descriptions' => $updateTimesheet->descriptions
    //         ]
    //     );
    //     return response()->json(['message' => 'Timesheet request successfully sent.']);
    // }
    public function reopen(Request $request)
    {
        // Validate incoming request
        // dd('hlw');
=======
    public function reopen(Request $request)
    {
        // Validate incoming request
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
        $validated = $request->validate([
            'timesheetId' => 'required|integer|exists:time_entries,id',
            'date' => 'required|date',
            'employeeIds' => 'required|integer',
            'projectIds' => 'required|integer',
            'reason' => 'required|string',
        ]);

        // Retrieve validated data
        $timesheetId = $validated['timesheetId'];
        $date = $validated['date'];
        $employeeIds = $validated['employeeIds'];
        $projectIds = $validated['projectIds'];
        $reason = $validated['reason'];

        // Find the existing timesheet
        $fetchTimesheetData = TimeEntry::find($timesheetId);

        if (!$fetchTimesheetData) {
            return response()->json(['error' => 'Timesheet not found'], 404);
        }

<<<<<<< HEAD
        // Update or create the ReopenTimesheet record
=======
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
        ReopenTimesheet::updateOrCreate(
            ['timesheet_id' => $fetchTimesheetData->id], // Unique identifier for update
            [
                'project_id' => $projectIds,
                'employee_id' => $employeeIds,
                'date' => $date,
                'day' => $fetchTimesheetData->day,
                'status' => 3, // Status for reopening
                'approved_by_employee_id' => null, // Not approved yet
                'rejection_reason' => null, // Store the reason
                'reopen_reason_user' => $reason,
                'monday_hours' => $fetchTimesheetData->monday_hours,
                'tuesday_hours' => $fetchTimesheetData->tuesday_hours,
                'wednesday_hours' => $fetchTimesheetData->wednesday_hours,
                'thursday_hours' => $fetchTimesheetData->thursday_hours,
                'friday_hours' => $fetchTimesheetData->friday_hours,
                'saturday_hours' => $fetchTimesheetData->saturday_hours,
                'sunday_hours' => $fetchTimesheetData->sunday_hours,
                'total_hours' => $fetchTimesheetData->total_hours,
                'descriptions' => $fetchTimesheetData->descriptions,
                'is_ProjectManagers' => 3
            ]
        );

        TimeEntry::updateOrCreate(
            ['id' => $timesheetId],
            [
                'project_id' => $projectIds,
                'employee_id' => $employeeIds,
                'date' => $date,
                'day' => $fetchTimesheetData->day,
                'status' => 3, // Status for reopening
                'approved_by_employee_id' => 0, // Not approved yet
                'rejection_reason' => null, // Store the reason
                'reopen_reason_user' => $reason,
                'monday_hours' => $fetchTimesheetData->monday_hours,
                'tuesday_hours' => $fetchTimesheetData->tuesday_hours,
                'wednesday_hours' => $fetchTimesheetData->wednesday_hours,
                'thursday_hours' => $fetchTimesheetData->thursday_hours,
                'friday_hours' => $fetchTimesheetData->friday_hours,
                'saturday_hours' => $fetchTimesheetData->saturday_hours,
                'sunday_hours' => $fetchTimesheetData->sunday_hours,
                'total_hours' => $fetchTimesheetData->total_hours,
                'descriptions' => $fetchTimesheetData->descriptions
            ]
        );

        return response()->json(['message' => 'Timesheet request successfully sent.']);
    }
}
