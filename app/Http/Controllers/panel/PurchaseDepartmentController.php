<?php

namespace App\Http\Controllers\panel;
use App\Http\Controllers\Controller;
use App\Models\Inventory\AddMaterial;
use App\Models\PO\{MaterialRequestList, DirectPOList};
use App\Models\Warehouse;

use App\Models\{Vendor, Material, RawMaterial, UnitType, Brand};

use Illuminate\Http\Request;

class PurchaseDepartmentController extends Controller
{

    public function req_material(Request $request)
    {

        $reqMaterial = AddMaterial::all();
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
        }

        return redirect()->back()->with('success', 'Order placed successfully!');
    }


    public function order_details(Request $request)
    {

        $orderDetails = MaterialRequestList::whereNull('invoice_number')->get();
        $order = MaterialRequestList::whereNotNull('invoice_number')->get();

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

        $reqMaterial = DirectPOList::all();
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
        $po = new DirectPOList();
        $po->date = $request->date;
        $po->warehouse_id = $request->warehouse;
        $po->material_id = $request->material;
        $po->brand_id = $request->brand;
        $po->material_unit_id = $request->unit_type;
        $po->raw_material_id = $request->raw_material;
        $po->quantity = $request->quantity;

        $po->save();
        return redirect()->route('add_po')->with('success', 'Request added successfully!');
    }



}
