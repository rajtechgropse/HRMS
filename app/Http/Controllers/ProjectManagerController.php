<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\AddProjects;
use App\Models\submit_invoices;
use App\Models\add_on;
use Illuminate\Support\Facades\DB;
// use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class ProjectManagerController extends Controller
{
    public function index()
    {
        $user = auth()->user();
    
        if ($user->is_project_manager) {
          
            $projects = $user->projects;
            return view('pojectlistofprojectmanager', compact('projects'));
        } else {
            return redirect('/login')->with('error', 'Access Denied: You are not a project manager.');
        }
    }
}
