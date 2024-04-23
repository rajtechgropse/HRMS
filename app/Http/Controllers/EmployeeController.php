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
                'userDepartment' => 'required|',
                'permanentaddress' => 'required|string|max:255',
                'comnpanyexperience' => 'required|numeric',
                'userDesignation' => 'required|',
                'city' => 'required|string|max:255',
                'employeestatus' => 'required|string|in:active,inactive',
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
                'employeestatus.in' => 'Employee status must be either active or inactive.',
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
            return redirect('/employeeView')->back()->with('status', $status);
        } else {
            $status = "Failed to add Employee!";
            return redirect()->back()->with('status', $status);
        }
    }
    public function employeeView()
    {
        $modules = Session::get('user_modules_' . auth()->id());
        $employeeData = employees::paginate(10);
        return view('Employee-view', ['modules' => $modules, 'employeeData' => $employeeData]);
    }
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
        $selectedEmployeeIds = explode(',', $request->input('selected_employee_ids'));
        employees::whereIn('id', $selectedEmployeeIds)->delete();
        return redirect()->back()->with('success', 'Selected employees have been deleted successfully.');
    }
    public function SelectedEmployeedel()
    {
        dd('delete');
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
                'department' => 'required|string|max:255',
                'permanentaddress' => 'required|string|max:255',
                'comnpanyexperience' => 'required|numeric',
                'designation' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'employeestatus' => 'required|string|in:active,inactive',
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
                'department.required' => 'Department is required.',
                'department.max' => 'Department must not exceed 255 characters.',
                'permanentaddress.required' => 'Permanent address is required.',
                'permanentaddress.max' => 'Permanent address must not exceed 255 characters.',
                'comnpanyexperience.required' => 'Company experience is required.',
                'comnpanyexperience.numeric' => 'Company experience must be a numeric value.',
                'designation.required' => 'Designation is required.',
                'designation.max' => 'Designation must not exceed 255 characters.',
                'city.required' => 'City is required.',
                'city.max' => 'City must not exceed 255 characters.',
                'employeestatus.required' => 'Employee status is required.',
                'employeestatus.in' => 'Employee status must be either active or inactive.',
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
        $department = $request->input('department');
        $permanentaddress = $request->input('permanentaddress');
        $comnpanyexperience = $request->input('comnpanyexperience');
        $designation = $request->input('designation');
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

    public function employeeimportCSV(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'file' => 'required|file|mimes:csv',
            ],
            [
                'file.required' => 'Please upload a CSV file.',
                'file.mimes' => 'The uploaded file must be a CSV file.',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $file = $request->file('file');
        $fileContents = file($file->getPathname());
        $skipHeader = true;
        foreach ($fileContents as $line) {
            if ($skipHeader) {
                $skipHeader = false;
                continue;
            }
            $data = str_getcsv($line);
            $dob = date('Y-m-d', strtotime($data[13]));
            $lastWorkingDays = date('Y-m-d', strtotime($data[14]));
            $JoiningDate = date('Y-m-d', strtotime($data[16]));
            $trainingCompletion = !empty($data[5]) ? date('Y-m-d', strtotime($data[5])) : null;


            employees::create([
                'empId' => $data[0],
                'emergencycontact' => $data[1],
                'pannumber' => $data[2],
                'name' => $data[3],
                'currentaddress' => $data[4],
                'trainingcompletion' => $data[5],
                'department' => $data[6],
                'permanentaddress' => $data[7],
                'comnpanyexperience' => (int) $data[8],
                'designation' => $data[9],
                'city' => $data[10],
                'employeestatus' => $data[11],
                'reportingmanager' => $data[12],
                'dob' => $dob,
                'lastworkingday' => $lastWorkingDays,
                'officialemail' => $data[15],
                'joiningdate' => $JoiningDate,
                'personalemail' => $data[17],
                'higestqualification' => $data[18],
                'contactdetails' => $data[19],
                'aadharnumber' => $data[20],
            ]);
        }
        return redirect()->back()->with('success', 'Employees imported successfully.');
    }

    public function employeeExportCSV()
    {
        $allUsers = employees::all();
        $csvFileName = 'products.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['empId', 'emergencycontact', 'pannumber', 'name', 'currentaddress', 'trainingcompletion', 'department', 'permanentaddress', 'comnpanyexperience', 'designation', 'city', 'employeestatus', 'reportingmanager', 'dob', 'lastworkingday', 'officialemail', 'joiningdate', 'personalemail', 'higestqualification', 'contactdetails', 'aadharnumber',]); // Add more headers as needed
        foreach ($allUsers as $product) {
            fputcsv($handle, [$product->empId, $product->emergencycontact, $product->pannumber, $product->name, $product->currentaddress, $product->trainingcompletion, $product->department, $product->permanentaddress, $product->comnpanyexperience, $product->designation, $product->city, $product->employeestatus, $product->reportingmanager, $product->dob, $product->lastworkingday, $product->officialemail, $product->joiningdate, $product->personalemail, $product->higestqualification, $product->contactdetails, $product->aadharnumber]); // Add more fields as needed
        }

        fclose($handle);
        return Response::make('', 200, $headers);
    }
}
