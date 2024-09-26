<?php

namespace App\Http\Controllers;

use App\Models\mileStone;
use App\Models\AddProjects;
use App\Models\employees;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class MilestoneController extends Controller
{
    // public function milestonelogs(){
    //   $modules = Session::get('user_modules_' . auth()->id());
    // $mileStoneDetils = mileStone::all();
    // $project_Ids = $mileStoneDetils->pluck('project_id');
    // $projectDetails = AddProjects::whereIn('id',$project_Ids)->get();
    // $projectManagersIds = $projectDetails->pluck('pmemployeeId');
    // $projectManagersName = employees::whereIn('id',$projectManagersIds)->get();
    // dd($projectManagersName);


    //     return view('milestoneLogs',['modules' => $modules]);
    // }
    public function milestonelogs()
    {
        $modules = Session::get('user_modules_' . auth()->id());
<<<<<<< HEAD

        // Fetch all milestone details with pagination
        $mileStoneDetils = mileStone::paginate(15);

        // Extract project IDs from milestone details
        $project_Ids = $mileStoneDetils->pluck('project_id')->unique();

        // Fetch project details based on the extracted project IDs
        $projectDetails = AddProjects::whereIn('id', $project_Ids)->get();

        // Extract project manager IDs from project details
        $projectManagersIds = $projectDetails->pluck('pmemployeeId')->unique();

        // Fetch project manager details based on the extracted IDs
        $projectManagers = employees::whereIn('id', $projectManagersIds)->get()->keyBy('id');

        // Prepare data to be displayed
        $milestoneLogs = $mileStoneDetils->map(function ($milestone) use ($projectDetails, $projectManagers) {
            $project = $projectDetails->firstWhere('id', $milestone->project_id);
            $projectManager = $projectManagers->get($project->pmemployeeId);

=======
    
        // Fetch all milestone details with pagination
        $mileStoneDetils = mileStone::paginate(15);
    
        // Extract project IDs from milestone details
        $project_Ids = $mileStoneDetils->pluck('project_id')->unique();
    
        // Fetch project details based on the extracted project IDs
        $projectDetails = AddProjects::whereIn('id', $project_Ids)->get();
    
        // Extract project manager IDs from project details
        $projectManagersIds = $projectDetails->pluck('pmemployeeId')->unique();
    
        // Fetch project manager details based on the extracted IDs
        $projectManagers = employees::whereIn('id', $projectManagersIds)->get()->keyBy('id');
    
        // Prepare data to be displayed
        $milestoneLogs = $mileStoneDetils->map(function($milestone) use ($projectDetails, $projectManagers) {
            $project = $projectDetails->firstWhere('id', $milestone->project_id);
            $projectManager = $projectManagers->get($project->pmemployeeId);
    
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
            return [
                'id' => $milestone->id,
                'project_name' => $project ? $project->projectname : 'N/A',
                'project_manager_name' => $projectManager ? $projectManager->name : 'N/A',
                'milestone_name' => $milestone->name,
                'milestone_start_date' => $milestone->StartDate,
                'milestone_end_date' => $milestone->targetComplectionDate,
                'milestone_hours' => $milestone->hours,
                'status' => $milestone->status,
            ];
        });
<<<<<<< HEAD
        // dd($mileStoneDetils);

=======
    
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
        // Return the view with both the paginator and the prepared data
        return view('milestoneLogs', [
            'modules' => $modules,
            'milestoneLogs' => $milestoneLogs,
            'milestoneDetils' => $mileStoneDetils, // Pass the paginator to the view
        ]);
    }
<<<<<<< HEAD

=======
    
    // public function updateStatus(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required|integer|exists:milestone,id',
    //         'status' => 'required|integer|in:0,1,2'
    //     ]);
    //     // dd('here');
    
    //     $milestone = mileStone::find($request->id);
    //     if ($milestone) {
    //         $milestone->status = $request->status;
    //         $milestone->save();
    
    //         return response()->json([
    //             'success' => true,
    //             'status' => $request->status
    //         ]);
    //     }
    
    //     return response()->json(['success' => false], 404);
    // }
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
    public function updateStatusManager(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:milestone,id',
            'status' => 'required|integer|in:0,1,2'
        ]);
        // dd('here');

        $milestone = mileStone::find($request->id);
        if ($milestone) {
            $milestone->status = $request->status;
            $milestone->save();

            return response()->json([
                'success' => true,
                'status' => $request->status
            ]);
        }

        return response()->json(['success' => false], 404);
    }
    public function submitMilestoneDetails(Request $request)
    {
        // dd($request->all());
        $milestone = Milestone::find($request->milestone_id);
        if ($milestone) {
            // dd('here');
            $milestone->qa_signed = $request->qa_signed;
            $milestone->client_signed = $request->client_signed;
            $milestone->remarks = $request->remarks;
            $milestone->is_complete = $request->is_complete;
            $milestone->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
<<<<<<< HEAD
=======
    

    
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
}
