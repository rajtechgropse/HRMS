<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class TimeSheetManagers extends Controller
{
    public function timesheetmanagers(){
        $userDetilsGet = User::paginate(15);
      $modules = Session::get('user_modules_' . auth()->id());
      return view('timesheetManagers', ['modules' => $modules], ['userDetilsGet' => $userDetilsGet]);

        // dd($userDetilsGet);
    }
    public function updateStatus(Request $request, $id)
    {
        // dd('hlw');
        // Validate the request
        $request->validate([
            'status' => 'required|boolean',
        ]);

        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        // Update the user's status
        $user->time_managers_status = $request->input('status');
        $user->save();

        // Return a JSON response
        return response()->json(['success' => true, 'status' => $user->time_managers_status]);
    }
}
