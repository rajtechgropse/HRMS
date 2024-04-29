<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\AddworkesEmployee;
use App\Models\TimeEntry;
use App\Models\TimeEntriesTemp;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;


use Illuminate\Support\Facades\Session;

class TimesheetController extends Controller
{
    public function Timesheet()
    {
        $userLoginDetails = Auth::user()->employee_Id;
        $assignedProjects = AddworkesEmployee::where('employee_Id', $userLoginDetails)
            ->with('project')
            ->get();


        $projectStartDates = $assignedProjects->pluck('startdate')->toArray();
        $projectEndDates = $assignedProjects->pluck('enddate')->toArray();

        $minDate = min($projectStartDates);
        $maxDate = max($projectEndDates);

        return view('users.time_Sheet', compact('minDate', 'maxDate'));
    }

    public function enterDateInProject(Request $request)
    {
        $userLoginDetails = Auth::user()->employee_Id;
        $selectedDate = $request->input('week_start_date');

        $existingEntry = TimeEntry::where('employee_id', $userLoginDetails)
            ->where('date', $selectedDate)
            ->where('status', 1)
            ->get();

        if ($existingEntry->isNotEmpty()) {
            $projects = $this->getProjects();
            $datesAndDays = $this->setupDatesAndDays($selectedDate);
            $weekDates = Session::get('week_dates');

            return view('users.submite_Data_View', compact('projects', 'datesAndDays', 'weekDates', 'existingEntry'));
        } else {
            $timeEntries = TimeEntriesTemp::where('date', $selectedDate)
                ->where('employee_id', $userLoginDetails)
                ->get()->toArray();

            $projects = $this->getProjects();
            $datesAndDays = $this->setupDatesAndDays($selectedDate);
            $weekDates = Session::get('week_dates');

            return view('users.enterTimetheProject', compact('projects', 'datesAndDays', 'weekDates', 'timeEntries'));
        }
    }

    private function getProjects()
    {
        $userLoginDetails = Auth::user()->employee_Id;
        $assignedProjects = AddworkesEmployee::where('employee_Id', $userLoginDetails)
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
            return view('users.enterTimetheProject', compact('projects', 'datesAndDays', 'weekDates', 'timeEntries'));
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
                $newEntry->total_hours = $totalHours;
                $newEntry->descriptions = $descriptions;
                $newEntry->save();
            }
        }

        return redirect()->route('user.timeSheet')->with('status', 'Timesheet Saved Successfully');
    }

    public function EnterTimeInProject(Request $request)
    {
        $projectIds = $request->input('selected_project_id');
        $selectedDate = $request->input('selected_date');

        foreach ($projectIds as $index => $projectId) {
            $date = Carbon::createFromFormat('Y-m-d', $selectedDate)->toDateString();
            $day = Carbon::createFromFormat('Y-m-d', $selectedDate)->format('l');

            $mondayHours = $request->input('monday')[$index];
            $tuesdayHours = $request->input('tuesday')[$index];
            $wednesdayHours = $request->input('wednesday')[$index];
            $thursdayHours = $request->input('thursday')[$index];
            $fridayHours = $request->input('friday')[$index];
            $totalHours = $request->input('total_Hours')[$index];
            $descriptions = $request->input('description')[$index];
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
            $timeEntry->total_hours = $totalHours;
            $timeEntry->descriptions = $descriptions;

            $timeEntry->saturday_hours = $saturdayHours;
            // $timeEntry->sunday_hours = $sundayHours;
            $timeEntry->status = 1;

            $timeEntry->save();
        }

        return redirect()->route('user.timeSheet')->with('status', 'Timesheet Added Successfully');
    }

    public function showTimeEntriesByDateAndDay($date, $day)
    {
        $timeEntries = TimeEntry::where('date', $date)
            ->where('day', $day)
            ->get();


        return view('time_entries', compact('timeEntries'));
    }


    public function submitedTimesheet()
    {
        $userLoginDetails = Auth::user()->employee_Id;
        $submitedProjects = TimeEntry::where('employee_Id', $userLoginDetails)
            ->with('project')
            ->paginate(10);

        return view('users.submited_timesheet', ['submitedProjects' => $submitedProjects]);
    }
}
