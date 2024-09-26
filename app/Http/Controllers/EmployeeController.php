<?php

namespace App\Http\Controllers;

use App\Models\module;
use App\Models\employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
<<<<<<< HEAD
use App\Models\AddworkesEmployee;
use Illuminate\Support\Facades\Auth;
=======
// use App\Models\AddworkesEmployee;
use App\Models\addworkesEmployee;
use Illuminate\Support\Facades\Auth;

>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c




class EmployeeController extends Controller
{
    public function employeeManagement()
    {
        $modules = Session::get('user_modules_' . auth()->id());
        return view('add_employee', ['modules' => $modules]);
    }
    public function employeeStore(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'empId' => 'required|unique:employees|max:255',
                'emergencycontact' => 'required|numeric',
                'pannumber' => 'required',
                'name' => 'required|string|max:255',
                'currentaddress' => 'required|max:255',
                'userDepartment' => 'required',
                'permanentaddress' => 'required|string|max:255',
                'comnpanyexperience' => 'required|numeric',
                'userDesignation' => 'required',
                'city' => 'required|string|max:255',
                // 'employeestatus' => 'required|string|in:active,inactive',
                'employeestatus' => 'required|string|in:0,1',

                'reportingmanager' => 'required|string|max:255',
                'dob' => 'required|date',
                'lastworkingday' => 'required|date',
                'officialemail' => 'required|email|max:255',
                'joiningdate' => 'required|date',
                'personalemail' => 'required|email|max:255',
                'higestqualification' => 'required|string|max:255',
                'contactdetails' => 'required|string|max:255',
                'aadharnumber' => 'required|string|max:255',
            ],
            [
                'empId.required' => 'Employee ID is required.',
                'empId.unique' => 'Employee ID must be unique.',
                'empId.max' => 'Employee ID must not exceed 255 characters.',
                'emergencycontact.required' => 'Emergency contact is required.',
                'emergencycontact.numeric' => 'Emergency contact must be a numeric value.',
                'pannumber.required' => 'PAN number is required.',
                'name.required' => 'Name is required.',
                'name.max' => 'Name must not exceed 255 characters.',
                'currentaddress.required' => 'Current address is required.',
                'currentaddress.max' => 'Current address must not exceed 255 characters.',
                'trainingcompletion.max' => 'Training completion must not exceed 255 characters.',
                'userDepartment.required' => 'Department is required.',
                'permanentaddress.required' => 'Permanent address is required.',
                'permanentaddress.max' => 'Permanent address must not exceed 255 characters.',
                'comnpanyexperience.required' => 'Company experience is required.',
                'comnpanyexperience.numeric' => 'Company experience must be a numeric value.',
                'userDesignation.required' => 'Designation is required.',
                'city.required' => 'City is required.',
                'city.max' => 'City must not exceed 255 characters.',
                'employeestatus.required' => 'Employee status is required.',
                // 'employeestatus.in' => 'Employee status must be either active or inactive.',
                'reportingmanager.required' => 'Reporting manager is required.',
                'reportingmanager.max' => 'Reporting manager must not exceed 255 characters.',
                'dob.required' => 'Date of birth is required.',
                'dob.date' => 'Date of birth must be a valid date.',
                'lastworkingday.required' => 'Last working day is required.',
                'lastworkingday.date' => 'Last working day must be a valid date.',
                'officialemail.required' => 'Official email is required.',
                'officialemail.email' => 'Official email must be a valid email address.',
                'officialemail.max' => 'Official email must not exceed 255 characters.',
                'joiningdate.required' => 'Joining date is required.',
                'joiningdate.date' => 'Joining date must be a valid date.',
                'personalemail.required' => 'Personal email is required.',
                'personalemail.email' => 'Personal email must be a valid email address.',
                'personalemail.max' => 'Personal email must not exceed 255 characters.',
                'higestqualification.required' => 'Highest qualification is required.',
                'higestqualification.max' => 'Highest qualification must not exceed 255 characters.',
                'contactdetails.required' => 'Contact details is required.',
                'contactdetails.max' => 'Contact details must not exceed 255 characters.',
                'aadharnumber.required' => 'Aadhar number is required.',
                'aadharnumber.max' => 'Aadhar number must not exceed 255 characters.',

            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $empId = $request->input('empId');
        $emergencycontact = $request->input('emergencycontact');
        $pannumber = $request->input('pannumber');
        $name = $request->input('name');
        $currentaddress = $request->input('currentaddress');
        $trainingcompletion = $request->input('trainingcompletion');
        $department = $request->input('userDepartment');
        $permanentaddress = $request->input('permanentaddress');
        $comnpanyexperience = $request->input('comnpanyexperience');
        $designation = $request->input('userDesignation');
        $city = $request->input('city');
        $employeestatus = $request->input('employeestatus');
        $reportingmanager = $request->input('reportingmanager');
        $dob = $request->input('dob');
        $lastworkingday = $request->input('lastworkingday');
        $officialemail = $request->input('officialemail');
        $joiningdate = $request->input('joiningdate');
        $personalemail = $request->input('personalemail');
        $higestqualification = $request->input('higestqualification');
        $contactdetails = $request->input('contactdetails');
        $aadharnumber = $request->input('aadharnumber');


        $addEmployee = employees::create([
            'empId' => $empId,
            'emergencycontact' => $emergencycontact,
            'pannumber' => $pannumber,
            'name' => $name,
            'currentaddress' => $currentaddress,
            'trainingcompletion' => $trainingcompletion,
            'department' => $department,
            'permanentaddress' => $permanentaddress,
            'comnpanyexperience' => $comnpanyexperience,
            'designation' => $designation,
            'city' => $city,
            'employeestatus' => $employeestatus,
            'reportingmanager' => $reportingmanager,
            'dob' => $dob,
            'lastworkingday' => $lastworkingday,
            'officialemail' => $officialemail,
            'joiningdate' => $joiningdate,
            'personalemail' => $personalemail,
            'higestqualification' => $higestqualification,
            'contactdetails' => $contactdetails,
            'aadharnumber' => $aadharnumber,
        ]);


        if ($addEmployee) {
            $status = "Employee added successfully!";
            return redirect('/employeeView')->with('status', $status);
        } else {
            $status = "Failed to add Employee!";
            return redirect()->back()->with('status', $status);
        }
    }

<<<<<<< HEAD
=======
    // public function employeeView()
    // {
    //     $modules = Session::get('user_modules_' . auth()->id());
    //     $employeeData = employees::paginate(15);
    //     return view('Employee-view', ['modules' => $modules, 'employeeData' => $employeeData]);
    // }
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
    public function employeeView()
    {
        if (Auth::user()->status == 0) {

            $modules = Session::get('user_modules_' . auth()->id());
            $employeeData = employees::paginate(15);
            return view('Employee-view', ['modules' => $modules, 'employeeData' => $employeeData]);
        }
        if (Auth::user()->userDesignation == 'Project Manager') {
            $employeeDetails = employees::paginate(15);


            return view("users.employee_viewPm", [
                'employeeData' => $employeeDetails

            ]);
        } else {
            return redirect()->back()->with('error', 'You are Not Authorized');
        }
    }
    // public function employeeViewPm()
    // {

    //     // dd('hlw');
    //     // $modules = Session::get('user_modules_' . auth()->id());
    //     $employeeData = employees::paginate(15);
    //     return view('Employee-view', ['employeeData' => $employeeData]);
    // }


    public function employeeSearch(Request $request)
    {
        $modules = Session::get('user_modules_' . auth()->id());
        $search = $request->input('search');
        $filterData = employees::where('empId', 'LIKE', '%' . $search . '%')
            ->orWhere('name', 'LIKE', '%' . $search . '%')
            ->orWhere('designation', 'LIKE', '%' . $search . '%')
            ->get();

        return view('Employee-searchView', ['modules' => $modules, 'filterData' => $filterData]);
    }
    public function deleteSelected(Request $request)
    {
        $selectedEmployeeIds = explode(',', $request->input('selectedEmployeeIds'));
        employees::whereIn('id', $selectedEmployeeIds)->delete();
        return redirect()->back()->with('success', 'Selected employees have been deleted successfully.');
    }


    public function employeeFind()
    {
        $modules = Session::get('user_modules_' . auth()->id());
        return view('Findemployee', ['modules' => $modules]);
    }
    public function FindEmployee(Request $request)
    {
        $modules = Session::get('user_modules_' . auth()->id());
        $search = $request->input('search');
        $employees = employees::where('empId', 'LIKE', '%' . $search . '%')
            ->orWhere('name', 'LIKE', '%' . $search . '%')
            ->orWhere('designation', 'LIKE', '%' . $search . '%')
            ->paginate(15);

        return view('searchView', ['employees' => $employees, 'modules' => $modules]);
    }
    // public function searchEmployee(Request $request){
    //     $modules = Session::get('user_modules_' . auth()->id());
    //     $search = $request->input('search');
    //     $employees = employees::where('empId', 'LIKE', '%' . $search . '%')
    //         ->orWhere('name', 'LIKE', '%' . $search . '%')
    //         ->orWhere('designation', 'LIKE', '%' . $search . '%')
    //         ->paginate(15);

    //     // return view('Employee-view', compact('employees'))->render();
    //     return view('Employee-view', compact('employees'))->render();


    // }
    //     public function search(Request $request)
    // {
    //     $query = employees::query();

    //     if ($request->has('search') && $request->search != '') {
    //         $searchTerm = $request->search;
    //         $query->where('name', 'LIKE', "%{$searchTerm}%")
    //               ->orWhere('empId', 'LIKE', "%{$searchTerm}%")
    //               ->orWhere('officialemail', 'LIKE', "%{$searchTerm}%");
    //     }

    //     $employees = $query->get();

    //     $data = $employees->map(function ($employee, $index) {
    //         return [
    //             'id' => $employee->id,
    //             'empId' => $employee->empId,
    //             'name' => $employee->name,
    //             'department' => $employee->getDepartmentName(),
    //             'designation' => $employee->designation,
    //             'reportingmanager' => $employee->reportingmanager,
    //             'officialemail' => $employee->officialemail,
    //             'personalemail' => $employee->personalemail,
    //         ];
    //     });

    //     return response()->json(['data' => $data]);
    // }
    // public function fetchEmployeeDetails($searchQuery)
    // {
    //     // dd($searchQuery);
    //     // Sanitize and validate the search query
    //     $searchQuery = trim($searchQuery);
    //     // dd($searchQuery);
    //     // Perform the search query (adjust based on your Employee model structure)
    //     $employees = employees::where('name', 'LIKE', "%{$searchQuery}%")
    //         ->orWhere('empId', 'LIKE', "%{$searchQuery}%")
    //         ->orWhere('officialemail', 'LIKE', "%{$searchQuery}%")
    //         ->orWhere('personalemail', 'LIKE', "%{$searchQuery}%")
    //         ->orWhere('designation', 'LIKE', "%{$searchQuery}%")
    //         ->get(['id', 'empId', 'name', 'designation', 'department', 'reportingmanager', 'officialemail', 'personalemail']);
    //     // dd($employees);
    //     // Return the results as JSON
    //     return response()->json($employees);
    // }
    // public function fetchEmployeeDetails($searchQuery)
    // {
    //     // Log the search query
    //     Log::info('Search query received: ' . $searchQuery);

    //     // Perform the search query
    //     $employees = employees::where('name', 'LIKE', "%{$searchQuery}%")
    //         ->orWhere('empId', 'LIKE', "%{$searchQuery}%")
    //         ->orWhere('officialemail', 'LIKE', "%{$searchQuery}%")
    //         ->orWhere('personalemail', 'LIKE', "%{$searchQuery}%")
    //         ->orWhere('designation', 'LIKE', "%{$searchQuery}%")
    //         ->get(['id', 'empId', 'name', 'designation', 'department', 'reportingmanager', 'officialemail', 'personalemail']);

    //     // Log the results
    //     Log::info('Employees found: ', $employees->toArray());

    //     // Return the results as JSON
    //     return response()->json($employees);
    // }
    // use App\Models\Employee; // Import this at the top of the controller file

    // public function fetchEmployeeDetails($searchQuery)
    // {
    //     dd($searchQuery);
    //     // try {
    //     //     Log::info('Search query received: ' . $searchQuery);

    //     //     // Fix the model reference
    //     //     $employees = employees::where('name', 'LIKE', "%{$searchQuery}%")
    //     //         ->orWhere('empId', 'LIKE', "%{$searchQuery}%")
    //     //         ->orWhere('officialemail', 'LIKE', "%{$searchQuery}%")
    //     //         ->orWhere('personalemail', 'LIKE', "%{$searchQuery}%")
    //     //         ->orWhere('designation', 'LIKE', "%{$searchQuery}%")
    //     //         ->get(['id', 'empId', 'name', 'designation', 'department', 'reportingmanager', 'officialemail', 'personalemail']);

    //     //     Log::info('Employees found: ', $employees->toArray());
    //     //     echo ('<pre>');
    //     //     print_r($employees);
    //     //     echo ('</pre>');
    //     //     die();


    //     //     return response()->json($employees);

    //     // } catch (QueryException $e) {
    //     //     Log::error('Database query error: ' . $e->getMessage());
    //     //     return response()->json(['error' => 'An error occurred while fetching employee details.'], 500);

    //     // } catch (\Exception $e) {
    //     //     Log::error('General error: ' . $e->getMessage());
    //     //     return response()->json(['error' => 'An unexpected error occurred.'], 500);
    //     // }
    // }
    public function fetchDetails(Request $request)
    {
        $status = $request->input('status');
        if ($status === '') {
            return response()->json(['data' => []]);
        }
        $fetchDetails = employees::where('employeestatus', $status)->get();
        $data = $fetchDetails->map(function ($employee) {
            return [
                'id' => $employee->id,
                'empId' => $employee->empId,
                'name' => $employee->name,
                'department' => $employee->getDepartmentName(),
                'designation' => $employee->designation,
                'reportingmanager' => $employee->reportingmanager,
                'officialemail' => $employee->officialemail,
                'personalemail' => $employee->personalemail
            ];
        });

        return response()->json(['data' => $data]);
    }
    // public function fetchEmployeeDetailsAjax(Request $request)
    // {
    //     $searchQuery = $request->input('search');

    //     $employees = employees::where('name', 'like', '%' . $searchQuery . '%')
    //         ->orWhere('empId', 'like', '%' . $searchQuery . '%')
    //         ->orWhere('department', 'like', '%' . $searchQuery . '%')
    //         ->orWhere('designation', 'like', '%' . $searchQuery . '%')
    //         ->orWhere('name', 'like', '%' . $searchQuery . '%')
    //         ->orWhere('officialemail', 'like', '%' . $searchQuery . '%')
    //         ->orWhere('personalemail', 'like', '%' . $searchQuery . '%')
    //         ->get();

    //     // Return JSON response
    //     // print_r($employees);
    //     // die();
    //     return response()->json(['data' => $employees]);
    // }
    public function fetchEmployeeDetailsAjax(Request $request)
    {
        $searchQuery = $request->input('search');

        $employees = employees::where('name', 'like', '%' . $searchQuery . '%')
            ->orWhere('empId', 'like', '%' . $searchQuery . '%')
            ->orWhere('department', 'like', '%' . $searchQuery . '%')
            ->orWhere('designation', 'like', '%' . $searchQuery . '%')
            ->orWhere('officialemail', 'like', '%' . $searchQuery . '%')
            ->orWhere('personalemail', 'like', '%' . $searchQuery . '%')
            ->get();

        // Map employees to modify the department value
        $employees = $employees->map(function ($employee) {
            return [
                'id' => $employee->id,
                'empId' => $employee->empId,
                'name' => $employee->name,
                'department' => $employee->getDepartmentName(),
                'designation' => $employee->designation,
                'officialemail' => $employee->officialemail,
                'personalemail' => $employee->personalemail,
                'reportingmanager' => $employee->reportingmanager,
            ];
        });

        return response()->json(['data' => $employees]);
    }




    public function fetchDetails(Request $request)
    {
        $status = $request->input('status');
        if ($status === '') {
            return response()->json(['data' => []]);
        }
        $fetchDetails = employees::where('employeestatus', $status)->get();

        $data = $fetchDetails->map(function ($employee) {
            return [
                'id' => $employee->id,
                'empId' => $employee->empId,
                'name' => $employee->name,
                'department' => $employee->getDepartmentName(),
                'designation' => $employee->designation,
                'reportingmanager' => $employee->reportingmanager,
                'officialemail' => $employee->officialemail,
                'personalemail' => $employee->personalemail
            ];
        });

        return response()->json(['data' => $data]);
    }


    public function fetchEmployeeDetailsAjax(Request $request)
    {
        $searchQuery = $request->input('search');

        $employees = employees::where('name', 'like', '%' . $searchQuery . '%')
            ->orWhere('empId', 'like', '%' . $searchQuery . '%')
            ->orWhere('department', 'like', '%' . $searchQuery . '%')
            ->orWhere('designation', 'like', '%' . $searchQuery . '%')
            ->orWhere('officialemail', 'like', '%' . $searchQuery . '%')
            ->orWhere('personalemail', 'like', '%' . $searchQuery . '%')
            ->get();

        $employees = $employees->map(function ($employee) {
            return [
                'id' => $employee->id,
                'empId' => $employee->empId,
                'name' => $employee->name,
                'department' => $employee->getDepartmentName(),
                'designation' => $employee->designation,
                'officialemail' => $employee->officialemail,
                'personalemail' => $employee->personalemail,
                'reportingmanager' => $employee->reportingmanager,
            ];
        });

        return response()->json(['data' => $employees]);
    }

    public function ViewDetailsEmployee($id)
    {
        $employeeData = employees::find($id);
        $modules = Session::get('user_modules_' . auth()->id());
        return view('viewDetailsEmployee', ['modules' => $modules, 'employeeData' => $employeeData]);
    }

    public function employeeUpdate($id)
    {
        $modules = Session::get('user_modules_' . auth()->id());
        $updateId = $id;
        $employeeData =   employees::where('id', $updateId)->get();
        return view('employeeDataUpdate', ['modules' => $modules, 'employeeData' => $employeeData]);
    }
    public function employeeUpdateStore(Request $request)
    {

        $EmployeeId = $request->input('id');
        $validator = Validator::make(
            $request->all(),
            [
                'empId' => 'required|max:255|unique:employees,empId,' . $EmployeeId,
                'emergencycontact' => 'required|numeric',
                'pannumber' => 'required',
                'name' => 'required|string|max:255',
                'currentaddress' => 'required|max:255',
                'userDepartment' => 'required|string|max:255',
                'permanentaddress' => 'required|string|max:255',
                'comnpanyexperience' => 'required|numeric',
                'userDesignation' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                // 'employeestatus' => 'required|string|in:active,inactive',
                'employeestatus' => 'required|string|in:0,1',

                'reportingmanager' => 'required|string|max:255',
                'dob' => 'required|date',
                'lastworkingday' => 'required|date',
                'officialemail' => 'required|email|max:255',
                'joiningdate' => 'required|date',
                'personalemail' => 'required|email|max:255',
                'higestqualification' => 'required|string|max:255',
                'contactdetails' => 'required|string|max:255',
                'aadharnumber' => 'required|string|max:255',
            ],
            [
                'empId.required' => 'Employee ID is required.',
                'empId.unique' => 'Employee ID must be unique.',
                'empId.max' => 'Employee ID must not exceed 255 characters.',
                'emergencycontact.required' => 'Emergency contact is required.',
                'emergencycontact.numeric' => 'Emergency contact must be a numeric value.',
                'pannumber.required' => 'PAN number is required.',
                'name.required' => 'Name is required.',
                'name.max' => 'Name must not exceed 255 characters.',
                'currentaddress.required' => 'Current address is required.',
                'currentaddress.max' => 'Current address must not exceed 255 characters.',
                'trainingcompletion.max' => 'Training completion must not exceed 255 characters.',
                'userDepartment.required' => 'Department is required.',
                'permanentaddress.required' => 'Permanent address is required.',
                'permanentaddress.max' => 'Permanent address must not exceed 255 characters.',
                'comnpanyexperience.required' => 'Company experience is required.',
                'comnpanyexperience.numeric' => 'Company experience must be a numeric value.',
                'userDesignation.required' => 'Designation is required.',
                'city.required' => 'City is required.',
                'city.max' => 'City must not exceed 255 characters.',
                'employeestatus.required' => 'Employee status is required.',
                // 'employeestatus.in' => 'Employee status must be either Active or Inactive.',
                'reportingmanager.required' => 'Reporting manager is required.',
                'reportingmanager.max' => 'Reporting manager must not exceed 255 characters.',
                'dob.required' => 'Date of birth is required.',
                'dob.date' => 'Date of birth must be a valid date.',
                'lastworkingday.required' => 'Last working day is required.',
                'lastworkingday.date' => 'Last working day must be a valid date.',
                'officialemail.required' => 'Official email is required.',
                'officialemail.email' => 'Official email must be a valid email address.',
                'officialemail.max' => 'Official email must not exceed 255 characters.',
                'joiningdate.required' => 'Joining date is required.',
                'joiningdate.date' => 'Joining date must be a valid date.',
                'personalemail.required' => 'Personal email is required.',
                'personalemail.email' => 'Personal email must be a valid email address.',
                'personalemail.max' => 'Personal email must not exceed 255 characters.',
                'higestqualification.required' => 'Highest qualification is required.',
                'higestqualification.max' => 'Highest qualification must not exceed 255 characters.',
                'contactdetails.required' => 'Contact details is required.',
                'contactdetails.max' => 'Contact details must not exceed 255 characters.',
                'aadharnumber.required' => 'Aadhar number is required.',
                'aadharnumber.max' => 'Aadhar number must not exceed 255 characters.',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $EmployeeId = $request->input('id');
        $empId = $request->input('empId');
        $emergencycontact = $request->input('emergencycontact');
        $pannumber = $request->input('pannumber');
        $name = $request->input('name');
        $currentaddress = $request->input('currentaddress');
        $trainingcompletion = $request->input('trainingcompletion');
        $department = $request->input('userDepartment');
        $permanentaddress = $request->input('permanentaddress');
        $comnpanyexperience = $request->input('comnpanyexperience');
        $designation = $request->input('userDesignation');
        $city = $request->input('city');
        $employeestatus = $request->input('employeestatus');
        $reportingmanager = $request->input('reportingmanager');
        $dob = $request->input('dob');
        $lastworkingday = $request->input('lastworkingday');
        $officialemail = $request->input('officialemail');
        $joiningdate = $request->input('joiningdate');
        $personalemail = $request->input('personalemail');
        $higestqualification = $request->input('higestqualification');
        $contactdetails = $request->input('contactdetails');
        $aadharnumber = $request->input('aadharnumber');
        $employee = employees::findOrFail($EmployeeId);
        $employee->update([
            'empId' => $empId,
            'emergencycontact' => $emergencycontact,
            'pannumber' => $pannumber,
            'name' => $name,
            'currentaddress' => $currentaddress,
            'trainingcompletion' => $trainingcompletion,
            'department' => $department,
            'permanentaddress' => $permanentaddress,
            'comnpanyexperience' => $comnpanyexperience,
            'designation' => $designation,
            'city' => $city,
            'employeestatus' => $employeestatus,
            'reportingmanager' => $reportingmanager,
            'dob' => $dob,
            'lastworkingday' => $lastworkingday,
            'officialemail' => $officialemail,
            'joiningdate' => $joiningdate,
            'personalemail' => $personalemail,
            'higestqualification' => $higestqualification,
            'contactdetails' => $contactdetails,
            'aadharnumber' => $aadharnumber,
        ]);

        return redirect()->route('employeeView')->with('success', 'Employee data updated successfully.');
    }

<<<<<<< HEAD
    // public function employeeAllcation($id){
    //     // dd('here');
    //     $EmployeeId = $id;
    //     dd($EmployeeId);

    // }
    // public function employeeAllcation($id) {
    //     $modules = Session::get('user_modules_' . auth()->id());

    //     $currentAllocation = AddworkesEmployee::where('employee_id', $id)
    //                                  ->where('is_deleted', 0)->with('project')->get();


    //     $pmEmployeeIds = $currentAllocation->pluck('project.pmemployeeId');
    //     dd($pmEmployeeIds);

    //     // $pmName = employees::where('id',$pmEmployeeIds)->get();

    //      $pastallocation = AddworkesEmployee::where('employee_id', $id)
    //                                  ->where('is_deleted', 1)->with('project')->get();

    //     return view('allocation',compact('currentAllocation','pastallocation','modules'));
    // }
    // public function employeeAllcation($id) {
    //     $modules = Session::get('user_modules_' . auth()->id());

    //     // Fetch current allocations
=======


    // public function employeeAllcation($id)
    // {
    //     $modules = Session::get('user_modules_' . auth()->id());
    //     $employeeName = employees::where('id', $id)->pluck('name');
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
    //     $currentAllocation = AddworkesEmployee::where('employee_id', $id)
    //         ->where('is_deleted', 0)
    //         ->with('project')
    //         ->get();

<<<<<<< HEAD
    //     // Extract unique pmEmployeeIds from the currentAllocation
    //     $pmEmployeeIds = $currentAllocation->pluck('project.pmemployeeId')->unique()->filter();

    //     // Fetch employee details using the extracted pmEmployeeIds
    //     $pmNames = employees::whereIn('id', $pmEmployeeIds)->get()->keyBy('id')->pluck();
    // dd($pmNames);
    // $pmName
    //     // Fetch past allocations
=======
    //     $pmEmployeeIds = $currentAllocation->pluck('project.pmemployeeId')->unique()->filter();

    //     $pmNames = employees::whereIn('id', $pmEmployeeIds)->get()->keyBy('id');

>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
    //     $pastallocation = AddworkesEmployee::where('employee_id', $id)
    //         ->where('is_deleted', 1)
    //         ->with('project')
    //         ->get();

<<<<<<< HEAD
    //     // Pass data to the view
    //     return view('allocation', compact('currentAllocation', 'pastallocation', 'modules', 'pmNames'));
=======
    //     return view('allocation', compact('currentAllocation', 'pastallocation', 'modules', 'pmNames', 'employeeName'));
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
    // }
    public function employeeAllcation($id)
    {
        if (Auth::user()->status == 0) {

            $modules = Session::get('user_modules_' . auth()->id());
            $employeeName = employees::where('id', $id)->pluck('name');
            $currentAllocation = AddworkesEmployee::where('employee_id', $id)
                ->where('is_deleted', 0)
                ->with('project')
                ->get();

            $pmEmployeeIds = $currentAllocation->pluck('project.pmemployeeId')->unique()->filter();

            $pmNames = employees::whereIn('id', $pmEmployeeIds)->get()->keyBy('id');

            $pastallocation = AddworkesEmployee::where('employee_id', $id)
                ->where('is_deleted', 1)
                ->with('project')
                ->get();

            return view('allocation', compact('currentAllocation', 'pastallocation', 'modules', 'pmNames', 'employeeName'));
        } elseif (Auth::user()->status === 1) {
            if (Auth::user()->userDesignation == 'Project Manager') {
                $employeeName = employees::where('id', $id)->pluck('name');
                $currentAllocation = AddworkesEmployee::where('employee_id', $id)
                ->where('is_deleted', 0)
                ->with('project')
                ->get();
                
                $pmEmployeeIds = $currentAllocation->pluck('project.pmemployeeId')->unique()->filter();
                
                $pmNames = employees::whereIn('id', $pmEmployeeIds)->get()->keyBy('id');
                
                $pastallocation = AddworkesEmployee::where('employee_id', $id)
                ->where('is_deleted', 1)
                ->with('project')
                ->get();
                // dd('here');
                return view('users.allocationPm', compact('currentAllocation', 'pastallocation',  'pmNames', 'employeeName'));
            }
        }
    }

<<<<<<< HEAD

=======
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
    public function employeeimportCSV(Request $request)
    {
        // Validation rules
        $request->validate([
<<<<<<< HEAD
            // 'file' => 'required|file|mimes:csv,txt|max:2048', // Validate file is a CSV and size is within limit
            'file' => 'required|file|mimes:csv,txt|max:2048', // Validate file is a CSV or TXT and size is within limit

        ]);

        // Department mapping
        $departmentMap = [
            'Delivery' => 0,
            // Add other departments if needed
=======
            'file' => 'required|file|mimes:csv,txt|max:2048',

        ]);

        $departmentMap = [
            'Delivery' => 0,
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
        ];

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $fileTempName = $file->getPathname();

        $skipHeader = true;

        // Check if file is a CSV
        if (pathinfo($fileName, PATHINFO_EXTENSION) !== 'csv') {
            return redirect()->back()->withErrors('The file must be a CSV.')->withInput();
        }

        $handle = fopen($fileTempName, 'r');

        // Validate CSV columns (assuming you expect 21 columns based on your code)
        $expectedColumnCount = 21;

        while (($line = fgetcsv($handle)) !== false) {
            if (empty($line)) {
                continue;
            } elseif ($skipHeader) {
                $skipHeader = false;
                continue;
            }

            // Check if the line has the expected number of columns
            if (count($line) !== $expectedColumnCount) {
                fclose($handle);
                return redirect()->back()->withErrors('The CSV file does not have the expected number of columns.')->withInput();
            }

            // Map department using departmentMap
            $department = isset($departmentMap[$line[6]]) ? $departmentMap[$line[6]] : null;

            // Validate dates and Aadhaar number (additional validation can be added)
            $dob = date('Y-m-d', strtotime(str_replace('-', '/', $line[13])));
            $lastWorkingDay = date('Y-m-d', strtotime(str_replace('-', '/', $line[14])));
            $joiningDate = date('Y-m-d', strtotime(str_replace('-', '/', $line[16])));
            $aadharnumber = $line[20];

            // Insert or update employee record
            employees::create([
                'empId' => !empty($line[0]) ? $line[0] : '',
                'emergencycontact' => $line[1],
                'pannumber' => $line[2],
                'name' => $line[3],
                'currentaddress' => $line[4],
                'trainingcompletion' => $line[5],
                'department' => $department,
                'permanentaddress' => $line[7],
                'comnpanyexperience' => (int) $line[8],
                'designation' => $line[9],
                'city' => $line[10],
                'employeestatus' => $line[11],
                'reportingmanager' => $line[12],
                'dob' => $dob,
                'lastworkingday' => $lastWorkingDay,
                'officialemail' => $line[15],
                'joiningdate' => $joiningDate,
                'personalemail' => $line[17],
                'higestqualification' => $line[18],
                'contactdetails' => $line[19],
                'aadharnumber' => $aadharnumber,
            ]);
        }

        fclose($handle);

        return redirect()->back()->with('status', 'Employees imported successfully.');
    }







    public function employeeExportCSV()
    {
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=employees.csv");
        header("Pragma: no-cache");
        header("Expires: 0");

        $departmentMapping = [
            0 => 'Delivery',
        ];

        $allUsers = Employees::all();
        error_log("Total records fetched: " . count($allUsers));

        $columns = [
            'empId',
            'emergencycontact',
            'pannumber',
            'name',
            'currentaddress',
            'trainingcompletion',
            'department',
            'permanentaddress',
            'comnpanyexperience',
            'designation',
            'city',
            'employeestatus',
            'reportingmanager',
            'dob',
            'lastworkingday',
            'officialemail',
            'joiningdate',
            'personalemail',
            'higestqualification',
            'contactdetails',
            'aadharnumber'
        ];

        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach ($allUsers as $employee) {
            $department = isset($departmentMapping[$employee->department]) ? $departmentMapping[$employee->department] : '';

            if (empty($department)) {
                $department = 'Delivery';
            }

            fputcsv($file, [
                $employee->empId,
                $employee->emergencycontact,
                $employee->pannumber,
                $employee->name,
                $employee->currentaddress,
                $employee->trainingcompletion,
                $department,
                $employee->permanentaddress,
                $employee->comnpanyexperience,
                $employee->designation,
                $employee->city,
                $employee->employeestatus,
                $employee->reportingmanager,
                $employee->dob,
                $employee->lastworkingday,
                $employee->officialemail,
                $employee->joiningdate,
                $employee->personalemail,
                $employee->higestqualification,
                $employee->contactdetails,
                $employee->aadharnumber,
            ]);
        }

        fclose($file);
        exit();
    }
}
