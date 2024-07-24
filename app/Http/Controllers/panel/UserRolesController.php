<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\PanelRoles;
use App\Models\AppRoles;
use App\Models\{User, AccountDetails};

class UserRolesController extends Controller
{
    public function panelUserRole(){

        $city = City::all();
        $role = PanelRoles::all();
        // $ac = AccountDetails::where('supervisor_id', '!=', NULL)->with('supervisor')->get();
        // $supervisor = Supervisor::get();
        return view('adminpanel.panel_user_role', compact('city', 'role'));
    }


    public function panelUserstore(Request $request)
    {
        //  dd($request->all());
        // $request->validate([
        //     'supervisor_name' => 'required',
        //     'email' => 'required|',
        //     'mobile_number' => 'required|',
        //     'aadhar_number' => 'required|',
        //     'pan_number' => 'required',
        //     'city_address' => 'required',
        //     'city_id' => 'required',

        // ]);

         // Create a new User instance and set its attributes
    // $user = new User();
    // $user->name = $request->supervisor_name;
    // $user->email = $request->email;
    // $user->password = bcrypt($request->password); // Hash the password
    // $user->role = 'supervisor'; // Set the role to supervisor
    // $user->save();


        $user = new User();
        $user->panel_role = $request->role;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->contact = $request->mobile_number;
        $user->aadhar_number = $request->aadhar_number;
        $user->pan_number = $request->pan_number;
        $user->address = $request->city_address;
        $user->city = $request->city_id;
    $user->password = bcrypt($request->password); // Hash the password
    $user->permission = $request->permission;

        // $user->user_id = $user->id;
        // $user->permission = json_encode($request->permission);

        // dd($user);
        $user->save();

        foreach ($request->acc_holder_name as $key => $acc_holder_name) {
            $account_details = new AccountDetails();
            $account_details->user_id = $user->id;
            $account_details->account_holder = $request->acc_holder_name[$key];
            $account_details->bank_name = $request->bank[$key];
            $account_details->account_number = $request->ac_n[$key];
            $account_details->ifsc_code = $request->ifsc[$key];
            $account_details->save();
        }
        // dd(1);
        return redirect()->back()->with('success', 'Supervisor and Account Details Added Successfully');
    }


    public function appUserRole(){

        $city = City::all();
        $role = AppRoles::all();
        // $ac = AccountDetails::where('supervisor_id', '!=', NULL)->with('supervisor')->get();
        // $supervisor = Supervisor::get();
        return view('adminpanel.app_user_roles', compact('city', 'role'));
    }


    public function appUserstore(Request $request)
    {
        //  dd($request->all());
        // $request->validate([
        //     'supervisor_name' => 'required',
        //     'email' => 'required|',
        //     'mobile_number' => 'required|',
        //     'aadhar_number' => 'required|',
        //     'pan_number' => 'required',
        //     'city_address' => 'required',
        //     'city_id' => 'required',

        // ]);

         // Create a new User instance and set its attributes
    // $user = new User();
    // $user->name = $request->supervisor_name;
    // $user->email = $request->email;
    // $user->password = bcrypt($request->password); // Hash the password
    // $user->role = 'supervisor'; // Set the role to supervisor
    // $user->save();


        $user = new User();
        $user->app_role = $request->role;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->contact = $request->mobile_number;
        $user->aadhar_number = $request->aadhar_number;
        $user->pan_number = $request->pan_number;
        $user->address = $request->city_address;
        $user->city = $request->city_id;
    $user->password = bcrypt($request->password); // Hash the password
    $user->permission = $request->permission;

        // $user->user_id = $user->id;
        // $user->permission = json_encode($request->permission);

        // dd($user);
        $user->save();

        foreach ($request->acc_holder_name as $key => $acc_holder_name) {
            $account_details = new AccountDetails();
            $account_details->user_id = $user->id;
            $account_details->account_holder = $request->acc_holder_name[$key];
            $account_details->bank_name = $request->bank[$key];
            $account_details->account_number = $request->ac_n[$key];
            $account_details->ifsc_code = $request->ifsc[$key];
            $account_details->save();
        }
        // dd(1);
        return redirect()->back()->with('success', 'User and Account Details Added Successfully');
    }

}
