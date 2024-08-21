<?php

namespace App\Http\Controllers\panel;
use App\Http\Controllers\Controller;
use App\Models\Inventory\AddMaterial;
use App\Models\PO\{MaterialRequestList, DirectPOList};
use App\Models\Warehouse;
use App\Models\Inventory\NonConsumableMaterial;

use App\Models\{Vendor, Material, RawMaterial, UnitType, Brand, NonConsumableBrand, NonConsumableCategoryMaterial, NonConsumableUnitType,NonConsumableCategory};

use Illuminate\Http\Request;

class PurchaseDepartmentController extends Controller
{

    public function req_material(Request $request)
    {

        $reqMaterial = AddMaterial::where('order_status', 'Pending')->get();
        $vendor = Vendor::all();
        return view('adminpanel.req_material', compact('reqMaterial', 'vendor'));
    }

    public function storeOrder(Request $request)
    {

            // Generate a unique order_id
            $orderId = 'OD'.time(); // You can customize the prefix as needed

            $materials = $request->input('materials');
    // dd($request->all());
            foreach ($materials as $material) {
                MaterialRequestList::create([
                    'add_material_id' => $material['add_material_id'],
                    'date' => $material['date'],
                    'warehouse_id' => $material['warehouse_id'],
                    'material_id' => $material['material_id'],
                    'quantity' => $material['quantity'],
                    'material_unit_id' => $material['material_unit_id'],
                    'raw_material_id' => $material['raw_material_id'],
                    'brand_id' => $material['brand_id'],
                    'vendor_id' => $material['vendor_id'],
                    'order_id' => $orderId, // Add the generated order_id here


                ]);
                $order_status = AddMaterial::where('id',$material['add_material_id'])->update([
                    'order_status'=>'Ordered',
    ]);
        }

        return redirect()->back()->with('success', 'Order placed successfully!');
    }


    public function order_details(Request $request)
    {

        $orderDetails = MaterialRequestList::whereNull('invoice_number')
        ->where('type','consumable')
        ->get();
        $order = MaterialRequestList::whereNotNull('invoice_number')
        ->where('type','consumable')
        ->get();

        return view('adminpanel.order_details', compact('orderDetails', 'order'));
    }
    public function feedback(Request $request)
    {
        return view('adminpanel.feedback');
    }

    public function addInvoice(Request $request)

    {
        $order_id = $request->input('order_id');
        $invoice = MaterialRequestList::find($order_id);
    if ($invoice) {
        $invoice->invoice_date = $request->invoice_date;
        $invoice->invoice_number = $request->invoice_number;

        if ($request->hasFile('invoice')) {
            $file = $request->file('invoice');
            $fileName = $file->getClientOriginalName(); // Get original file name
            $file->move(public_path('images/invoice'), $fileName); // Move file to public/images/invoice directory
            $invoice->invoice = $fileName; // Save file name to the database
        }

        $invoice->save();

        return redirect()->back()->with('success', 'Invoice added successfully.');
    } else {
        return redirect()->back()->with('error', 'Order not found.');
    }
    }


    // direct po

    public function directPoList(Request $request)
    {

        $reqMaterial = MaterialRequestList::whereNotNull('order_by')->get();
        $vendor = Vendor::all();
        $material = Material::all();
        $rawmaterial = RawMaterial::all();
        $unit = UnitType::all();
        $brand = Brand::all();
        $warehouse = Warehouse::all();

        return view('adminpanel.direct_po_list', compact('reqMaterial', 'vendor', 'material', 'rawmaterial', 'unit', 'brand', 'warehouse'));
    }


    public function storeDirectPOList(Request $request)
    {

        $orderId = 'OD'.time(); // You can customize the prefix as needed

        $po = new MaterialRequestList();
        $po->date = $request->date;
        $po->warehouse_id = $request->warehouse;
        $po->material_id = $request->material;
        $po->brand_id = $request->brand;
        $po->material_unit_id = $request->unit_type;
        $po->raw_material_id = $request->raw_material;
        $po->quantity = $request->quantity;
        $po->vendor_id = $request->vendor;
        $po->order_id = $orderId; // Add the generated order_id here
        $po->order_by = 'Direct Order';

        $po->save();
        return redirect()->route('direct-po-list')->with('success', 'Request added successfully!');
    }

    public function editDirectPoList($id)
    {
        $issueEdit = MaterialRequestList::find($id);
        $issueAll = MaterialRequestList::all();
        $vendor = Vendor::all();
        $material = Material::all();
        $rawmaterial = RawMaterial::all();
        $unit = UnitType::all();
        $brand = Brand::all();
        $warehouse = Warehouse::all();

        return view('adminpanel.direct_po_list_edit', compact('issueEdit', 'issueAll', 'vendor',  'warehouse', 'material', 'brand', 'unit', 'rawmaterial'));

    }

    public function updateDirectPoList(Request $request)
    {
        $po = MaterialRequestList::find($request->id);
        if (!$po) {
            return redirect()->back()->with('error', 'PO not found');
        }

        $po->date = $request->date;
        $po->warehouse_id = $request->warehouse;
        $po->material_id = $request->material;
        $po->brand_id = $request->brand;
        $po->material_unit_id = $request->unit_type;
        $po->raw_material_id = $request->raw_material;
        $po->quantity = $request->quantity;
        $po->vendor_id = $request->vendor;
        // $po->order_id = $request->input($po->order_id);

        // $po->order_id = $orderId; // Add the generated order_id here
        $po->order_by = 'Direct Order';

        $po->save();

        return redirect(route('direct-po-list'))->with('success', 'Successfully Updated !');
    }

    //non consumable material list

    public function non_consume_req_material(Request $request)
    {

        $reqMaterial = NonConsumableMaterial::where('order_status','Pending')->get();
        $vendor = Vendor::all();
        return view('non_consume_purchase_dept.non_consumable_material', compact('reqMaterial', 'vendor'));
    }

    public function non_consume_storeOrder(Request $request)
    {
// dd($request->all());
            // Generate a unique order_id
            $orderId = 'OD'.time(); // You can customize the prefix as needed

            $materials = $request->input('materials');
    // dd($request->all());
            foreach ($materials as $material) {
                MaterialRequestList::create([
                    'add_material_id' => $material['add_material_id'],
                    'date' => $material['date'],
                    'warehouse_id' => $material['warehouse_id'],
                    'material_id' => $material['material_id'],
                    'quantity' => $material['quantity'],
                    'material_unit_id' => $material['material_unit_id'],
                    'raw_material_id' => $material['raw_material_id'],
                    'brand_id' => $material['brand_id'],
                    'vendor_id' => $material['vendor_id'],
                    'order_id' => $orderId, // Add the generated order_id here
                    'type' => 'non-consumable',
                ]);

                $order_status = NonConsumableMaterial::where('id',$material['add_material_id'])->update([
                                'order_status'=>'Ordered',
                ]);
        }

        return redirect()->back()->with('success', 'Order placed successfully!');
    }

    public function non_consumable_order_list(Request $request)
    {

        $orderDetails = MaterialRequestList::whereNull('invoice_number')
        ->where('type','non-consumable')
        ->get();
        $order = MaterialRequestList::whereNotNull('invoice_number')
        ->where('type','non-consumable')
        ->get();

        return view('non_consume_purchase_dept.non_consumable_order_list', compact('orderDetails', 'order'));
    }

    public function non_consumable_addInvoice(Request $request)

    {
        $order_id = $request->input('order_id');
        $invoice = MaterialRequestList::find($order_id);
    if ($invoice) {
        $invoice->invoice_date = $request->invoice_date;
        $invoice->invoice_number = $request->invoice_number;

        if ($request->hasFile('invoice')) {
            $file = $request->file('invoice');
            $fileName = $file->getClientOriginalName(); // Get original file name
            $file->move(public_path('images/invoice'), $fileName); // Move file to public/images/invoice directory
            $invoice->invoice = $fileName; // Save file name to the database
        }

        $invoice->save();

        return redirect()->back()->with('success', 'Invoice added successfully.');
    } else {
        return redirect()->back()->with('error', 'Order not found.');
    }
    }

    public function non_consumable_directPoList(Request $request)
    {

        $reqMaterial = MaterialRequestList::whereNotNull('order_by')
        ->where('type','non-consumable')
        ->get();
        $vendor = Vendor::all();
        $material = NonConsumableCategory::all();
        $sub_category = NonConsumableCategoryMaterial::all();
        $unit = NonConsumableUnitType::all();
        $brand = NonConsumableBrand::all();
        $warehouse = Warehouse::all();

        return view('non_consume_purchase_dept.non_consumable_direct_po_list', compact('reqMaterial', 'vendor', 'material', 'sub_category', 'unit', 'brand', 'warehouse'));
    }


    public function non_consumable_storeDirectPOList(Request $request)
    {

        $orderId = 'OD'.time(); // You can customize the prefix as needed

        $po = new MaterialRequestList();
        $po->date = $request->date;
        $po->warehouse_id = $request->warehouse;
        $po->material_id = $request->material;
        $po->brand_id = $request->brand;
        $po->material_unit_id = $request->unit_type;
        $po->raw_material_id = $request->raw_material;
        $po->quantity = $request->quantity;
        $po->vendor_id = $request->vendor;
        $po->order_id = $orderId; // Add the generated order_id here
        $po->order_by = 'Direct Order';
        $po->type = 'non-consumable';
        $po->add_material_id = 0;
        $po->save();
        return redirect()->route('non_consumable_directPoList')->with('success', 'Request added successfully!');
    }

    public function non_consumable_editDirectPoList($id)
    {

        $issueEdit = MaterialRequestList::find($id);
        $issueAll = MaterialRequestList::all();
        $vendor = Vendor::all();
        $material = NonConsumableCategory::all();
        $rawmaterial = NonConsumableCategoryMaterial::all();
        $unit = NonConsumableUnitType::all();
        $brand = NonConsumableBrand::all();
        $warehouse = Warehouse::all();

        return view('non_consume_purchase_dept.edit_non_consumable_direct_po_list', compact('issueEdit', 'issueAll', 'vendor',  'warehouse', 'material', 'brand', 'unit', 'rawmaterial'));

    }

    public function non_consumable_updateDirectPoList(Request $request)
    {
        $po = MaterialRequestList::find($request->id);
        if (!$po) {
            return redirect()->back()->with('error', 'PO not found');
        }

        $po->date = $request->date;
        $po->warehouse_id = $request->warehouse;
        $po->material_id = $request->material;
        $po->brand_id = $request->brand;
        $po->material_unit_id = $request->unit_type;
        $po->raw_material_id = $request->raw_material;
        $po->quantity = $request->quantity;
        $po->vendor_id = $request->vendor;
        $po->type = 'non-consumable';
        // $po->order_id = $request->input($po->order_id);

        // $po->order_id = $orderId; // Add the generated order_id here
        $po->order_by = 'Direct Order';

        $po->save();

        return redirect(route('non_consumable_directPoList'))->with('success', 'Successfully Updated !');
    }

}
