<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\AddProjects;
use App\Models\User;
use App\Models\addworkesEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Collective\Html\FormFacade as Form;


class AddworkemployeeController extends Controller
{
    public function addWorksEmployee($id)
    {
        $modules = Session::get('user_modules_' . auth()->id());

        $projectData = AddProjects::find($id);

        if ($projectData) {
            $addworkesEmployees = addworkesEmployee::where('project_id', $projectData->id)->get();
            $employee_Id = $addworkesEmployees->pluck('employee_Id');
            $usersDetails = User::whereIn('employee_Id', $employee_Id)->get();
            return view('addWorkEmployee', [
                'modules' => $modules,
                'projectData' => $projectData,
                'addworkesEmployees' => $addworkesEmployees,
                'usersDetails' => $usersDetails
            ]);
        } else {
        }
    }

    public function fetchUsersByDesignation($designation)
    {
        $users = User::where('designation', $designation)->get();
        // dd($users);
        return response()->json($users);
    }


    public function addworkesEmployeeStore(Request $request)
    {
        $employeeId = $request->input('employee_id');
        $addworkesEmployee = [
            'project_id' => $request->input('projectId'),
            'userDepartment' => $request->input('userDepartment'),
            'userDesignation' => $request->input('userDesignation'),
            'employee_Id' => $request->input('employee_Id'),
            'allocationpercentage' => $request->input('allocationpercentage'),
            'startdate' => $request->input('startdate'),
            'enddate' => $request->input('enddate'),
        ];

        $existingProject = AddworkesEmployee::find($employeeId);

        if ($existingProject) {
            $newTotalAllocation = $request->input('allocationpercentage');

            $totalAllocation = AddworkesEmployee::where('employee_Id', $request->input('employee_Id'))
                ->where('id', '!=', $employeeId)
                ->sum('allocationpercentage');

            $newTotalAllocation += $totalAllocation;

            if ($newTotalAllocation > 100) {
                $errorMessage = 'Total allocation percentage for this user exceeds 100%';
                return redirect()->back()->withInput()->withErrors(['allocationpercentage' => $errorMessage]);
            }

            $existingProject->fill($addworkesEmployee)->save();
            return redirect()->route('addWorksEmployee.id', ['id' => $addworkesEmployee['project_id']])->with('status', 'Employee Updated Successfully');
        } else {
            $totalAllocation = AddworkesEmployee::where('employee_Id', $request->input('employee_Id'))->sum('allocationpercentage');
            $newTotalAllocation = $totalAllocation + $request->input('allocationpercentage');

            if ($newTotalAllocation > 100) {
                $errorMessage = 'Total allocation percentage for this user exceeds 100%';
                return redirect()->back()->withInput()->withErrors(['allocationpercentage' => $errorMessage]);
            }

            $project = AddworkesEmployee::create($addworkesEmployee);

            if ($project) {
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
        // dd($employee);
        return view('editEmployee', ['employee' => $employee], ['modules' => $modules]);
    }

    public function deleteEmployee($id)
    {
        $employee = AddworkesEmployee::find($id);

        if ($employee) {
            $employee->delete();
            Session::flash('success', 'Employee record deleted successfully.');
        } else {
            Session::flash('error', 'Failed to delete employee record.');
        }

        return redirect()->back();
    }
}
