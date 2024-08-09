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




// Controller method that returns view
// public function showMap(Request $request) {
//     $empId = $request->input('emp_id');
//     $latestLocation = TrackEmpLocation::where('emp_id', 32)
//                                       ->orderBy('created_at', 'desc')
//                                       ->first();
// // dd($latestLocation);
//     $locations = TrackEmpLocation::where('emp_id', 32)
//                                  ->orderBy('created_at', 'desc')
//                                  ->get();

//     return view('map', compact('latestLocation', 'locations'));


// }

public function showMap(Request $request) {
    $empId = $request->input('emp_id');
    $fromDate = $request->input('from_date');
    $toDate = $request->input('to_date');

    $query = TrackEmpLocation::query();

    if ($empId) {
        $query->where('emp_id', $empId);
    }

    if ($fromDate) {
        $query->whereDate('created_at', '>=', $fromDate);
    }

    if ($toDate) {
        $query->whereDate('created_at', '<=', $toDate);
    }

    $locations = $query->orderBy('created_at', 'desc')->get();
    $latestLocation = $locations->first(); // Get the latest location if available

    return view('map', compact('latestLocation', 'locations'));
}




public function filterEmployees(Request $request)
{
    $type = $request->query('type');

    if (!$type) {
        return response()->json([]);
    }

    // Join TrackEmpLocation with user table to get unique employee names
    $employees = TrackEmpLocation::where('emp_type', $type)
        ->join('users', 'track_emp_location.emp_id', '=', 'users.id')
        ->distinct('track_emp_location.emp_id') // Ensure distinct emp_id
        ->get(['track_emp_location.emp_id as id', 'users.name']); // Alias id for consistency

    return response()->json($employees);
}


}
