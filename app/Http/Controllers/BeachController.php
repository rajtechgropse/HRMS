<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Models\addworkesEmployee;
use App\Models\TimeEntry;
use App\Models\employees;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;




class BeachController extends Controller
{

    public function getPercenctByBeach($ids)
    {
        $employeeIds = is_array($ids) ? $ids : explode(',', $ids);
        $modules = Session::get('user_modules_' . auth()->id());

        $today = Carbon::now()->startOfDay();
        $allBeachDetails = [];
        $totalBeachPercentage = 0;
        $eligibleDaysCount = 0;

        foreach ($employeeIds as $employeeId) {
            $allocations = addworkesEmployee::where('employee_Id', $employeeId)
                ->orderBy('startdate')
                ->get();

            $dateAllocations = [];

            foreach ($allocations as $allocation) {
                $startDate = Carbon::parse($allocation->startdate);
                $endDate = Carbon::parse($allocation->enddate);
                $percentage = $allocation->allocationpercentage;

                for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                    if ($date->lte($today)) {
                        $dateKey = $date->toDateString();
                        if (!isset($dateAllocations[$dateKey])) {
                            $dateAllocations[$dateKey] = 0;
                        }
                        $dateAllocations[$dateKey] += $percentage;
                    }
                }
            }

            foreach ($dateAllocations as $date => $totalAllocation) {
                if ($totalAllocation < 100) {
                    $beachPercentage = 100 - $totalAllocation;
                    $allBeachDetails[] = [
                        'employee_id' => $employeeId,
                        'date' => $date,
                        'beach_percentage' => $beachPercentage,
                    ];

                    $totalBeachPercentage += $beachPercentage;
                    $eligibleDaysCount++;
                }
            }
        }

        $averageBeachPercentage = $eligibleDaysCount > 0
            ? $totalBeachPercentage / $eligibleDaysCount
            : 0;

        return [
            'beach_details' => $allBeachDetails,
            'average_beach_percentage' => $averageBeachPercentage,
        ];
    }
    public function beachDetails()
    {
        $modules = Session::get('user_modules_' . auth()->id());
        $allDetails = employees::where('employeestatus', 0)->get();


        $averageBeachDetails = [];

        foreach ($allDetails as $employee) {
            $beachData = $this->getPercenctByBeach($employee->id);

            $averageBeachDetails[] = [
                'employee_id' => $employee->id,
                'employee_name' => $employee->name,
                'average_beach_percentage' => $beachData['average_beach_percentage'] ?? 0,
                'beach_details' => $beachData['beach_details'],
            ];
        }

        return view('beachDetailsView', compact('allDetails', 'modules', 'averageBeachDetails'));
    }
    public function getBeachDetailsForAllEmployees($ids)
    {
        $employeeIds = is_array($ids) ? $ids : explode(',', $ids);
        $modules = Session::get('user_modules_' . auth()->id());

        $today = Carbon::now()->startOfDay();
        $allBeachDetails = [];
        $totalBeachPercentage = 0;
        $eligibleDaysCount = 0;

        foreach ($employeeIds as $employeeId) {
            $allocations = addworkesEmployee::where('employee_Id', $employeeId)
                ->orderBy('startdate')
                ->get();

            $dateAllocations = [];

            foreach ($allocations as $allocation) {
                $startDate = Carbon::parse($allocation->startdate);
                $endDate = Carbon::parse($allocation->enddate);
                $percentage = $allocation->allocationpercentage;

                for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                    if ($date->lte($today)) {
                        $dateKey = $date->toDateString();
                        if (!isset($dateAllocations[$dateKey])) {
                            $dateAllocations[$dateKey] = 0;
                        }
                        $dateAllocations[$dateKey] += $percentage;
                    }
                }
            }

            foreach ($dateAllocations as $date => $totalAllocation) {
                if ($totalAllocation < 100) {
                    $beachPercentage = 100 - $totalAllocation;
                    $allBeachDetails[] = [
                        'employee_id' => $employeeId,
                        'date' => $date,
                        'beach_percentage' => $beachPercentage,
                    ];

                    $totalBeachPercentage += $beachPercentage;
                    $eligibleDaysCount++;
                }
            }
        }


        $averageBeachPercentage = $eligibleDaysCount > 0
            ? $totalBeachPercentage / $eligibleDaysCount
            : 0;


        return view('beach-details', [
            'beachDetails' => $allBeachDetails,
            'averageBeachPercentage' => $averageBeachPercentage,
            'modules' => $modules
        ]);
    }
    // public function beachDetailsajax(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'employee_id' => 'required|exists:employees,id',
    //         'start_date' => 'required|date|date_format:Y-m-d|before_or_equal:end_date',
    //         'end_date' => 'required|date|date_format:Y-m-d',
    //     ], [
    //         'employee_id.required' => 'Employee ID is required.',
    //         'employee_id.exists' => 'The selected employee does not exist.',
    //         'start_date.required' => 'Start date is required.',
    //         'start_date.date' => 'Start date must be a valid date.',
    //         'start_date.date_format' => 'Start date must be in YYYY-MM-DD format.',
    //         'start_date.before_or_equal' => 'Start date must be before or equal to the end date.',
    //         'end_date.required' => 'End date is required.',
    //         'end_date.date' => 'End date must be a valid date.',
    //         'end_date.date_format' => 'End date must be in YYYY-MM-DD format.',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'errors' => $validator->errors(),
    //         ], 400);
    //     }



    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');
    //     $employeeIds = $request->input('employee_id');


    //     $allDetails = employees::where('employeestatus', 0)->where('id', $employeeIds)->get();


    //     $averageBeachDetails = [];

    //     foreach ($allDetails as $employee) {
    //         $beachData = $this->getPercenctByBeachAjax($employee->id);

    //         $averageBeachDetails[] = [
    //             'employee_id' => $employee->id,
    //             'employee_name' => $employee->name,
    //             'average_beach_percentage' => $beachData['average_beach_percentage'] ?? 0,
    //             'beach_details' => $beachData['beach_details'],
    //             'startDate' => $startDate,
    //             'endDate' => $endDate,
    //         ];
    //     }
       
    // }
    // public function getPercenctByBeachAjax($ids)
    // {
    //     $employeeIds = is_array($ids) ? $ids : explode(',', $ids);

    //     $today = Carbon::now()->startOfDay();

    //     $allBeachDetails = [];
    //     $totalBeachPercentage = 0;
    //     $eligibleDaysCount = 0;

    //     foreach ($employeeIds as $employeeId) {
    //         $allocations = addworkesEmployee::where('employee_Id', $employeeId)
    //             ->orderBy('startdate')
    //             ->get();

    //         $dateAllocations = [];

    //         foreach ($allocations as $allocation) {
    //             $startDate = Carbon::parse($allocation->startdate);
    //             $endDate = Carbon::parse($allocation->enddate);
    //             $percentage = $allocation->allocationpercentage;

    //             for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
    //                 if ($date->lte($today)) {
    //                     $dateKey = $date->toDateString();
    //                     if (!isset($dateAllocations[$dateKey])) {
    //                         $dateAllocations[$dateKey] = 0;
    //                     }
    //                     $dateAllocations[$dateKey] += $percentage;
    //                 }
    //             }
    //         }

    //         foreach ($dateAllocations as $date => $totalAllocation) {
    //             if ($totalAllocation < 100) {
    //                 $beachPercentage = 100 - $totalAllocation;
    //                 $allBeachDetails[] = [
    //                     'employee_id' => $employeeId,
    //                     'date' => $date,
    //                     'beach_percentage' => $beachPercentage,
    //                 ];

    //                 $totalBeachPercentage += $beachPercentage;
    //                 $eligibleDaysCount++;
    //             }
    //         }
    //     }

    //     $averageBeachPercentage = $eligibleDaysCount > 0
    //         ? $totalBeachPercentage / $eligibleDaysCount
    //         : 0;

    //     return [
    //         'beach_details' => $allBeachDetails,
    //         'average_beach_percentage' => $averageBeachPercentage,
    //     ];
    // }
//     public function beachDetailsajax(Request $request)
// {
//     $validator = Validator::make($request->all(), [
//         'employee_id' => 'required|exists:employees,id',
//         'start_date' => 'required|date|date_format:Y-m-d|before_or_equal:end_date',
//         'end_date' => 'required|date|date_format:Y-m-d',
//     ], [
//         'employee_id.required' => 'Employee ID is required.',
//         'employee_id.exists' => 'The selected employee does not exist.',
//         'start_date.required' => 'Start date is required.',
//         'start_date.date' => 'Start date must be a valid date.',
//         'start_date.date_format' => 'Start date must be in YYYY-MM-DD format.',
//         'start_date.before_or_equal' => 'Start date must be before or equal to the end date.',
//         'end_date.required' => 'End date is required.',
//         'end_date.date' => 'End date must be a valid date.',
//         'end_date.date_format' => 'End date must be in YYYY-MM-DD format.',
//     ]);

//     if ($validator->fails()) {
//         return response()->json([
//             'success' => false,
//             'errors' => $validator->errors(),
//         ], 400);
//     }

//     $startDate = Carbon::parse($request->input('start_date'));
//     $endDate = Carbon::parse($request->input('end_date'));
//     $employeeId = $request->input('employee_id');

//     // Fetch employee details
//     $employee = employees::where('employeestatus', 0)->where('id', $employeeId)->first();

//     if (!$employee) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Employee not found.',
//         ], 404);
//     }

//     $beachData = $this->getPercenctByBeachAjax($employee->id, $startDate, $endDate);

//     $averageBeachDetails = [
//         'employee_id' => $employee->id,
//         'employee_name' => $employee->name,
//         'average_beach_percentage' => $beachData['average_beach_percentage'] ?? 0,
//         'beach_details' => $beachData['beach_details'],
//         'startDate' => $startDate->toDateString(),
//         'endDate' => $endDate->toDateString(),
//     ];

//     return response()->json([
//         'success' => true,
//         'data' => $averageBeachDetails,
//     ]);
// }
// public function getPercenctByBeachAjax($employeeId, $startDate, $endDate)
// {
//     $today = Carbon::now()->startOfDay();

//     $allBeachDetails = [];
//     $totalBeachPercentage = 0;
//     $eligibleDaysCount = 0;

//     $allocations = addworkesEmployee::where('employee_Id', $employeeId)
//         ->where(function ($query) use ($startDate, $endDate) {
//             $query->whereBetween('startdate', [$startDate, $endDate])
//                   ->orWhereBetween('enddate', [$startDate, $endDate]);
//         })
//         ->orderBy('startdate')
//         ->get();

//     $dateAllocations = [];

//     foreach ($allocations as $allocation) {
//         $allocationStartDate = Carbon::parse($allocation->startdate);
//         $allocationEndDate = Carbon::parse($allocation->enddate);
//         $percentage = $allocation->allocationpercentage;

//         for ($date = $allocationStartDate; $date->lte($allocationEndDate); $date->addDay()) {
//             if ($date->lte($today) && $date->between($startDate, $endDate)) {
//                 $dateKey = $date->toDateString();
//                 if (!isset($dateAllocations[$dateKey])) {
//                     $dateAllocations[$dateKey] = 0;
//                 }
//                 $dateAllocations[$dateKey] += $percentage;
//             }
//         }
//     }

//     foreach ($dateAllocations as $date => $totalAllocation) {
//         if ($totalAllocation < 100) {
//             $beachPercentage = 100 - $totalAllocation;
//             $allBeachDetails[] = [
//                 'employee_id' => $employeeId,
//                 'date' => $date,
//                 'beach_percentage' => $beachPercentage,
//             ];

//             $totalBeachPercentage += $beachPercentage;
//             $eligibleDaysCount++;
//         }
//     }

//     $averageBeachPercentage = $eligibleDaysCount > 0
//         ? $totalBeachPercentage / $eligibleDaysCount
//         : 0;

//     return [
//         'beach_details' => $allBeachDetails,
//         'average_beach_percentage' => $averageBeachPercentage,
//     ];
// }


public function beachDetailsajax(Request $request)
{
    $validator = Validator::make($request->all(), [
        'employee_id' => 'required|exists:employees,id',
        'start_date' => 'required|date|date_format:Y-m-d|before_or_equal:end_date',
        'end_date' => 'required|date|date_format:Y-m-d',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 400);
    }

    $startDate = Carbon::parse($request->input('start_date'));
    $endDate = Carbon::parse($request->input('end_date'));
    $employeeId = $request->input('employee_id');

    // Fetch employee details
    $employee = employees::find($employeeId);
    
    if (!$employee || $employee->employeestatus != 0) {
        return response()->json([
            'success' => false,
            'message' => 'Employee not found or inactive.',
        ], 404);
    }

    $beachData = $this->getPercenctByBeachAjax($employeeId, $startDate, $endDate);

    $averageBeachDetails = [
        'employee_id' => $employee->id,
        'employee_name' => $employee->name,
        'average_beach_percentage' => $beachData['average_beach_percentage'] ?? 0,
        'beach_details' => $beachData['beach_details'],
        'startDate' => $startDate->toDateString(),
        'endDate' => $endDate->toDateString(),
    ];

    return response()->json([
        'success' => true,
        'data' => $averageBeachDetails,
    ]);
}

public function getPercenctByBeachAjax($employeeId, $startDate, $endDate)
{
    $today = Carbon::now()->startOfDay();
    $totalBeachPercentage = 0;
    $eligibleDaysCount = 0;

    // Fetch allocations within the date range
    $allocations = addworkesEmployee::where('employee_Id', $employeeId)
        ->where(function ($query) use ($startDate, $endDate) {
            $query->whereBetween('startdate', [$startDate, $endDate])
                  ->orWhereBetween('enddate', [$startDate, $endDate]);
        })
        ->orderBy('startdate')
        ->get();

    $dateAllocations = [];

    // Process each allocation
    foreach ($allocations as $allocation) {
        $allocationStartDate = Carbon::parse($allocation->startdate);
        $allocationEndDate = Carbon::parse($allocation->enddate);
        $percentage = $allocation->allocationpercentage;

        for ($date = $allocationStartDate; $date->lte($allocationEndDate); $date->addDay()) {
            if ($date->lte($today) && $date->between($startDate, $endDate)) {
                $dateKey = $date->toDateString();
                $dateAllocations[$dateKey] = ($dateAllocations[$dateKey] ?? 0) + $percentage;
            }
        }
    }

    $allBeachDetails = [];
    
    foreach ($dateAllocations as $date => $totalAllocation) {
        if ($totalAllocation < 100) {
            $beachPercentage = 100 - $totalAllocation;
            $allBeachDetails[] = [
                'employee_id' => $employeeId,
                'date' => $date,
                'beach_percentage' => $beachPercentage,
            ];

            $totalBeachPercentage += $beachPercentage;
            $eligibleDaysCount++;
        }
    }

    $averageBeachPercentage = $eligibleDaysCount > 0
        ? $totalBeachPercentage / $eligibleDaysCount
        : 0;

    return [
        'beach_details' => $allBeachDetails,
        'average_beach_percentage' => $averageBeachPercentage,
    ];
}


// public function viewBeachLog(Request $request, $id)
// {
   
//     $startDate = $request->query('start_date');
//     $endDate = $request->query('end_date');
//     $employeeId = $id;


   
//     $employee = employees::find($employeeId);
    
//     if (!$employee || $employee->employeestatus != 0) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Employee not found or inactive.',
//         ], 404);
//     }

//     $beachData = $this->getPercenctByBeachAjax($employeeId, $startDate, $endDate);

//     $averageBeachDetails = [
//         'employee_id' => $employee->id,
//         'employee_name' => $employee->name,
//         'average_beach_percentage' => $beachData['average_beach_percentage'] ?? 0,
//         'beach_details' => $beachData['beach_details'],
//     ];
   
    

//     return response()->json([
//         'success' => true,
//         'beach_details' => $averageBeachDetails,
//     ]);
// }
// public function viewBeachLog(Request $request, $id)
// {

//     $startDate = $request->input('start_date');
//     $endDate = $request->input('end_date');
//     $employeeId = $id;
//     // dd($startDate); 

//     $employee = employees::find($employeeId); // Ensure your model is correctly referenced
    
//     if (!$employee || $employee->employeestatus != 0) {
//         return redirect()->route('beachDetails')->with('error', 'Employee not found or inactive.');
//     }

//     $beachData = $this->getPercenctByBeachAjax($employeeId, $startDate, $endDate);

//     $averageBeachDetails = [
//         'employee_id' => $employee->id,
//         'employee_name' => $employee->name,
//         'average_beach_percentage' => $beachData['average_beach_percentage'] ?? 0,
//         'beach_details' => $beachData['beach_details'],
//     ];
// dd($averageBeachDetails);
//     // Return the view with compacted data
//     return view('beach-log', compact('averageBeachDetails', 'startDate', 'endDate'));
// }
public function viewBeachLog(Request $request, $id){
    $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $employeeId = $id;
        // dd($startDate); 
    
        $employee = employees::find($employeeId); // Ensure your model is correctly referenced
        
        if (!$employee || $employee->employeestatus != 0) {
            return redirect()->route('beachDetails')->with('error', 'Employee not found or inactive.');
        }
    
        $beachData = $this->getPercenctByBeachAjax($employeeId, $startDate, $endDate);
    
        $averageBeachDetails = [
            'employee_id' => $employee->id,
            'employee_name' => $employee->name,
            'average_beach_percentage' => $beachData['average_beach_percentage'] ?? 0,
            'beach_details' => $beachData['beach_details'],
        ];
    dd($averageBeachDetails);
        // Return the view with compacted data
        return view('beach-log', compact('averageBeachDetails', 'startDate', 'endDate'));

}

}
