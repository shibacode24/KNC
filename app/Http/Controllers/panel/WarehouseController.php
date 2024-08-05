<?php

namespace App\Http\Controllers\panel;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Material;
use App\Models\Brand;
use App\Models\UnitType;
use App\Models\Warehouse\GRN;
use App\Models\Status;
use App\Models\RawMaterial;
use App\Models\AvailableMaterial;
use App\Models\Warehouse;
use App\Models\Inventory\AddMaterial;
use App\Models\PO\MaterialRequestList;


use App\Models\Inventory\IssueMaterialByInventory;
use App\Models\Warehouse\IssueMaterialByWareHouse;

class WarehouseController extends Controller
{


    // GRN
    public function grn(Request $request)
{
    // Get orders that are pending and not yet included in GRN
    $order = MaterialRequestList::where('status', 'Pending')
        ->whereNotNull('add_material_id')
        ->whereNotIn('id', function($query) {
            $query->select('material_req_list_id')->from('grn');
        })->get();

        $directOrder = MaterialRequestList::where('status', 'Pending')
        ->whereNull('add_material_id')
        ->whereNotIn('id', function($query) {
            $query->select('material_req_list_id')->from('grn');
        })->get();

    // Get orders that are completed and not yet included in GRN
    $completeOrder = MaterialRequestList::where('status', 'Completed')
    ->whereNotNull('add_material_id')
       ->get();

       $directCompleteOrder = MaterialRequestList::where('status', 'Completed')
       ->whereNull('add_material_id')
          ->get();


        // dd($completeOrder);
    $vendor = Vendor::all();
    $brand = Brand::all();
    $material = Material::all();
    $unit = UnitType::all();
    $rawmaterial = RawMaterial::all();
    $warehouse = Warehouse::all();

    return view('adminpanel.grn', compact('vendor', 'brand', 'material', 'unit', 'order', 'directOrder', 'completeOrder',
    'directCompleteOrder', 'rawmaterial', 'warehouse'));
}




public function viewgrn(Request $request)
{

    $materialReqListId = $request->input('entry_id'); // Use 'entry_id' instead of 'id' if that's what you're passing from the AJAX call

    $warehouse = Warehouse::all();
    $render_view = view('adminpanel.grn_view', compact('warehouse', 'materialReqListId'))->render();
    return response()->json(['html' => $render_view, 'status' => 'success', 'message' => 'Data loaded successfully']);
}



        public function grnStore(Request $request)
    {
        $materialRequest = MaterialRequestList::find($request->material_req_list_id);

        $grn = new GRN();
        $grn->material_req_list_id = $request->material_req_list_id;
        $grn->received_date = $request->received_date;
        $grn->received_time = $request->received_time;
        $grn->warehouse_id = $request->received_location;
        $grn->received_quantity = $request->received_quantity;
        $grn->received_by = $request->received_by;
        $grn->add_material_id = $materialRequest->add_material_id; // Store the add_material_id

        if ($materialRequest->order_by === 'Direct Order') {
            $grn->grn_type = 'Direct GRN';
        } else {
            // You can set a default value or leave it null if no condition is met
            $grn->grn_type = 'GRN'; // Replace with appropriate default value if needed
        }


        $grn->save();


        $addMaterialStatus = AddMaterial::where('id', $materialRequest->add_material_id)
        ->first();

    if ($addMaterialStatus) {
        // Update the existing available material
        $addMaterialStatus->status = 'Completed';
        $addMaterialStatus->save();
    } elseif ($addMaterialStatus) {
        // Create a new available material entry
        $addMaterialStatus->status = 'Pending';
        $addMaterialStatus->save();
    } else {
        // Handle the case where $addMaterialStatus is neither true nor false
    }
    $orderDetails = MaterialRequestList::where('id', $materialRequest->id)
    ->first();

    if ($orderDetails) {
        // Update the existing available material
        $orderDetails->status = 'Completed';
        $orderDetails->save();
    } else {
        // Create a new available material entry
        $orderDetails->status = 'Pending';
        $orderDetails->save();
    }

    // Fetch the material request details
    // $materialRequest = MaterialRequestList::find($request->material_req_list_id);

    // Check if the combination exists in the available_material table
    $availableMaterial = AvailableMaterial::where('warehouse_id', $materialRequest->warehouse_id)
        ->where('material_id', $materialRequest->material_id)
        ->where('brand_id', $materialRequest->brand_id)
        ->where('raw_material_id', $materialRequest->raw_material_id)
        ->where('type', 'Consumable')
        ->first();

    if ($availableMaterial) {
        // Update the existing available material
        $availableMaterial->available_quantity += $request->received_quantity;
        $availableMaterial->save();
    } else {
        // Create a new available material entry
        AvailableMaterial::create([
            'warehouse_id' => $materialRequest->warehouse_id,
            'material_id' => $materialRequest->material_id,
            'brand_id' => $materialRequest->brand_id,
            'raw_material_id' => $materialRequest->raw_material_id,
            'available_quantity' => $request->received_quantity,
            'type' => 'Consumable',
        ]);
    }

    // return redirect()->route('grn')->with('success', 'GRN added successfully!');
    if ($grn->grn_type === 'Direct GRN') {
        return redirect()->route('direct-grn-in')->with('success', 'GRN added successfully!');
    } else {
        return redirect()->route('grn')->with('success', 'GRN added successfully!');
    }
}





// Direct GRN IN


public function direct_grn_in(Request $request)
{
    // Get orders that are pending and not yet included in GRN

        $directOrder = MaterialRequestList::where('status', 'Pending')
        ->whereNull('add_material_id')
        ->whereNotIn('id', function($query) {
            $query->select('material_req_list_id')->from('grn');
        })->get();

       $directCompleteOrder = MaterialRequestList::where('status', 'Completed')
       ->whereNull('add_material_id')
       ->get();


        // dd($completeOrder);
    $vendor = Vendor::all();
    $brand = Brand::all();
    $material = Material::all();
    $unit = UnitType::all();
    $rawmaterial = RawMaterial::all();
    $warehouse = Warehouse::all();

    return view('adminpanel.direct_grn_in', compact('vendor', 'brand', 'material', 'unit', 'directOrder',
    'directCompleteOrder', 'rawmaterial', 'warehouse'));
}


public function viewDirectGrnIn(Request $request)
{

    $materialReqListId = $request->input('entry_id'); // Use 'entry_id' instead of 'id' if that's what you're passing from the AJAX call

    $warehouse = Warehouse::all();
    $render_view = view('adminpanel.direct_grn_in_view', compact('warehouse', 'materialReqListId'))->render();
    return response()->json(['html' => $render_view, 'status' => 'success', 'message' => 'Data loaded successfully']);
}



// GRN Out
    public function issue_material(Request $request)
    {
        $issueMaterial = IssueMaterialByInventory::whereNull('issue_type')->get();
        $directIssueMaterial = IssueMaterialByInventory::whereNotNull('issue_type')->get();

        $statusID = Status::all();
        $existingMaterials = IssueMaterialByWarehouse::all()->keyBy('issue_material_by_inventory_id');

        return view('adminpanel.issue_material', compact('issueMaterial', 'directIssueMaterial', 'statusID', 'existingMaterials'));
    }

    public function addIssuedMaterialByWarehouse2(Request $request)
{
    $remarks = $request->input('remarks' ?? '');
    $statuses = $request->input('status');

    foreach ($remarks as $id => $remark) {
          // Check if the record already exists
          $existingRecord = IssueMaterialByWarehouse::where('issue_material_by_inventory_id', $id)->first();

            if ($existingRecord) {
                // Update existing record
                $existingRecord->update([
                    'remark' => $remark,
                    // 'status_id' => $statuses[$id],
                ]);
            } else {
                // Create new record
                IssueMaterialByWarehouse::create([
                    'issue_material_by_inventory_id' => $id,
                    'remark' => $remark,
                    'status_id' => $statuses[$id],
                ]);
            }
              // Update the corresponding IssueMaterialByInventory record
        $inventoryRecord = IssueMaterialByInventory::find($id);
        if ($inventoryRecord) {
            $inventoryRecord->update(['inventory_status' => $statuses[$id]]);
        }
        }

    return redirect()->route('issue_material')->with('success', 'Materials updated successfully!');
}

public function addIssuedMaterialByWarehouse(Request $request)
{
    $remarks = $request->input('remarks', []);
    $statuses = $request->input('status', []);

    foreach ($remarks as $id => $remark) {
        $status = $statuses[$id] ?? null; // Get the corresponding status for the current material ID

        if ($status !== null) {
            // Check if the record already exists
            $existingRecord = IssueMaterialByWarehouse::where('issue_material_by_inventory_id', $id)->first();

            if ($existingRecord) {
                // Update existing record
                $existingRecord->update([
                    'remark' => $remark,
                    'status_id' => $status,
                    'app_status_id' =>6,
                ]);
            } else {
                // Create new record
                IssueMaterialByWarehouse::create([
                    'issue_material_by_inventory_id' => $id,
                    'remark' => $remark,
                    'status_id' => $status,
                    'app_status_id' =>6,

                ]);
            }

            // Update the corresponding IssueMaterialByInventory record
            $inventoryRecord = IssueMaterialByInventory::find($id);
            if ($inventoryRecord) {
                $inventoryRecord->update([
                    'inventory_status' => $status,
                    'app_status' =>6,

            ]);
            }
        }
    }

    return redirect()->route('issue_material')->with('success', 'Materials updated successfully!');
}


// Direct GRN Out

public function directGrnOut(Request $request)
{
   // $issueMaterial = IssueMaterialByInventory::where('issue_type', 'Direct Issue')->get();
    $directIssueMaterial = IssueMaterialByInventory::whereNotNull('issue_type')
    ->where('material_type', 'Consumable')->get();

    $statusID = Status::all();
    $existingMaterials = IssueMaterialByWarehouse::all()->keyBy('issue_material_by_inventory_id');

    return view('adminpanel.direct_grn_out', compact('directIssueMaterial', 'statusID', 'existingMaterials'));
}


}
