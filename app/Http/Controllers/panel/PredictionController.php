<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{TaskCategory, TaskSubCategory, WorkingUnitType, Prediction};

class PredictionController extends Controller
{
    public function prediction(){
        $category = TaskCategory::all();
        $subCategory = TaskSubCategory::all();
        $unit_type = WorkingUnitType::all();
        $prediction = Prediction::all();
        return view('adminpanel.prediction', compact('category', 'subCategory', 'unit_type', 'prediction'));

    }

    public function predictionStore(Request $request)
    {
        // Validate the incoming request data
        // $request->validate([
        //     'city' => 'required|',

        // ]);
        $prediction = new Prediction();
        $prediction->category_id = $request->category;
        $prediction->sub_category_id = $request->sub_category;
        $prediction->min_measurement_of_unit = $request->min_measurement_of_unit;
        $prediction->working_unit_type_id = $request->working_unit_type;
        $prediction->hours_of_completion = $request->hours_of_completion;

        $prediction->save();
        return redirect()->route('prediction')->with('success', 'Prediction added successfully!');
    }


    public function predictionEdit(Request $request, $id){
        $category = TaskCategory::all();
        $subCategory = TaskSubCategory::all();
        $unit_type = WorkingUnitType::all();
        $predictionEdit = Prediction::find($id);
        return view('adminpanel.prediction_edit', compact('category', 'subCategory', 'unit_type', 'predictionEdit'));

    }

    public function predictionUpdate(Request $request)
    {
        // Validate the incoming request data
        // $request->validate([
        //     'city' => 'required|',

        // ]);

        // dd($request->all());
        $prediction = Prediction::find($request->id);
        $prediction->category_id = $request->category;
        $prediction->sub_category_id = $request->sub_category;
        $prediction->min_measurement_of_unit = $request->min_measurement_of_unit;
        $prediction->working_unit_type_id = $request->working_unit_type;
        $prediction->hours_of_completion = $request->hours_of_completion;

        $prediction->save();
        return redirect()->route('prediction')->with('success', 'Prediction Update successfully!');
    }


}
