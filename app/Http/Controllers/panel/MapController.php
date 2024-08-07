<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\TrackEmpLocation;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class MapController extends Controller
{

// public function showMap(Request $request)
// {
//     $coordinate = TrackEmpLocation::where('emp_id', $request->emp_id)->first(['latitude', 'longitude']);

//      // Retrieve all employee locations
//      $allLocations = TrackEmpLocation::all(['latitude', 'longitude', 'emp_id']);

//     $emp = User::all();
// // echo json_encode($coordinate);
// // exit();
//         return view('map', compact('coordinate', 'emp', 'allLocations'));
// }

public function showMap2(Request $request)
{
    $selectedEmployeeLocation = TrackEmpLocation::where('emp_id', $request->emp_id)->first(['latitude', 'longitude']);

    // Retrieve all employee locations
    $allLocations = TrackEmpLocation::all(['latitude', 'longitude', 'emp_id']);

    // Retrieve all employees for displaying names
    $employees = User::all(['id', 'name']); // Adjust as needed

    return view('map', compact('selectedEmployeeLocation', 'employees', 'allLocations'));
}

public function showMap(Request $request)
{
    $empId = $request->input('emp_id');

    // Retrieve the latest location of the selected employee
    $selectedEmployeeLocation = TrackEmpLocation::where('emp_id', $empId)->first(['latitude', 'longitude']);

    // Retrieve all location history of the selected employee
    $locationHistory = DB::table('track_emp_location')
        ->where('emp_id', $empId)
        ->orderBy('recorded_at', 'asc')
        ->get(['latitude', 'longitude', 'recorded_at']);

    // Retrieve all employees for displaying names
    $employees = User::all(['id', 'name']); // Adjust as needed

    return view('map', compact('selectedEmployeeLocation', 'employees', 'locationHistory'));
}



// In your controller
// public function getEmployeesByType(Request $request)
// {
//     $type = $request->input('type');

//     // Query based on employee type
//     $employees = User::whereIn('id', function($query) use ($type) {
//         $query->select('emp_id')
//               ->from('TrackEmpLocation')
//               ->where('emp_type', $type);
//     })->get(['id', 'name']); // Ensure 'name' is selected

//     return response()->json($employees);
// }


// public function filterEmployees(Request $request)
// {
//     $type = $request->query('type');

//     if (!$type) {
//         return response()->json([]);
//     }

//     $employees = TrackEmpLocation::where('emp_type', $type)->get(['id', 'emp_id']);

//     return response()->json($employees);
// }

public function filterEmployees(Request $request)
{
    $type = $request->query('type');

    if (!$type) {
        return response()->json([]);
    }

    // Join TrackEmpLocation with user table to get employee names
    $employees = TrackEmpLocation::where('emp_type', $type)
        ->join('users', 'track_emp_location.emp_id', '=', 'users.id')
        ->get(['track_emp_location.id', 'users.name']); // Adjust column name based on your user table

    return response()->json($employees);
}


}
