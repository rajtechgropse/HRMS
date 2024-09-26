<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\AddProjects;
use app\Models\AddworkesEmployee;
use app\Models\employees;
use App\Models\TimeEntry;
use Illuminate\Http\Request;

class EmployeeWorkedHours extends Controller
{
    public function projectHours($id)
    {
        $modules = Session::get('user_modules_' . auth()->id());
        $projectId = $id;
        $project = AddProjects::findOrFail($projectId);
        $timeEntries = TimeEntry::where('project_id', $projectId)->with('employee')->get()->toArray();
        $totalHours = 0;
        foreach ($timeEntries as $timeEntry) {
            $totalHours += $timeEntry['total_hours'];
        }
        $projectName = $project['projectname'];
        $projectStartDate = $project['projectstartdate'];
        $projectEndDate = $project['projectenddate'];
        $projectDetails = [
            'project_name' => $projectName,
            'project_startDate' => $projectStartDate,
            'projectEndDate' => $projectEndDate,
            'total_working_hours' => $totalHours,
            'projectId' => $id,
        ];
        return view('projectTotalHoursWorking', compact('modules', 'projectDetails'));
    }


    // public function employeHours($id)
    // {
    //     $modules = Session::get('user_modules_' . auth()->id());
    //     $projectId = $id;
    //     $timeEntries = TimeEntry::where('project_id', $projectId)->where('status',1)->with('employee', 'addworkesEmployees')->get()->toArray();
    //     $employeeTotalHours = [];
    //     foreach ($timeEntries as $timeEntry) {
    //         $employeeId = $timeEntry['employee']['id'];
    //         $employeeName = $timeEntry['employee']['name'];
    //         $totalHours = $timeEntry['total_hours'];

    //         $relevantEmployeeAllocation = array_filter($timeEntry['addworkes_employees'], function ($allocation) use ($employeeId) {
    //             return $allocation['employee_Id'] == $employeeId;
    //         });
    //         // dd($relevantEmployeeAllocation);

    //         $employeeAllcationStartDate = reset($relevantEmployeeAllocation)['startdate'];
    //         $employeeAllcationEndDate = reset($relevantEmployeeAllocation)['enddate'];

    //         if (isset($employeeTotalHours[$employeeId])) {
    //             $employeeTotalHours[$employeeId]['total_hours'] += $totalHours;
    //         } else {
    //             $employeeTotalHours[$employeeId] = [
    //                 'name' => $employeeName,
    //                 'total_hours' => $totalHours,
    //                 'startDate' => $employeeAllcationStartDate,
    //                 'endDate' => $employeeAllcationEndDate,
    //                 'employeeIds' => $employeeId,
    //                 'projectIds' => $projectId,
    //             ];
    //         }
    //     }
    //     // dd($employeeTotalHours);
    //     return view('employee_submited_hours', compact('modules', 'employeeTotalHours'));
    // }
    public function employeHours($id)
    {
        $modules = Session::get('user_modules_' . auth()->id());
        $projectId = $id;
        $timeEntries = TimeEntry::where('project_id', $projectId)->where('status',1)->with('employee', 'addworkesEmployees')->get()->toArray();
        $employeeTotalHours = [];
    
        foreach ($timeEntries as $timeEntry) {
            $employeeId = $timeEntry['employee']['id'];
            $employeeName = $timeEntry['employee']['name'];
            $totalHours = $timeEntry['total_hours'];
    
            // Filter relevant allocations
            $relevantEmployeeAllocation = array_filter($timeEntry['addworkes_employees'], function ($allocation) use ($employeeId) {
                return $allocation['employee_Id'] == $employeeId;
            });
    
            // Check if $relevantEmployeeAllocation is not empty and is an array
            if (!empty($relevantEmployeeAllocation) && is_array($relevantEmployeeAllocation)) {
                $relevantEmployeeAllocation = reset($relevantEmployeeAllocation);
                $employeeAllcationStartDate = $relevantEmployeeAllocation['startdate'] ?? null;
                $employeeAllcationEndDate = $relevantEmployeeAllocation['enddate'] ?? null;
            } else {
                // Handle case where no allocation is found
                $employeeAllcationStartDate = null;
                $employeeAllcationEndDate = null;
            }
    
            if (isset($employeeTotalHours[$employeeId])) {
                $employeeTotalHours[$employeeId]['total_hours'] += $totalHours;
            } else {
                $employeeTotalHours[$employeeId] = [
                    'name' => $employeeName,
                    'total_hours' => $totalHours,
                    'startDate' => $employeeAllcationStartDate,
                    'endDate' => $employeeAllcationEndDate,
                    'employeeIds' => $employeeId,
                    'projectIds' => $projectId,
                ];
            }
        }
    
        return view('employee_submited_hours', compact('modules', 'employeeTotalHours'));
    }
    


    public function AllProjectedFetch()
    {
        $modules = Session::get('user_modules_' . auth()->id());
        $allProjects = AddProjects::paginate(10);
        $projectIds = $allProjects->pluck('id')->toArray();
        $timeEntries = TimeEntry::whereIn('project_id', $projectIds)->where('status' , 1)->with('employee', 'addworkesEmployees')->get()->toArray();
        $projectHours = [];

        foreach ($timeEntries as $timeEntry) {
            $projectId = $timeEntry['project_id'];
            $projectName = AddProjects::find($projectId)->projectname;
            $projectStartDate = AddProjects::find($projectId)->projectstartdate;
            $projectEndDate = AddProjects::find($projectId)->projectenddate;
            $totalHours = $timeEntry['total_hours'];

            $projectManagers = AddworkesEmployee::where('project_id', $projectId)
                ->where('userDesignation', 'Project Manager')
                ->get();

            if ($projectManagers->isNotEmpty()) {
                $projectManagerIds = $projectManagers->pluck('employee_Id')->implode(', ');
                $projectsManagerName = employees::find($projectManagerIds)->name;
            } else {
                $projectsManagerName = 'Not Assigned';
            }

            if (isset($projectHours[$projectId])) {
                $projectHours[$projectId]['total_hours'] += $totalHours;
            } else {
                $projectHours[$projectId] = [
                    'name' => $projectName,
                    'startDate' => $projectStartDate,
                    'endDate' => $projectEndDate,
                    'total_hours' => $totalHours,
                    'projectId' => $projectId,
                    'project_manager' => $projectsManagerName,
                ];
            }
        }
        // dd($projectHours);

        return view('AllProjectsFetch', compact('modules', 'projectHours', 'allProjects'));
    }
    // public function employeeHoursWithTimeSheets(Request $request) {
    //     $modules = Session::get('user_modules_' . auth()->id());

    //     $employeeIds = $request->query('employeeIds');
    //     $projectIds = $request->query('projectIds');
    
    //     // Convert employeeIds and projectIds to arrays if they are not already
    //     if (!is_array($employeeIds)) {
    //         $employeeIds = explode(',', $employeeIds);
    //     }
    //     if (!is_array($projectIds)) {
    //         $projectIds = explode(',', $projectIds);
    //     }
    
    //     $timeEntries = TimeEntry::whereIn('project_id', $projectIds) 
    //         ->whereIn('employee_id', $employeeIds)
    //         ->where('status', 1) 
    //         ->with('employee', 'addworkesEmployees') 
    //         ->get();
    
    //     // Prepare data for the view
    //     $formattedEntries = [];
    //     foreach ($timeEntries as $timeEntry) {
    //         $formattedEntries[] = [
    //             'weeksDate' => $timeEntry->date, 
    //             'totalHours' => $timeEntry->total_hours
    //         ];
    //     }
    // // dd($formattedEntries);
    //     return view('employeeTimesheetWithHours', ['timeEntries' => $formattedEntries],['modules' => $modules]);
    // }
    public function employeeHoursWithTimeSheets(Request $request) {
        // Retrieve user modules from the session
        $modules = Session::get('user_modules_' . auth()->id());
    
        // Retrieve query parameters
        $employeeIds = $request->query('employeeIds');
        $projectIds = $request->query('projectIds');
    
        // Convert employeeIds and projectIds to arrays if they are not already
        if (!is_array($employeeIds)) {
            $employeeIds = explode(',', $employeeIds);
        }
        if (!is_array($projectIds)) {
            $projectIds = explode(',', $projectIds);
        }
    
        // Paginate results
        $timeEntries = TimeEntry::whereIn('project_id', $projectIds)
            ->whereIn('employee_id', $employeeIds)
            ->where('status', 1)
            ->with('employee', 'addworkesEmployees')
            ->paginate(15); // Adjust the number of items per page as needed
    
        // Prepare data for the view
        $formattedEntries = [];
        foreach ($timeEntries as $timeEntry) {
            $formattedEntries[] = [
                'weeksDate' => $timeEntry->date, // Adjust if necessary to match the actual field name
                'totalHours' => $timeEntry->total_hours // Adjust if necessary to match the actual field name
            ];
        }
    
        // Return the view with pagination data
        return view('employeeTimesheetWithHours', [
            'timeEntries' => $formattedEntries,
            'modules' => $modules,
            'pagination' => $timeEntries // Pass the paginator instance to the view
        ]);
    }
    
    
}
