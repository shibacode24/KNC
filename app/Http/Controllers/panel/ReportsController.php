<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{AvailableMaterial, Warehouse, Material, ConsumedMaterialByWorkplace, LostMaterial, RequestedMaterial} ;


class ReportsController extends Controller
{

// Consumable Inventory
    public function consumableAvailableMaterial(Request $request)
    {
        $availableMaterial = AvailableMaterial::where('type', 'Consumable')->get();
        $warehouse = Warehouse::all();
        $material = Material::all();
        return view('consumable_inventory_report.available_material', compact('availableMaterial', 'warehouse', 'material'));

    }

    public function consumableConsumedMaterial(Request $request)
    {
        $consumedMaterial = ConsumedMaterialByWorkplace::all();
        $warehouse = Warehouse::all();
        $material = Material::all();
        return view('consumable_inventory_report.consumed_material', compact('consumedMaterial', 'warehouse', 'material'));

    }

    public function consumableLostMaterial(Request $request)
    {
        $lostMaterial = LostMaterial::where('material_type', 'Consumable')->get();
        $warehouse = Warehouse::all();
        $material = Material::all();
        return view('consumable_inventory_report.lost_material', compact('lostMaterial', 'warehouse', 'material'));

    }

    public function consumableReceivedMaterial(Request $request)
    {
        $receivedMaterial = RequestedMaterial::where('material_type', 'Consumable')
        ->where('status', 'Submitted')->get();
        $warehouse = Warehouse::all();
        $material = Material::all();
        return view('consumable_inventory_report.received_material', compact('receivedMaterial', 'warehouse', 'material'));

    }
}
