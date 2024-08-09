<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Warehouse, Site, TransferMaterial};


class TransferMaterialController extends Controller
{
    // public function transferMaterial(){
    //     $warehouse = Warehouse::all();
    //     $site = Site::all();
    //     return view('adminpanel.transfer_material', compact('warehouse', 'site'));

    // }

    public function transferMaterial() {
        $warehouses = Warehouse::all(); // Collection of Warehouse objects
        $sites = Site::all(); // Collection of Site objects
        $transferedMaterial = TransferMaterial::all();
        // Convert collections to arrays for JavaScript
        $warehousesArray = $warehouses->map(function($warehouse) {
            return [
                'id' => $warehouse->id,
                'name' => $warehouse->warehouse_name
            ];
        })->toArray();

        $sitesArray = $sites->map(function($site) {
            return [
                'id' => $site->id,
                'name' => $site->site_name
            ];
        })->toArray();

        return view('adminpanel.transfer_material', [
            'warehousesArray' => $warehousesArray,
            'sitesArray' => $sitesArray,
            'transferedMaterial' => $transferedMaterial,
        ]);
    }

    public function transferMaterialStore(Request $request)
    {
        // Validate the incoming request data
        // $request->validate([
        //     'city' => 'required|',

        // ]);
        $material = new TransferMaterial();
        $material->transfer_type = $request->transfer_type;
        $material->source_location = $request->source_location;
        $material->target_location = $request->target_location;

        $material->save();
        return redirect()->route('transfer-material')->with('success', 'Material Transfered successfully!');
    }

    public function transferMaterialEdit(Request $request, $id)
    {
        $warehouses = Warehouse::all(); // Collection of Warehouse objects
        $sites = Site::all(); // Collection of Site objects
        $warehousesArray = $warehouses->map(function($warehouse) {
            return [
                'id' => $warehouse->id,
                'name' => $warehouse->warehouse_name
            ];
        })->toArray();

        $sitesArray = $sites->map(function($site) {
            return [
                'id' => $site->id,
                'name' => $site->site_name
            ];
        })->toArray();
        $materialEdit = TransferMaterial::find($id);
        return view('adminpanel.transfer_material_edit',  [
            'warehousesArray' => $warehousesArray,
            'sitesArray' => $sitesArray,
            'materialEdit' => $materialEdit,
        ]);

    }

    public function transferMaterialUpdate(Request $request)
    {
        $material = TransferMaterial::find($request->id);
        $material->transfer_type = $request->transfer_type;
        $material->source_location = $request->source_location;
        $material->target_location = $request->target_location;

        $material->save();


        return redirect(route('transfer-material'))->with('success', 'Successfully Updated !');
    }



}
