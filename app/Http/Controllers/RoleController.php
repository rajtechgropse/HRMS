<?php

namespace App\Http\Controllers;

use App\Models\module;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


class RoleController extends Controller
{
    public function allRolesView()
    {
        $modules = Session::get('user_modules_' . auth()->id());
        $permissions = [];
       
        $userType =  Auth::user()->role_id;
        $role = Role::all()->toArray();
        $processedData = [];

        foreach ($role as $item) {
            $name = $item['name'];

            if (!isset($processedData[$name]['role'])) {
                $processedData[$name]['role'] = [];
            }
            $processedData[$name]['role'][] = $item['role'];

            if (!isset($processedData[$name]['description'])) {
                $processedData[$name]['description'] = [];
            }
            $processedData[$name]['description'][] = $item['description'];
        }

        return view('allRolesView', [
            'modules' => $modules,  'processedData' => $processedData
           
        ]);
    }
    public function delete($name)
    {
        $role = Role::where('name', $name)->delete();

        if ($role) {
            $status = "Permission deleted successfully!";
            return redirect()->back()->with('status', $status);
        } else {
            $status = "Failed to delete permission!";
            return redirect()->back()->with('status', $status);
        }
    }
    // public function allRolesEdit($userName)
    // {
    //     // Find all roles with the given name
    //     $roles = Role::where('name', $userName)->get();
        
    //     // Check if any roles were found
    //     if ($roles->isEmpty()) {
    //         return redirect()->route('allRoles')->with('error', 'No roles found with the given name.');
    //     }
    
    //     // Retrieve modules
    //     $modules = Session::get('user_modules_' . auth()->id());
    
    //     $rolesData = [];
    
    //     foreach ($roles as $role) {
    //         // Convert role's description to an array if it's a string
    //         $permissions = explode(',', $role->description);
   
    //         // Define permissions grouped by category
    //         $permissionsGrouped = [
    //             'user' => ['user.create', 'user.view', 'user.edit', 'user.delete', 'user.approve'],
    //             'project' => ['project.create', 'project.view', 'project.edit', 'project.delete', 'project.approve', 'project.invoice.create', 'project.invoice.view', 'project.invoice.edit', 'project.invoice.delete', 'project.invoice.approve', 'project.milestone.create', 'project.milestone.view', 'project.milestone.edit', 'project.milestone.delete', 'project.milestone.approve', 'project.addTeamMember.create', 'project.addTeamMember.view', 'project.addTeamMember.edit', 'project.addTeamMember.delete', 'project.addTeamMember.approve'],
    //             'dashboard' => ['dashboard.view', 'dashboard.edit'],
    //             'profile' => ['profile.view', 'profile.edit'],
    //             'role' => ['role.view', 'role.edit', 'role.create', 'role.delete', 'role.approve'],
    //             'employeeView' => ['employeeView.view', 'employeeView.edit', 'employeeView.search', 'employeeView.delete', 'employeeView.export', 'employeeView.import'],
    //             'find' => ['find.view'],
    //         ];
    
    //         // dd($permissions);
    //         $rolesData[] = [
    //             'name' => $userName,
    //             'role' => $role,
    //             'modules' => $modules,
    //             'permissionsGrouped' => $permissionsGrouped,
    //             'permissions' => $permissions,
    //         ];
    //     }
    
    //     return view('editRole', compact('rolesData', 'modules'));
    // }
    
    
    
    
    
    public function allRolesDetails()
    {
      $modules = Session::get('user_modules_' . auth()->id());


        return view('allRolesDetails', ['modules' => $modules]);
    }
    public function allRolesDetailsStore(Request  $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255', 
        ], [
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a string.',
            'name.max' => 'Name cannot exceed 255 characters.',
           
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $name = $request->input('name');
        $roleNames = $request->input('groupname');
        $permissions = $request->input('permissions');
       
        $rolePermissions = [];

        foreach ($permissions as $permission) {
            foreach ($roleNames as $role) {
                if (strpos($permission, $role) !== false) {
                    $rolePermissions[] = [
                        'name' => $name,
                        'role' => $role,
                        'description' => $permission,
                    ];
                }
            }
        }
        // dd($rolePermissions);
        Role::insert($rolePermissions);
        return redirect()->route('allRolesView')->with('status', 'Role Created Successfully');
    }

   
    
}
