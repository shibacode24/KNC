<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\PanelRoles;
use App\Models\AppRoles;
use App\Models\{User, AccountDetails, Supervisor, Employee};

class UserRolesController extends Controller
{


    public function appUserRole(){

        $city = City::all();
        $role = AppRoles::all();

        return view('user_management.app_user_roles', compact('city', 'role'));
    }


    public function appUserRoleStore(Request $request)
    {

        $user = new AppRoles();
        $user->role = $request->role;
        $user->permission = $request->permission;

        $user->save();


        return redirect()->back()->with('success', 'Role Added Successfully');
    }



public function appUser(Request $request)
{

    $user_data = User::where(function($query) {
        $query->where('role', 'Site-Manager')
              ->orWhere('role', 'Site-Incharge')
              ->orWhere('role', 'Supervisor')
              ->orWhere('role', 'Engineer')
              ->orWhere('role', 'Other');
    })
    ->whereNotNull('app_role')
    ->with(['role_name', 'supervisor', 'siteManager', 'siteIncharge', 'engineer']) // Eager load relationships
    ->get();

    // dd($user_data);

    $siteManager = User::where('role', 'Site-Manager')->get();
    $siteIncharge = User::where('role', 'Site-Incharge')->get();
    $supervisor = User::where('role', 'Supervisor')->get();
    $engineer =  User::where('role', 'Engineer')->get();
    $role = AppRoles::all();
    $user = User::all();

        return view('user_management.app_user', compact('user_data', 'siteManager', 'siteIncharge', 'engineer', 'role', 'user', 'supervisor'));
    }



    public function appUserstore(Request $request)
    {

        if ($request->person === 'Site-Manager' && $request->siteManager) {
            // Get the supervisor
            $manager = User::find($request->siteManager);

            // Update the supervisor's role and permissions
            $manager->app_role = $request->role_id;

            // Get permissions from PanelRoles table
            $rolePermissions = AppRoles::find($request->role_id)->permission;
            $manager->app_permission = $rolePermissions;

            $manager->save();
        } elseif ($request->person === 'Site-Incharge' && $request->siteIncharge) {
            // Get the supervisor
            $incharge = User::find($request->employee);

            // Update the supervisor's role and permissions
            $incharge->app_role = $request->role_id;

            // Get permissions from appRoles table
            $rolePermissions = AppRoles::find($request->role_id)->permission;
            $incharge->app_permission = $rolePermissions;

            $incharge->save();
        }
        elseif ($request->person === 'Supervisor' && $request->supervisor) {
            // Get the supervisor
            $supervisor = User::find($request->supervisor);

            // Update the supervisor's role and permissions
            $supervisor->app_role = $request->role_id;

            // Get permissions from appRoles table
            $rolePermissions = AppRoles::find($request->role_id)->permission;
            $supervisor->app_permission = $rolePermissions;

            $supervisor->save();
        }
        elseif ($request->person === 'Engineer' && $request->engineer) {
            // Get the supervisor
            $engineer = User::find($request->engineer);

            // Update the supervisor's role and permissions
            $engineer->app_role = $request->role_id;

            // Get permissions from appRoles table
            $rolePermissions = AppRoles::find($request->role_id)->permission;
            $engineer->permission = $rolePermissions;

            $engineer->save();
        }
        elseif($request->person === 'Other'){
            // Get permissions from AppRoles table
            $rolePermissions = AppRoles::find($request->role_id)->permission;

            $user = new User();
            $user -> name = $request->name;
            $user -> contact = $request->contact;
            $user -> email = $request->email;
            $user->password = bcrypt($request->password); // Hash the password
            $user -> app_role = $request->role_id;

            $user -> role = 'Other';
            $user->app_permission = $rolePermissions;

            $user->save();

        }

        return redirect(route('app-user'))->with('success', 'Successfully Updated!');
    }


    // Panel


    public function panelUserRole(){

        $city = City::all();
        $role = PanelRoles::all();

        return view('user_management.panel_user_role', compact('city', 'role'));
    }

    public function panelUserRoleStore(Request $request)
    {

        $user = new PanelRoles();
        $user->role = $request->role;
        $user->permission = $request->permission;

        $user->save();


        return redirect()->back()->with('success', 'Role Added Successfully');
    }


    public function panelUserRoleEdit($id){

        $roleEdit = PanelRoles::find($id);

        return view('user_management.panel_user_role_edit', compact('roleEdit'));
    }

    public function panelUserRoleUpdate(Request $request)
    {

        $user = PanelRoles::find($request->id);
        $user->role = $request->role;
        $user->permission = $request->permission;

        $user->save();


        return redirect(route('panel-user-roles'))->with('success', 'Successfully Updated !');
    }


public function panelUser(Request $request)
{

    $supervisor_data = User::where(function($query) {
        $query->where('role', 'supervisor')
              ->orWhere('role', 'Employee')
              ->orWhere('role', 'Other');
    })
    ->whereNotNull('panel_role')
    ->with(['role_name', 'supervisor', 'employee']) // Eager load relationships
    ->get();
    $supervisor = User::where('role', 'supervisor')->get();
    $employee =  User::where('role', 'Employee')->get();
    $role = PanelRoles::all();
    $user = User::all();

        return view('user_management.panel_user', compact('supervisor_data', 'employee', 'role', 'user', 'supervisor'));
    }


public function panelUserStore(Request $request)
{
    if ($request->person === 'Supervisor' && $request->supervisor_id) {
        // Get the supervisor
        $supervisor = User::find($request->supervisor_id);

        // Update the supervisor's role and permissions
        $supervisor->panel_role = $request->role_id;

        // Get permissions from PanelRoles table
        $rolePermissions = PanelRoles::find($request->role_id)->permission;
        $supervisor->permission = $rolePermissions;

        $supervisor->save();
    } elseif ($request->person === 'Employee' && $request->employee) {
        // Get the supervisor
        $employee = User::find($request->employee);

        // Update the supervisor's role and permissions
        $employee->panel_role = $request->role_id;

        // Get permissions from PanelRoles table
        $rolePermissions = PanelRoles::find($request->role_id)->permission;
        $employee->permission = $rolePermissions;

        $employee->save();
    }
    elseif($request->person === 'Other'){
        // Get permissions from PanelRoles table
        $rolePermissions = PanelRoles::find($request->role_id)->permission;

        $user = new User();
        $user -> name = $request->name;
        $user -> contact = $request->contact;
        $user -> email = $request->email;
        $user->password = bcrypt($request->password); // Hash the password
        $user -> panel_role = $request->role_id;

        $user -> role = 'Other';
        $user->permission = $rolePermissions;

        $user->save();

    }

    return redirect(route('panel-user'))->with('success', 'Successfully Updated!');
}




// USER LOGS


public function userLogs(){
$roles = PanelRoles::all();
$emp = User::all();

    return view('user_management.logs', compact('roles', 'emp'));
}

public function filterEmployeesByRole(Request $request)
{
    $roleId = $request->get('role_id');
    $employees = User::where('panel_role', $roleId)->get();

    return response()->json($employees);
}


}
