<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;

class MapController extends Controller
{
    
public function showMap()
{
    $coordinate = City::where('id', 4)->first(['latitude', 'longitude']);
// echo json_encode($coordinate);
// exit();
        return view('map', compact('coordinate'));
}
}
