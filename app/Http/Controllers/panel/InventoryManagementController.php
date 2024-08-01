<?php

namespace App\Http\Controllers\panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RequestedMaterial;
use App\Models\Material;
use App\Models\Brand;
use App\Models\UnitType;
use App\Models\{Warehouse, AvailableMaterial, NonConsumableBrand, NonConsumableCategoryMaterial,NonConsumableCategory, NonConsumableUnitType, RawMaterial, Status, Site, Supervisor};
use App\Models\Inventory\{AddMaterial, DirectIssueMaterial};
use App\Models\Inventory\IssueMaterialByInventory;
use App\Models\Inventory\NonConsumableMaterial;
use App\Models\Inventory\NonConsumableDirectIssueMaterial;

class InventoryManagementController extends Controller
{
       public function site_material()
{
     // Fetch all requested materials where status is null and group by date and site_id
     $requestedMaterial = RequestedMaterial::whereNull('status')
     ->orderBy('created_at', 'desc')
     ->get()
     ->groupBy(function($item) {
         return $item->created_at->format('Y-m-d') . '_' . $item->site_id;
     });

    $issueMaterial = IssueMaterialByInventory::whereNull('issue_type')->get();
    // // Fetch all requested materials and group by date and site_id
    // $requestedMaterial = RequestedMaterial::all()->groupBy(function($item) {
    //     return $item->created_at->format('Y-m-d') . '_' . $item->site_id;
    // });
    return view('adminpanel.site_material', compact('requestedMaterial', 'issueMaterial'));
}


public function viewservicearea(Request $request)
{
    // Ensure that 'date' and 'site_id' parameters are provided
    if (!$request->has(['date', 'site_id'])) {
        return response()->json(['html' => '<p>Invalid request parameters</p>']);
    }

    // Fetch requested materials based on the date and site ID
    $appendData = RequestedMaterial::whereDate('created_at', $request->date)
                                   ->where('site_id', $request->site_id)
                                   ->where('material_type', 'Consumable')
                                   ->where('status', Null)
                                   ->get();
    $warehouseId = Warehouse::all();
    $statusId = Status::all();
// dd($statusId);
    // Check if no records are found
    if ($appendData->isEmpty()) {
        return response()->json(['html' => '<p>No data found</p>', 'status' => 'error', 'message' => 'No data found']);
    }

    $render_view = view('adminpanel.site_material_view', compact('appendData', 'warehouseId', 'statusId'))->render();
    return response()->json(['html' => $render_view, 'status' => 'success', 'message' => 'Data loaded successfully']);
}


public function viewservicearea_edit(Request $request)
{
    // dd($request->id);
    // Ensure that 'date' and 'site_id' parameters are provided
    if (!$request->has(['id'])) {
        return response()->json(['html' => '<p>Invalid request parameters</p>']);
    }

    // Fetch requested materials based on the date and site ID
    $appendData = IssueMaterialByInventory::
                                   where('id', $request->id)
                                   ->get();
    $warehouseId = Warehouse::all();
    $statusId = Status::all();
    // echo json_encode($appendData);
// dd($statusId);
    // Check if no records are found
    // if ($appendData->isEmpty()) {
    //     return response()->json(['html' => '<p>No data found</p>', 'status' => 'error', 'message' => 'No data found']);
    // }

    $render_view = view('adminpanel.site_material_edit_view', compact('appendData', 'warehouseId', 'statusId'))->render();
    return response()->json(['html' => $render_view, 'status' => 'success', 'message' => 'Data loaded successfully']);
}


// In your controller
public function getAvailableMaterial(Request $request)
{
    $warehouseId = $request->warehouse_id;

    // Fetch available material based on the warehouse_id
    $availableMaterial = AvailableMaterial::where('warehouse_id', $warehouseId)->first();

    if ($availableMaterial) {
        return response()->json(['available_material' => $availableMaterial->available_quantity]);
    } else {
        return response()->json(['available_material' => 0]);
    }
}


public function addIssuedMaterial(Request $request)
{
    $data = $request->input('data'); // Retrieve the array of data from the form

    if (is_null($data)) {
        return redirect()->route('site_material')->with('error', 'No data received!');
    }
// dd($data);
    foreach ($data as $item) {
        // Validate if the necessary fields are filled out for each row
        if (isset($item['issue_material'])) {
            // Check if 'remark' is not set, assign an empty string as default
            $remark = isset($item['remark']) ? $item['remark'] : '';

            // Debugging: Log the $item and $remark to see their values
            \Log::info('Item:', [$item]);
            \Log::info('Remark:', [$remark]);

            // Find the requested material by ID
            $requestedMaterial = RequestedMaterial::find($item['id']);

            if ($requestedMaterial) {
                // Create a new instance of IssueMaterialByInventory
                $material = new IssueMaterialByInventory();
                $material->requested_material_date = $requestedMaterial->created_at;
                $material->site_id = $requestedMaterial->site_id;
                $material->material_type = $requestedMaterial->material_type;
                $material->requested_material_id = $item['id'];
                $material->material_id = $item['material'];
                $material->raw_material_id = $item['raw_material'];
                $material->brand_id = $item['brand'];
                $material->requested_material_quantity = $item['quantity'];
                $material->material_unit_id = $item['unit_type'];
                $material->selected_warehouse_id = $item['warehouse'];
                $material->available_material = $item['available_material'];
                $material->issue_material = $item['issue_material'];
                $material->remaining_material = $item['remaining_material'];
                $material->remark = $remark; // Assign the remark
                $material->app_status = $item['status'];
                $material->save();
                // Update the status of the requested material to 'Submitted'
                $requestedMaterial->update(['status' => 'Submitted']);
            }
        }
    }
    return redirect()->route('site_material')->with('success', 'Requests added successfully!');
}



public function update_site_material(Request $request)
{
// dd($request->input('data'));
    $data = $request->input('data');

    $id = $data[0]['id'];
   $requested_material_date =  $data[0]['raw_material_id'];
    $material = IssueMaterialByInventory::where('id',$id)->first();
// echo json_encode( $data );
// echo json_encode( $material );
// echo json_encode( $requested_material_date );
// exit(); 
    if ($material) {
    //     // Create a new instance of IssueMaterialByInventory
        // $material = new IssueMaterialByInventory();
        $material->requested_material_date =$material->requested_material_date;
        $material->site_id =$material->site_id;
        $material->material_type =$material->material_type;
        $material->requested_material_id =$material->requested_material_id;
        $material->material_unit_id =$material->material_unit_id;
        $material->material_id = $data[0]['material_id'];
        $material->raw_material_id =$data[0]['raw_material_id'];
        $material->brand_id =$data[0]['brand_id'];
        $material->requested_material_quantity =$data[0]['requested_material_quantity'];
        $material->selected_warehouse_id =$data[0]['selected_warehouse_id'];
        $material->available_material =$data[0]['available_material'];
        $material->issue_material =$data[0]['issue_material'];
        $material->remaining_material =$data[0]['remaining_material'];
        $material->remark =$data[0]['remark']; // Assign the remar
        $material->app_status =$data[0]['status'];
        // echo json_encode($material);
        // exit();
        $material->save();

    }
    return back()->with('success','record update successfully');
}



// ----------------------------------Non Consumed Material -------------------------------------------

public function site_non_consumed_material()
{
     // Fetch all requested materials where status is null and group by date and site_id
     $requestedMaterial = RequestedMaterial::where('material_type', 'Non-Consumable')
     ->whereNull('status')
     ->orderBy('created_at', 'desc')
     ->get()
     ->groupBy(function($item) {
         return $item->created_at->format('Y-m-d') . '_' . $item->site_id;
     });

    $issueMaterial = IssueMaterialByInventory::where('material_type', 'Non-Consumable')->get();
    // // Fetch all requested materials and group by date and site_id
    // $requestedMaterial = RequestedMaterial::all()->groupBy(function($item) {
    //     return $item->created_at->format('Y-m-d') . '_' . $item->site_id;
    // });
    return view('inventory_managmt.site_non_consumed_material', compact('requestedMaterial', 'issueMaterial'));
}


public function getNonConsumable_AvailableMaterial(Request $request)
{
    // dd($request->all());
    $warehouseId = $request->warehouse_id;
    $materialId = $request->material_id;
    $brandId = $request->brand_id;
    $rawmaterialId = $request->rawmaterial_id;

    // Fetch available material based on the warehouse_id
    $availableMaterial = AvailableMaterial::where('warehouse_id', $warehouseId)
    ->where('material_id', $materialId)
    ->where('brand_id', $brandId)
    ->orwhere('raw_material_id', $rawmaterialId)
    ->where('type','Non-Consumable')
    ->first();
// echo json_encode($availableMaterial);
// echo json_encode($warehouseId);
// echo json_encode($materialId);
// echo json_encode($brandId);
// exit();
    if ($availableMaterial) {
        return response()->json(['available_material' => $availableMaterial->available_quantity]);
    } else {
        return response()->json(['available_material' => 0]);
    }
}


public function nonConsumable_addIssuedMaterial(Request $request)
{
    $data = $request->input('data'); // Retrieve the array of data from the form

    if (is_null($data)) {
        return redirect()->route('site-non-consumed-material')->with('error', 'No data received!');
    }
// dd($data);
    foreach ($data as $item) {
        // Validate if the necessary fields are filled out for each row
        if (isset($item['issue_material'])) {
            // Check if 'remark' is not set, assign an empty string as default
            $remark = isset($item['remark']) ? $item['remark'] : '';

            // Debugging: Log the $item and $remark to see their values
            \Log::info('Item:', [$item]);
            \Log::info('Remark:', [$remark]);

            // Find the requested material by ID
            $requestedMaterial = RequestedMaterial::find($item['id']);

            if ($requestedMaterial) {
                // Create a new instance of IssueMaterialByInventory
                $material = new IssueMaterialByInventory();
                $material->requested_material_date = $requestedMaterial->created_at;
                $material->site_id = $requestedMaterial->site_id;
                $material->material_type = $requestedMaterial->material_type;
                $material->requested_material_id = $item['id'];
                $material->material_id = $item['material'];
                $material->raw_material_id = $item['raw_material'];
                $material->brand_id = $item['brand'];
                $material->requested_material_quantity = $item['quantity'];
                // $material->material_unit_id = $item['unit_type'];
                $material->selected_warehouse_id = $item['warehouse'];
                $material->available_material = $item['available_material'];
                $material->issue_material = $item['issue_material'];
                $material->remaining_material = $item['remaining_material'];
                $material->remark = $remark; // Assign the remark
                $material->app_status = $item['status'];
                $material->issue_type = 'Direct Issue';
                $material->save();
                // Update the status of the requested material to 'Submitted'
                $requestedMaterial->update(['status' => 'Submitted']);
            }
        //     $availableMaterial = AvailableMaterial::where('warehouse_id', $item['warehouse'])
        //     ->where('material_id', $item['material'])
        //     ->where('brand_id',$item['brand'])
        //     ->orwhere('raw_material_id',$item['raw_material'])
        //     ->where('type', 'Non-Consumable')
        //     ->first();
    
        // // If available material is found, update the quantity
        // if ($availableMaterial) {
        //     $availableMaterial->available_quantity = $item['remaining_material'];
        //     $availableMaterial->save();
    
        // }
    }
}
    return redirect()->back()->with('success', 'Requests added successfully!');
}

public function non_consumable_viewservicearea(Request $request)
{
    // Ensure that 'date' and 'site_id' parameters are provided
    if (!$request->has(['date', 'site_id'])) {
        return response()->json(['html' => '<p>Invalid request parameters</p>']);
    }

    // Fetch requested materials based on the date and site ID
    $appendData = RequestedMaterial::whereDate('created_at', $request->date)
                                   ->where('site_id', $request->site_id)
                                   ->where('material_type', 'Non-Consumable')
                                   ->where('status', Null)
                                   ->get();
    $warehouseId = Warehouse::all();
    $statusId = Status::all();
// dd($appendData);
    // Check if no records are found
    if ($appendData->isEmpty()) {
        return response()->json(['html' => '<p>No data found</p>', 'status' => 'error', 'message' => 'No data found']);
    }

    $render_view = view('inventory_managmt.non_consumable_site_material_view', compact('appendData', 'warehouseId', 'statusId'))->render();
    return response()->json(['html' => $render_view, 'status' => 'success', 'message' => 'Data loaded successfully']);
}

public function non_consumable_viewservicearea_edit(Request $request)
{
    // dd($request->id);
    // Ensure that 'date' and 'site_id' parameters are provided
    if (!$request->has(['id'])) {
        return response()->json(['html' => '<p>Invalid request parameters</p>']);
    }

    // Fetch requested materials based on the date and site ID
    $appendData = IssueMaterialByInventory::
                                   where('id', $request->id)
                                   ->get();
    $warehouseId = Warehouse::all();
    $statusId = Status::all();
    // echo json_encode($appendData);
// dd($statusId);
        $availableMaterial = AvailableMaterial::where('warehouse_id', $appendData[0]->selected_warehouse_id)
        ->where('material_id', $appendData[0]->material_id)
        ->where('brand_id', $appendData[0]->brand_id)
        ->orwhere('raw_material_id', $appendData[0]->raw_material_id)
        ->where('type','Non-Consumable')
        ->first();
//     echo json_encode($appendData[0]->selected_warehouse_id);
// exit();
    // Check if no records are found
    // if ($appendData->isEmpty()) {
    //     return response()->json(['html' => '<p>No data found</p>', 'status' => 'error', 'message' => 'No data found']);
    // }

    $render_view = view('inventory_managmt.edit_non_consumable_site_material', compact('appendData', 'warehouseId', 'statusId','availableMaterial'))->render();
    return response()->json(['html' => $render_view, 'status' => 'success', 'message' => 'Data loaded successfully']);
}

public function update_non_consumable_site_material(Request $request)
    {
    // dd($request->input('data'));
        $data = $request->input('data');
    
        $id = $data[0]['id'];
       $requested_material_date =  $data[0]['raw_material_id'];
        $material = IssueMaterialByInventory::where('id',$id)->first();
    // echo json_encode( $data );
    // echo json_encode( $material );
    // echo json_encode( $requested_material_date );
    // exit(); 
        if ($material) {
        //     // Create a new instance of IssueMaterialByInventory
            // $material = new IssueMaterialByInventory();
            $material->requested_material_date =$material->requested_material_date;
            $material->site_id =$material->site_id;
            $material->material_type =$material->material_type;
            $material->requested_material_id =$material->requested_material_id;
            $material->material_unit_id =$material->material_unit_id;
            $material->material_id = $data[0]['material_id'];
            $material->raw_material_id =$data[0]['raw_material_id'];
            $material->brand_id =$data[0]['brand_id'];
            $material->requested_material_quantity =$data[0]['requested_material_quantity'];
            $material->selected_warehouse_id =$data[0]['selected_warehouse_id'];
            $material->available_material =$data[0]['available_material'];
            $material->issue_material =$data[0]['issue_material'];
            $material->remaining_material =$data[0]['remaining_material'];
            $material->remark =$data[0]['remark']; // Assign the remar
            $material->app_status =$data[0]['status'];
            $material->issue_type = 'Direct Issue';
            // echo json_encode($material);
            // exit();
            $material->save();
    
        }

    //     $availableMaterial = AvailableMaterial::where('warehouse_id', $data[0]['selected_warehouse_id'])
    //     ->where('material_id', $data[0]['material_id'])
    //     ->where('brand_id',$data[0]['brand_id'])
    //     ->orwhere('raw_material_id',$data[0]['raw_material_id'])
    //     ->where('type', 'Non-Consumable')
    //     ->first();

    // // If available material is found, update the quantity
    // if ($availableMaterial) {
    //     $availableMaterial->available_quantity =$data[0]['remaining_material'];
    //     $availableMaterial->save();

    // }
        return back()->with('success','record update successfully');
    }
    

public function non_consumable_add_material(Request $request)
{
    $material = NonConsumableCategory::all();
    $brand = NonConsumableBrand::all();
    $unit = NonConsumableUnitType::all();
    $addMaterial = NonConsumableMaterial::all();
    // echo json_encode($addMaterial);
    // exit();
    // $rawmaterial = RawMaterial::all();
    $warehouse = Warehouse::all();
    return view('inventory_managmt.non_consumable_add_material', compact('warehouse', 'material', 'brand', 'unit', 'addMaterial'));
}

public function getNonConsumableMaterialBrands(Request $request)
{
    $material_id = $request->get('material_id');
    $brands = NonConsumableBrand::where('material_id', $material_id)->get();

    return response()->json($brands);
}

public function getsubcategory(Request $request)
{
    $category_id = $request->get('category_id');
    $category_name = NonConsumableCategoryMaterial::where('category_id', $category_id)->get();

    return response()->json($category_name);
}


public function addNonConsumableMaterialstore(Request $request)
{
    // dd($request->all());
    $material = new NonConsumableMaterial();
    $material->date = $request->date;
    $material->warehouse_id = $request->warehouse;
    $material->material_id = $request->material;
    $material->brand_id = $request->brand;
    $material->material_unit_id = $request->unit_type;
    $material->quantity = $request->quantity;
    $material->raw_material_id = $request->raw_material;
    $material->issue_type = 'Indirect Issue';
// dump( $material);
    $material->save();
    return redirect()->route('non_consumable_add_material')->with('success', 'Request added successfully!');
}

public function Nonconsumable_directIssueMaterial(Request $request)
    {
        $material = NonConsumableCategory::all();
        $brand = NonConsumableBrand::all();
        $unit = NonConsumableUnitType::all();
        $addMaterial = NonConsumableMaterial::all();
        // $rawmaterial = RawMaterial::all();
        $warehouse = Warehouse::all();
        $site = Site::all();
        $supervisor = Supervisor::all();
        $issue = NonConsumableDirectIssueMaterial::all();
        return view('inventory_managmt.non_consumable_direct_issue_material', compact('issue', 'site', 'warehouse', 'material', 'brand', 'unit', 'addMaterial','supervisor'));
    }

    public function Nonconsumable_addDirectIssueMaterial(Request $request)
    {
        $material = new NonConsumableDirectIssueMaterial();
        $material->date = $request->date;
        // $material->time = $request->time;
        $material->site_id = $request->site;
        $material->supervisor_id = $request->supervisor;
        $material->warehouse_id = $request->warehouse;
        $material->material_id = $request->material;
        $material->brand_id = $request->brand;
        $material->unit_id = $request->unit_type;
        // $material->raw_material_id = $request->raw_material;
        $material->quantity = $request->quantity;
        $material->remark = $request->remark;
        $material->issue_type = 'Direct Issue';

        $material->save();
        return redirect()->route('non_consumable_direct_issue_material')->with('success', 'Request added successfully!');
    }

    public function Nonconsumable_directIssueMaterial_edit(Request $request)
    {
        $materials = NonConsumableCategoryMaterial::all();
        $category = NonConsumableCategory::all();
        $brand = NonConsumableBrand::all();
        $unit = NonConsumableUnitType::all();
        $addMaterial = NonConsumableMaterial::all();
        // $rawmaterial = RawMaterial::all();
        $warehouse = Warehouse::all();
        $site = Site::all();
        $supervisor = Supervisor::all();
        $edit_material = NonConsumableDirectIssueMaterial::find($request->id);
        return view('inventory_managmt.edit_non_consumable_direct_issue_material', compact('edit_material', 'site', 'warehouse', 'materials', 'brand', 'unit', 'addMaterial','supervisor','category'));
    }

    public function Nonconsumable_DirectIssueMaterial_update(Request $request)
    {
        $material = NonConsumableDirectIssueMaterial::find($request->id);
        $material->date = $request->date;
        // $material->time = $request->time;
        $material->site_id = $request->site;
        $material->supervisor_id = $request->supervisor;
        $material->warehouse_id = $request->warehouse;
        $material->material_id = $request->material;
        $material->brand_id = $request->brand;
        $material->unit_id = $request->unit_type;
        // $material->raw_material_id = $request->raw_material;
        $material->quantity = $request->quantity;
        $material->remark = $request->remark;
        $material->issue_type = 'Direct Issue';
        $material->save();
        return redirect()->route('non_consumable_direct_issue_material')->with('success', 'Request added successfully!');
    }
    


    
// ---------------------------------------------------------------------------------------------------


    public function add_material(Request $request)
    {
        $material = Material::all();
        $brand = Brand::all();
        $unit = UnitType::all();
        $addMaterial = AddMaterial::all();
        $rawmaterial = RawMaterial::all();
        $warehouse = Warehouse::all();
        return view('adminpanel.add_material', compact('warehouse', 'material', 'brand', 'unit', 'addMaterial', 'rawmaterial'));
    }


    public function getMaterialBrands(Request $request)
    {
        $material_id = $request->get('material_id');
        $brands = Brand::where('material_id', $material_id)->get();

        return response()->json($brands);
    }


    public function getRawMaterial(Request $request)
    {
        $brand_id = $request->get('brand_id');
        $rawMaterials = RawMaterial::where('brand_id', $brand_id)->get();

        return response()->json($rawMaterials);
    }

    public function addMaterialstore(Request $request)
    {
        $material = new AddMaterial();
        $material->date = $request->date;
        $material->warehouse_id = $request->warehouse;
        $material->material_id = $request->material;
        $material->brand_id = $request->brand;
        $material->material_unit_id = $request->unit_type;
        $material->raw_material_id = $request->raw_material;
        $material->quantity = $request->quantity;

        $material->save();
        return redirect()->route('add_material')->with('success', 'Request added successfully!');
    }


    public function directIssueMaterial(Request $request)
    {
        $material = Material::all();
        $brand = Brand::all();
        $unit = UnitType::all();
        $addMaterial = AddMaterial::all();
        $rawmaterial = RawMaterial::all();
        $warehouse = Warehouse::all();
        $site = Site::all();
        $supervisor = Supervisor::all();
        $issue = IssueMaterialByInventory::all();

        return view('adminpanel.direct_issue_material', compact('issue', 'site', 'warehouse', 'material', 'brand', 'unit', 'addMaterial', 'rawmaterial', 'supervisor'));
    }

    public function addDirectIssueMaterial(Request $request)
    {
        $material = new IssueMaterialByInventory();
        $material->requested_material_date = $request->date;
        // $material->time = $request->time;
        $material->site_id = $request->site;
        // $material->supervisor_id = $request->supervisor;
        $material->selected_warehouse_id = $request->warehouse;
        $material->material_id = $request->material;
        $material->brand_id = $request->brand;
        $material->material_unit_id = $request->unit_type;
        $material->raw_material_id = $request->raw_material;
        $material->requested_material_quantity = $request->quantity;
        $material->remark = $request->remark;
        $material->issue_type = 'Direct Issue';

        $material->save();
        return redirect()->route('direct-issue-material')->with('success', 'Request added successfully!');
    }


    public function editDirectIssueMaterial($id)
    {
        $issueEdit = IssueMaterialByInventory::find($id);
        $issueUpdate = IssueMaterialByInventory::all();
        $material = Material::all();
        $brand = Brand::all();
        $unit = UnitType::all();
        $addMaterial = AddMaterial::all();
        $rawmaterial = RawMaterial::all();
        $warehouse = Warehouse::all();
        $site = Site::all();
        $supervisor = Supervisor::all();
        $issue = DirectIssueMaterial::all();

        return view('adminpanel.direct_issue_material_edit', compact('issueEdit', 'issueUpdate', 'issue', 'site', 'warehouse', 'material', 'brand', 'unit', 'addMaterial', 'rawmaterial', 'supervisor'));

    }

    public function updateDirectIssueMaterial(Request $request)
    {
        $material = IssueMaterialByInventory::find($request->id);
        if (!$material) {
            return redirect()->back()->with('error', 'Material not found');
        }
        $material->requested_material_date = $request->date;
        $material->site_id = $request->site;
        $material->selected_warehouse_id = $request->warehouse;
        $material->material_id = $request->material;
        $material->brand_id = $request->brand;
        $material->material_unit_id = $request->unit_type;
        $material->raw_material_id = $request->raw_material;
        $material->requested_material_quantity = $request->quantity;
        $material->remark = $request->remark;
        $material->issue_type = 'Direct Issue';

        $material->save();

        return redirect(route('direct-issue-material'))->with('success', 'Successfully Updated !');
    }



}
