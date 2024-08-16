<?php

namespace App\Http\Controllers\panel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\City;
use App\Models\Firm;
use App\Models\Site;
use App\Models\User;
use App\Models\Brand;
use App\Models\Branch;
use App\Models\Client;
use App\Models\Vendor;
use App\Models\Employee;
use App\Models\Material;
use App\Models\UnitType;
use App\Models\AssignSite;
use App\Models\Contractor;
use App\Models\Supervisor;
use App\Models\Warehouse;
use App\Models\RawMaterial;
use App\Models\AccountDetails;
use App\Models\Status;
use App\Models\TaskCategory;
use App\Models\TaskSubCategory;
use App\Models\Issues;
use App\Models\WorkingUnitType;
use App\Models\Approles;
use App\Models\Engineer;
use App\Models\Site_Manager;
use App\Models\Site_Incharge;
use App\Models\NonConsumableUnitType;
use App\Models\NonConsumableBrand;
use App\Models\{PanelRoles, NonConsumableCategory, NonConsumableCategoryMaterial};


use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('adminpanel.login');
    }

    public function dashboard(Request $request)
    {
        return view('adminpanel.dashboard');
    }

    public function assign_site(Request $request)
    {
        $site = Site::all();
        $supervisor = supervisor::all();
        $assignSite = AssignSite::all();
        $role = PanelRoles::all();
        $user = User::whereNotNull('panel_role')->get();
        return view('adminpanel.assign_site', compact('site', 'assignSite', 'supervisor', 'role', 'user'));
    }

    public function getUsersByRole(Request $request)
    {
        $roleId = $request->get('role_id');
        $users = User::where('role', $roleId)
        ->where('name', '<>', 'admin')->get();
        return response()->json($users);
    }

    public function assignSiteStore(Request $request)
    {
        //  dd($request->all());
        // Validate the incoming request data
        // $request->validate([
        //     'site_id' => 'required|',
        //     'supervisor_id' => 'required|',
        //     'date' => 'required|',
        // ]);
        $assign = new AssignSite();
        $assign->date = $request->date;
        $assign->site_assign = $request->site;
        $assign->role_id = $request->role;
        $assign->user_id = $request->assign_to;
        $assign->save();
        return redirect()->route('assign_site')->with('success', 'Site added successfully!');
    }

    public function assignSiteDestroy($id)
    {
        $task = AssignSite::find($id)->delete();
        return redirect()->route('assign_site')->with('success', 'Site is Deleted Successfully');
    }

    public function assignSiteEdit($id){
        $assignSiteAll = AssignSite::all();
        $assignSiteEdit = AssignSite::find($id);
        $site = Site::all();
        $supervisor = supervisor::all();
        $assignSite = AssignSite::all();
        $role = PanelRoles::all();
        $user = User::whereNotNull('panel_role')->get();
        return view('adminpanel.assign_site_edit', compact('assignSiteAll', 'assignSiteEdit', 'site', 'supervisor', 'role', 'user'));
    }

    public function assignSiteUpdate(Request $request)
    {
        $assign = AssignSite::find($request->id);
        $assign->date = $request->date;
        $assign->site_assign = $request->site;
        $assign->role_id = $request->role;
        $assign->user_id = $request->assign_to;
        $assign->save();


        return redirect(route('assign_site'))->with('success', 'Successfully Updated !');
    }


    //citymaster
    public function city(Request $request)
    {
        $city = City::all();
        return view('adminpanel.city', compact('city'));
    }
    public function citystore(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'city' => 'required|',

        ]);
        $city = new City();
        $city->city = $request->city;

        $city->save();
        return redirect()->route('city')->with('success', 'City added successfully!');
    }

    public function cityDestroy($id)
    {
        $task = City::find($id)->delete();
        return redirect()->route('city')->with('success', 'City is Deleted Successfully');
    }



    public function cityEdit($id){

        $cityAll = City::all();
        $cityEdit = City::find($id);
        return view('adminpanel.city_edit', compact('cityAll', 'cityEdit'));
    }

    public function cityUpdate(Request $request)
    {
        $city = City::find($request->id);
        $city->city = $request->city;
        $city->save();


        return redirect(route('city'))->with('success', 'Successfully Updated !');
    }



    //firm master
    public function firm(Request $request)
    {
        $firm = Firm::all();
        $city = City::all();
        return view('adminpanel.firm', compact('city', 'firm'));
    }

    public function firmstore(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'firm_name' => 'required|string|',
            'contact_person_name' => 'required|string|',
            'contact_number' => 'required|string|',
            'city_id' => 'required|',
            'city_address' => 'required|string|',
            'latitude' => 'required|regex:/^-?\d{1,2}(?:\.\d{1,9})?$/',
            'longitude' => 'required|regex:/^-?\d{1,3}(?:\.\d{1,9})?$/',


            'gst' => 'required|string|',
        ]);

        // Create a new firm instance
        $firm = new Firm();
        $firm->firm_name = $request->firm_name;
        $firm->contact_person_name = $request->contact_person_name;
        $firm->contact_number = $request->contact_number;
        $firm->city_id = $request->city_id;
        $firm->city_address = $request->city_address;
        $firm->latitude = $request->latitude;
        $firm->longitude = $request->longitude;
        $firm->gst = $request->gst;

        // Save the firm to the database
        $firm->save();

        // Redirect to a specified route or view
        return redirect()->route('firm')->with('success', 'Firm added successfully!');
    }

    public function firmDestroy($id)
    {
        $task = Firm::find($id)->delete();
        return redirect()->route('firm')->with('success', 'Firm is Deleted Successfully');
    }



    public function firmEdit($id){

        $firmAll = Firm::all();
        $firmEdit = Firm::find($id);
        $city = City::all();

        return view('adminpanel.firm_edit', compact('firmAll', 'firmEdit', 'city', ));
    }

    public function firmUpdate(Request $request)
    {
        $firm = Firm::find($request->id);
        $firm->firm_name = $request->firm_name;
        $firm->contact_person_name = $request->contact_person_name;
        $firm->contact_number = $request->contact_number;
        $firm->city_id = $request->city_id;
        $firm->city_address = $request->city_address;
        $firm->latitude = $request->latitude;
        $firm->longitude = $request->longitude;
        $firm->gst = $request->gst;

        $firm->save();


        return redirect(route('firm'))->with('success', 'Successfully Updated !');
    }


    //branchmaster
    public function branch(Request $request)
    {
        $branch = Branch::all();
        return view('adminpanel.branch', compact('branch'));
    }
    public function branchstore(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'branch' => 'required|',

        ]);
        $branch = new Branch();
        $branch->branch = $request->branch;

        $branch->save();
        return redirect()->route('branch')->with('success', 'Branch added successfully!');
    }

    public function branchDestroy($id)
    {
        $task = Branch::find($id)->delete();
        return redirect()->route('branch')->with('success', 'Branch is Deleted Successfully');
    }



    public function branchEdit($id){

        $branchAll = Branch::all();
        $branchEdit = Branch::find($id);
        return view('adminpanel.branch_edit', compact('branchAll', 'branchEdit'));
    }

    public function branchUpdate(Request $request)
    {
        $branch = Branch::find($request->id);
        $branch->branch = $request->branch;
        $branch->save();


        return redirect(route('branch'))->with('success', 'Successfully Updated !');
    }


    //client master

    public function client(Request $request)
    {
        $client = Client::all();
        $city = City::all();
        return view('adminpanel.client', compact('client', 'city'));
    }
    public function clientstore(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'mobile_number' => 'required|',
            'whatsapp_number' => 'required|',
            'aadhar_number' => 'required|',
            'pan_number' => 'required|string',
            'city_id' => 'required|',
            'address' => 'required|',
        ]);

        $client = new Client();
        $client->name = $request->input('name');
        $client->email = $request->input('email');
        $client->mobile_number = $request->input('mobile_number');
        $client->whatsapp_number = $request->input('whatsapp_number');
        $client->aadhar_number = $request->input('aadhar_number');
        $client->pan_number = $request->input('pan_number');
        $client->city_id = $request->input('city_id');
        $client->city_address = $request->input('address');
        $client->save();

        return redirect()->route('client')->with('success', 'Client added successfully!');
        //dd(1);
    }

    public function clientDestroy($id)
    {
        $task = Client::find($id)->delete();
        return redirect()->route('client')->with('success', 'Client is Deleted Successfully');
    }




    public function clientEdit($id){

        $clientAll = Client::all();
        $clientEdit = Client::find($id);
        $city = City::all();
        //$supervisor = supervisor::all();
        return view('adminpanel.client_edit', compact('clientAll', 'clientEdit', 'city', ));
    }

    public function clientUpdate(Request $request)
    {
        $client = Client::find($request->id);
        $client->name = $request->input('name');
        $client->email = $request->input('email');
        $client->mobile_number = $request->input('mobile_number');
        $client->whatsapp_number = $request->input('whatsapp_number');
        $client->aadhar_number = $request->input('aadhar_number');
        $client->pan_number = $request->input('pan_number');
        $client->city_id = $request->input('city_id');
        $client->city_address = $request->input('address');
        $client->save();


        return redirect(route('client'))->with('success', 'Successfully Updated !');
    }



    // Site Master

    public function site(Request $request)
    {
        $site = Site::all();
        $firm = Firm::all();
        $client = Client::all();
        $city = City::all();

        return view('adminpanel.sites', compact('site', 'firm', 'city', 'client'));
    }
    public function siteStore(Request $request)
    {
        //  dd($request->all());
        $validatedData = $request->validate([
            'firm_id' => 'required',
            'client_id' => 'required',
            'site_name' => 'required',
            'site_personal_or_buisness' => 'required',
            'mobile_number' => 'required',
            'city_id' => 'required',
            'city_address' => 'required',
            'latitude' => 'required|regex:/^-?\d{1,2}(?:\.\d{1,9})?$/',
            'longitude' => 'required|regex:/^-?\d{1,3}(?:\.\d{1,9})?$/',
            'site_description' => 'required',
            'site_documents' => 'required|',
            //'buisness_name' => 'nullable|',
        ]);

        $site = new Site();
        $site->firm_id = $request->firm_id;
        $site->client_id = $request->client_id;
        $site->site_name = $request->site_name;
        $site->site_personal_or_buisness = $request->site_personal_or_buisness;
        $site->mobile_number = $request->mobile_number;
        $site->city_id = $request->city_id;
        $site->city_address = $request->city_address;
        $site->latitude = $request->latitude;
        $site->longitude = $request->longitude;
        $site->site_description = $request->site_description;

        if ($request->filled('buisness_name')) {
            $site->buisness_name = $request->buisness_name;
        }

        // Handle file upload
        if ($request->hasFile('site_documents')) {
            $file = $request->file('site_documents');
            $fileName = $file->getClientOriginalName(); // Get original file name
            $file->move(public_path('images/site'), $fileName); // Move file to public/images/site directory
            $site->site_documents = $fileName; // Save file name to the database
        }

        $site->save();
        //  dd(1);
        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Site created successfully.');
    }



    public function sitesindex(Request $request, $id = null)
    {
        if ($request->ajax()) {
            if ($id) {
                $sites = Site::with('cityname', 'firm', 'client')->findOrFail($id); // Use findOrFail to handle not found
            } else {
                $sites = Site::with('cityname', 'firm', 'client')->get();
            }

            return response()->json($sites);
        }
    }


    public function siteDestroy($id)
    {
        $task = Site::find($id)->delete();
        return redirect()->route('site')->with('success', 'Site is Deleted Successfully');
    }


    public function siteEdit($id){

        $siteAll = Site::all();
        $siteEdit = Site::find($id);
        $city = City::all();

        return view('adminpanel.site_edit', compact('siteAll', 'siteEdit', 'city'));
    }

    public function siteUpdate(Request $request)
    {
        $site = Site::find($request->id);
        $site->firm_id = $request->firm_id;
        $site->client_id = $request->client_id;
        $site->site_name = $request->site_name;
        $site->site_personal_or_buisness = $request->site_personal_or_buisness;
        $site->mobile_number = $request->mobile_number;
        $site->city_id = $request->city_id;
        $site->city_address = $request->city_address;
        $site->latitude = $request->latitude;
        $site->longitude = $request->longitude;
        $site->site_description = $request->site_description;

        if ($request->filled('buisness_name')) {
            $site->buisness_name = $request->buisness_name;
        }

        // Handle file upload
        if ($request->hasFile('site_documents')) {
            $file = $request->file('site_documents');
            $fileName = $file->getClientOriginalName(); // Get original file name
            $file->move(public_path('images/site'), $fileName); // Move file to public/images/site directory
            $site->site_documents = $fileName; // Save file name to the database
        }

        $site->save();

        return redirect(route('site'))->with('success', 'Successfully Updated !');
    }

    //unit master
    public function unit_type(Request $request)
    {
        $unit = UnitType::all();
        return view('adminpanel.unit_type', compact('unit'));
    }
    public function unit_typestore(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'unit_type' => 'required|',

        ]);
        $unit_type = new UnitType();
        $unit_type->unit_type = $request->unit_type;

        $unit_type->save();
        return redirect()->route('unit_type')->with('success', 'Unit added successfully!');
    }

    public function unitTypeDestroy($id)
    {
        $task = UnitType::find($id)->delete();
        return redirect()->route('unit_type')->with('success', 'Unit type is Deleted Successfully');
    }


    public function unitTypeEdit($id){

        $unitTypeAll = UnitType::all();
        $unitTypeEdit = UnitType::find($id);

        return view('adminpanel.unit_type_edit', compact('unitTypeAll', 'unitTypeEdit',));
    }

    public function unitTypeUpdate(Request $request)
    {
        // dd($request->all());
        $unitTypes = UnitType::find($request->id);
        $unitTypes->unit_type = $request->unit_type;
        $unitTypes->save();
        return redirect(route('unit_type'))->with('success', 'Successfully Updated !');
    }

//non consumable unit type

//unit master
public function non_consumable_unit_type(Request $request)
{
    $unit = NonConsumableUnitType::all();
    return view('adminpanel.non_consumable_unit_type', compact('unit'));
}
public function non_consumable_unit_type_store(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'unit_type' => 'required|',

    ]);
    $unit_type = new NonConsumableUnitType();
    $unit_type->unit_type = $request->unit_type;

    $unit_type->save();
    return redirect()->route('non_consumable_unit_type')->with('success', 'Unit added successfully!');
}

public function non_consumable_unit_type_delete($id)
{
    $task = NonConsumableUnitType::find($id)->delete();
    return redirect()->route('non_consumable_unit_type')->with('success', 'Unit type is Deleted Successfully');
}


public function non_consumable_unit_type_edit($id){

    $unitTypeAll = NonConsumableUnitType::all();
    $unitTypeEdit = NonConsumableUnitType::find($id);

    return view('adminpanel.edit_non_consumable_unit_type', compact('unitTypeAll', 'unitTypeEdit',));
}

public function non_consumable_unit_type_update(Request $request)
{
    // dd($request->all());
    $unitTypes = NonConsumableUnitType::find($request->id);
    $unitTypes->unit_type = $request->unit_type;
    $unitTypes->save();
    return redirect(route('non_consumable_unit_type'))->with('success', 'Successfully Updated !');
}

//end of non consumable unit type

 //non consumable brand Master

 public function non_consumablebrand(Request $request)
 {
     $brand = NonConsumableBrand::all();
     $category = NonConsumableCategory::all();
     return view('adminpanel.non_consumable_brand', compact('brand', 'category'));
 }
 public function non_consumablebrandstore(Request $request)
 {
     // Validate the incoming request data
     $request->validate([
         'brand' => 'required|',
         'category_id' => 'required|',


     ]);
     $brand = new NonConsumableBrand();
     $brand->brand = $request->brand;
     $brand->category_id = $request->category_id;

     $brand->save();
     return redirect()->route('non_consumable_brand')->with('success', 'brand added successfully!');
 }

 public function non_consumablebrandDestroy($id)
 {
     $task = NonConsumableBrand::find($id)->delete();
     return redirect()->route('non_consumable_brand')->with('success', 'Brand is Deleted Successfully');
 }



 public function non_consumablebrandEdit($id){

    $brand_edit = NonConsumableBrand::find($id);
    $material = NonConsumableCategoryMaterial::all();
     return view('adminpanel.edit_non_consumable_brand', compact('brand_edit', 'material'));
 }

 public function non_consumablebrandUpdate(Request $request)
 {
     $brand =  NonConsumableBrand::find($request->id);
     $brand->brand = $request->brand;
     $brand->material_id = $request->material_id;

     $brand->save();


     return redirect(route('non_consumable_brand'))->with('success', 'Successfully Updated !');
 }
 //end of non consumable brand
    //material master
    public function material(Request $request)
    {
        $material = Material::all();
        $unit_type = UnitType::all();
        return view('adminpanel.material', compact('material', 'unit_type'));
    }


    public function materialstore(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'material' => 'required|',

        ]);
        $material = new Material();
        $material->material = $request->material;
        $material->unit_type_id = $request->unit_type;


        $material->save();
        return redirect()->route('material')->with('success', 'Material added successfully!');
    }

    public function materialDestroy($id)
    {
        $task = Material::find($id)->delete();
        return redirect()->route('material')->with('success', 'Material is Deleted Successfully');
    }



    public function materialEdit($id){

        $materialAll = Material::all();
        $materialEdit = Material::find($id);
        $unit_type = UnitType::all();

        return view('adminpanel.material_edit', compact('materialAll', 'materialEdit', 'unit_type'));
    }

    public function materialUpdate(Request $request)
    {
        $material = Material::find($request->id);
        $material->material = $request->material;
        $material->unit_type_id = $request->unit_type;

        $material->save();


        return redirect(route('material'))->with('success', 'Successfully Updated !');
    }



    //raw material
    public function raw_material(Request $request)
    {
        $unit = UnitType::all();
        $brand = Brand::all();
        $raw_material = RawMaterial::all();
        $material = Material::all();
        return view('adminpanel.raw_material', compact('unit', 'material', 'raw_material', 'brand'));
    }

    public function rawmaterialstore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'raw_material_name' => 'required|string',
            'unit_id' => 'required',
            'material_id' => 'required',
            'brand' =>'required',
            'minimum_keeping_quantity' => 'required',
            'maximum_keeping_quantity' => 'required',
            // 'material_type' =>'required',
        ]);

        $material = new RawMaterial();
        $material->raw_material_name = $request->input('raw_material_name');
        $material->unit = $request->input('unit_id');
        $material->material_id = $request->input('material_id');
        $material->brand_id = $request->input('brand');
        $material->minimum_keeping_quantity = $request->input('minimum_keeping_quantity');
        $material->maximum_keeping_quantity = $request->input('maximum_keeping_quantity');
        // $material->material_type = $request->input('material_type');
        $material->save();
        if ($material->save()) {
            return redirect()->route('raw_material')->with('success', 'Raw material added successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to add raw material. Please try again.');
        }
        // return redirect()->back()->with('success', 'Material added successfully!');
    }

    public function rawMaterialDestroy($id)
    {
        $task = RawMaterial::find($id)->delete();
        return redirect()->route('raw_material')->with('success', 'Raw Material is Deleted Successfully');
    }

    public function rawMaterialEdit($id){

        $assignSiteAll = AssignSite::all();
        $assignSiteEdit = AssignSite::find($id);
        $site = Site::all();
        $supervisor = supervisor::all();
        return view('adminpanel.assign_task_edit', compact('assignSiteAll', 'assignSiteEdit', 'site', 'supervisor'));
    }

    public function rawMaterialUpdate(Request $request)
    {
        $assignSite = AssignSite::find($request->id);
        $assignSite->date = $request->date;
        $assignSite->supervisor = $request->supervisor_id;
        $assignSite->site_assign = $request->site_id;
        $assignSite->save();


        return redirect(route('assign_task'))->with('success', 'Successfully Updated !');
    }


    public function getBrands(Request $request)
    {
        $material_id = $request->get('material_id');
        $brands = Brand::where('material_id', $material_id)->get();

        return response()->json($brands);
    }

    // brand Master

    public function brand(Request $request)
    {
        $brand = Brand::all();
        $material = Material::all();
        return view('adminpanel.brand', compact('brand', 'material'));
    }
    public function brandstore(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'brand' => 'required|',
            'material_id' => 'required|',


        ]);
        $brand = new Brand();
        $brand->brand = $request->brand;
        $brand->material_id = $request->material_id;

        $brand->save();
        return redirect()->route('brand')->with('success', 'brand added successfully!');
    }

    public function brandDestroy($id)
    {
        $task = Brand::find($id)->delete();
        return redirect()->route('brand')->with('success', 'Brand is Deleted Successfully');
    }



    public function brandEdit($id){

        $brandAll = brand::all();
        $brandEdit = brand::find($id);
        $brand = Brand::all();
        $material = Material::all();
        return view('adminpanel.brand_edit', compact('brandAll', 'brandEdit', 'brand', 'material'));
    }

    public function brandUpdate(Request $request)
    {
        $brand = Brand::find($request->id);
        $brand->brand = $request->brand;
        $brand->material_id = $request->material_id;
        $brand->save();


        return redirect(route('brand'))->with('success', 'Successfully Updated !');
    }


    // warehouse Master
    public function warehouse(Request $request)
    {
        $city = City::all();
        $Warehouse = Warehouse::all();
        return view('adminpanel.warehouse', compact('Warehouse', 'city'));
    }

    public function warehousestore(Request $request)
    {
        // $request->validate([
        //     'warehouse_name' => 'required|',
        //     'incharge_name' => 'required|',
        //     'incharge_contact' => 'required|',
        //     'latitude' => 'required|regex:/^-?\d{1,2}(?:\.\d{1,9})?$/',
        //     'longitude' => 'required|regex:/^-?\d{1,3}(?:\.\d{1,9})?$/',
        //     'city_id' => 'required|',
        // ]);

        Warehouse::create([
            'warehouse_name' => $request->warehouse_name,
            'incharge_name' => $request->incharge_name,
            'incharge_contact' => $request->incharge_contact,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'city_id' => $request->city_id,
        ]);

        return redirect()->route('warehouse')->with('success', 'Warehouse created successfully.');
    }

    public function warehouseDestroy($id)
    {
        $task = Warehouse::find($id)->delete();
        return redirect()->route('warehouse')->with('success', 'Warehouse is Deleted Successfully');
    }


    public function warehouseEdit($id){

        $warehouseAll = Warehouse::all();
        $warehouseEdit = Warehouse::find($id);
        $city = City::all();
        $supervisor = supervisor::all();
        return view('adminpanel.warehouse_edit', compact('warehouseAll', 'warehouseEdit', 'city', 'supervisor'));
    }

    public function warehouseUpdate(Request $request)
    {
        $warehouse = warehouse::find($request->id);
        $warehouse->warehouse_name = $request->warehouse_name;
        $warehouse->incharge_name = $request->incharge_name;
        $warehouse->incharge_contact = $request->incharge_contact;
        $warehouse->latitude = $request->latitude;
        $warehouse->longitude = $request->longitude;
        $warehouse->city_id = $request->city_id;

        $warehouse->save();


        return redirect(route('warehouse'))->with('success', 'Successfully Updated !');
    }


    // Contractor Master
    public function contractor(Request $request)
    {
        $ac = AccountDetails::where('contractor_id', '!=', NULL)->with('contractor', 'contractor.cityname')->get();
        $contractor = Contractor::all();
        $city = City::all();
        return view('adminpanel.contractor', compact('contractor', 'city', 'ac'));
    }

    public function contractorstore(Request $request)
    {
        //  dd($request->all());
        $request->validate([
            'contractor_name' => 'required',
            'email' => 'required|',
            'mobile_number' => 'required|',
            'aadhar_number' => 'required|',
            'pan_number' => 'required',
            'city_address' => 'required',
            'city_id' => 'required',

        ]);

        $contractor = new Contractor();
        $contractor->contractor_name = $request->contractor_name;
        $contractor->email = $request->email;
        $contractor->mobile_number = $request->mobile_number;
        $contractor->aadhar_number = $request->aadhar_number;
        $contractor->pan_number = $request->pan_number;
        $contractor->city_address = $request->city_address;
        $contractor->city_id = $request->city_id;

        $contractor->save();

        foreach ($request->name as $key => $name) {
            $account_details = new AccountDetails();
            $account_details->account_holder = $request->name[$key];
            $account_details->contractor_id = $contractor->id;
            $account_details->bank_name = $request->bank[$key];
            $account_details->account_number = $request->ac_n[$key];
            $account_details->ifsc_code = $request->ifsc[$key];
            $account_details->save();
        }
        // dd(1);
        return redirect()->back()->with('success', 'Contractor and Account Details Added Successfully');
    }

    // public function contractorDestroy($id)
    // {
    //     $task = Contractor::find($id)->delete();
    //     return redirect()->route('contractor')->with('success', 'Contractor is Deleted Successfully');
    // }

    public function contractorDestroy($id)
    {
        $contractor = Contractor::find($id);

        if ($contractor) {
            // Delete the associated account details
            $contractor->accountDetails()->delete();

            // Delete the contractor
            $contractor->delete();

            return redirect()->route('contractor')->with('success', 'Contractor and associated Account Details are deleted successfully.');
        } else {
            return redirect()->route('contractor')->with('error', 'Contractor not found');
        }
    }




    public function contractorEdit(Request $request)
    {

    if (!$request->id) {
        return redirect()->back()->with('error', 'Invalid Vendor ID');
    }

    $acc_details_edit = AccountDetails::where('contractor_id', $request->id)->get();
    $contractor_edit = Contractor::find($request->id); // Use find() for a single record

    // Check if vendor_edit is null
    if (!$contractor_edit) {
        return redirect()->back()->with('error', 'Supervisor not found');
    }

    $city = City::all();
    $brand = Brand::all();
    $material = Material::all();

    return view('adminpanel.contractor_edit', compact('contractor_edit', 'city', 'acc_details_edit', 'material', 'brand'));
}



    public function contractorUpdate(Request $request)
    {
            $contractor = Contractor::where('id',$request->id)->first();


                // $supervisor = new Supervisor();
                $contractor->contractor_name = $request->contractor_name;
                $contractor->email = $request->email;
                $contractor->mobile_number = $request->mobile_number;
                $contractor->aadhar_number = $request->aadhar_number;
                $contractor->pan_number = $request->pan_number;
                $contractor->city_address = $request->city_address;
                $contractor->city_id = $request->city_id;
                // $contractor->password = $request->password;
                // $contractor->user_id = $user->id;
                $contractor->save();

                $delete = AccountDetails::where('contractor_id',$contractor->id)->delete();

            for($i=0;$i<count($request->name); $i++){
                if (isset($request->name[$i])){
                $account_details = new AccountDetails();
                $account_details->account_holder = $request->name[$i];
                $account_details->contractor_id = $contractor->id;
                $account_details->bank_name = $request->bank[$i];
                $account_details->account_number = $request->ac_n[$i];
                $account_details->ifsc_code = $request->ifsc[$i];
                $account_details->save();
            }
        }
                // dd(1);
                return redirect()->route('contractor')->with('success', 'Contractor and Account Details Updated Successfully');

        }



// to update status active or inactive

public function update_contractor_status($id)
{
    // Get the current status of the vendor
    $contractor = DB::table('contractor')->where('id', $id)->first();

    // Determine the new status
    $newStatus = $contractor->status == '1' ? '0' : '1';

    // Update the contractor's status
    DB::table('contractor')->where('id', $id)->update(['status' => $newStatus]);

    // Flash success message and redirect
    session()->flash('success', 'contractor status has been updated successfully.');
    return redirect()->route('contractor'); // Adjust redirect route as needed
}


    // Vendor Master

    public function vendor(Request $request)
    {

        $ac = AccountDetails::where('vendor_id', '!=', NULL)->with('vendorn', 'vendorn.cityname', 'vendorn.brandname', 'vendorn.materialname')->get();

        $vendor = Vendor::all();

    //      // Retrieve all vendors
    // $vendor = Vendor::pluck('id')->toArray();

    // // Get AccountDetails where vendor_id is in the list of vendor IDs
    // $ac = AccountDetails::whereIn('vendor_id', $vendor)
    //     ->with('vendorn', 'vendorn.cityname', 'vendorn.brandname', 'vendorn.materialname')
    //     ->get();


        $city = City::all();

        $brand = Brand::all();
        $material = Material::all();

        return view('adminpanel.vendor', compact('brand', 'ac', 'vendor', 'city', 'material'));
    }
    public function vendorstore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'vendor_name' => 'required',
            'email' => 'required|',
            'mobile_number' => 'required|',
            'aadhar_number' => 'required|',
            'pan_number' => 'required',
            'city_address' => 'required',
            'city_id' => 'required',
            'material_id' => 'required',

            'brand_id' => 'required',


        ]);

        $Vendors = new Vendor();
        $Vendors->vendor_name = $request->vendor_name;
        $Vendors->email = $request->email;
        $Vendors->mobile_number = $request->mobile_number;
        $Vendors->aadhar_number = $request->aadhar_number;
        $Vendors->pan_number = $request->pan_number;
        $Vendors->city_address = $request->city_address;
        $Vendors->city_id = $request->city_id;

        $Vendors->brand = $request->brand_id;

        $Vendors->materials = $request->material_id;


        $Vendors->save();

        foreach ($request->name as $key => $name) {
            $account_details = new AccountDetails();
            $account_details->account_holder = $request->name[$key];
            $account_details->vendor_id = $Vendors->id;
            $account_details->bank_name = $request->bank[$key];
            $account_details->account_number = $request->ac_n[$key];
            $account_details->ifsc_code = $request->ifsc[$key];
            $account_details->save();
        }
        // dd(1);
        return redirect()->back()->with('success', 'Vendor and Account Details Added Successfully');
    }

    public function vendorDestroy($id)
    {
        $vendor = Vendor::find($id);

        if ($vendor) {
            // Delete the associated account details
            $vendor->accountDetails()->delete();

            // Delete the vendor
            $vendor->delete();

            return redirect()->route('vendor')->with('success', 'Vendor and associated Account Details are deleted successfully.');
        } else {
            return redirect()->route('vendor')->with('error', 'Vendor not found');
        }
    }


    public function vendorEdit(Request $request)
    {
          // Check if ID is passed correctly

        //   dd($request->id);

//         $vendor = Vendor::find(46);
// dd($vendor);


    if (!$request->id) {
        return redirect()->back()->with('error', 'Invalid Vendor ID');
    }

    $acc_details_edit = AccountDetails::where('vendor_id', $request->id)->get();
    $vendor_edit = Vendor::find($request->id); // Use find() for a single record

    // Check if vendor_edit is null
    if (!$vendor_edit) {
        return redirect()->back()->with('error', 'Vendor not found');
    }

    $city = City::all();
    $brand = Brand::all();
    $material = Material::all();

    return view('adminpanel.vendor_edit', compact('vendor_edit', 'city', 'acc_details_edit', 'material', 'brand'));
}

    // public function delete_acc_details(Request $request)
    //     {
    //     $response = AccountDetails::where('id', $request->id)->delete();
    //         return response()->json($response);
    //     }

    public function vendorUpdate(Request $request)
    {
        //  dd($request->all());
        $request->validate([
            'vendor_name' => 'required',
            'email' => 'required|',
            'mobile_number' => 'required|',
            'aadhar_number' => 'required|',
            'pan_number' => 'required',
            'city_address' => 'required',
            // 'city_id' => 'required',
            'brand_id' => 'required',
            'material_id' => 'required',

        ]);

        $vendor = Vendor::where('id',$request->id)->first();


        // $user = User:: where('email',$employee->email)->first();
        // $user->name = $request->vendor_name;
        // $user->email = $request->email;
        // $user->password = $request->password ? bcrypt($request->password) : $user->password; // Hash the password
        // $user->role = 'Employee';
        // $user->save();

        // $employee = new Employee();

        $vendor->vendor_name = $request->vendor_name;
        $vendor->email = $request->email;
        $vendor->mobile_number = $request->mobile_number;
        $vendor->aadhar_number = $request->aadhar_number;
        $vendor->pan_number = $request->pan_number;
        $vendor->city_address = $request->city_address;
        $vendor->city_id = $request->city_id;
        $vendor->brand = $request->brand_id;
        $vendor->materials = $request->material_id;

        $vendor->save();

        $delete = AccountDetails::where('vendor_id',$vendor->id)->delete();

        for($i=0;$i<count($request->name); $i++){
            if (isset($request->name[$i])){
            $account_details = new AccountDetails();
            $account_details->account_holder = $request->name[$i];
            $account_details->vendor_id = $vendor->id;
            $account_details->bank_name = $request->bank[$i];
            $account_details->account_number = $request->ac_n[$i];
            $account_details->ifsc_code = $request->ifsc[$i];
            $account_details->save();
        }
    }

        return redirect()->route('vendor')->with('success', 'Vendor and Account Details Added Successfully');
    }




// to update status active or inactive

public function update_vendor_status($id)
{
    // Get the current status of the vendor
    $vendor = DB::table('vendor')->where('id', $id)->first();

    // Determine the new status
    $newStatus = $vendor->status == '1' ? '0' : '1';

    // Update the vendor's status
    DB::table('vendor')->where('id', $id)->update(['status' => $newStatus]);

    // Flash success message and redirect
    session()->flash('success', 'Vendor status has been updated successfully.');
    return redirect()->route('vendor'); // Adjust redirect route as needed
}




    // SuperVisor Master
    public function supervisor(Request $request)
    {
        $city = City::all();
        $ac = AccountDetails::where('supervisor_id', '!=', NULL)->with('supervisor')->get();
        $supervisor = Supervisor::all();
        return view('adminpanel.supervisor', compact('city', 'ac', 'supervisor'));
    }

    public function supervisorstore(Request $request)
    {
        //  dd($request->all());
        $request->validate([
            'supervisor_name' => 'required',
            'email' => 'required|',
            'mobile_number' => 'required|',
            'aadhar_number' => 'required|',
            'pan_number' => 'required',
            'city_address' => 'required',
            'city_id' => 'required',

        ]);

         // Create a new User instance and set its attributes
    $user = new User();
    $user->name = $request->supervisor_name;
    $user->email = $request->email;
    $user->contact = $request->mobile_number;
    $user->password = bcrypt($request->password); // Hash the password
    $user->role = 'Supervisor'; // Set the role to supervisor
    $user->save();


        $supervisor = new Supervisor();
        $supervisor->supervisor_name = $request->supervisor_name;
        $supervisor->email = $request->email;
        $supervisor->mobile_number = $request->mobile_number;
        $supervisor->aadhar_number = $request->aadhar_number;
        $supervisor->pan_number = $request->pan_number;
        $supervisor->city_address = $request->city_address;
        $supervisor->city_id = $request->city_id;
        // $supervisor->password = $request->password;
        $supervisor->user_id = $user->id;
        $supervisor->save();

        foreach ($request->name as $key => $name) {
            $account_details = new AccountDetails();
            $account_details->account_holder = $request->name[$key];
            $account_details->supervisor_id = $supervisor->id;
            $account_details->bank_name = $request->bank[$key];
            $account_details->account_number = $request->ac_n[$key];
            $account_details->ifsc_code = $request->ifsc[$key];
            $account_details->save();
        }
        // dd(1);
        return redirect()->back()->with('success', 'Supervisor and Account Details Added Successfully');
    }



    public function supervisorEdit(Request $request)
    {
          // Check if ID is passed correctly

        //   dd($request->id);

//         $vendor = Vendor::find(46);
// dd($vendor);


    if (!$request->id) {
        return redirect()->back()->with('error', 'Invalid Vendor ID');
    }

    $acc_details_edit = AccountDetails::where('supervisor_id', $request->id)->get();
    $supervisor_edit = Supervisor::find($request->id); // Use find() for a single record

    // Check if vendor_edit is null
    if (!$supervisor_edit) {
        return redirect()->back()->with('error', 'Supervisor not found');
    }

    $city = City::all();
    $brand = Brand::all();
    $material = Material::all();

    return view('adminpanel.supervisor_edit', compact('supervisor_edit', 'city', 'acc_details_edit', 'material', 'brand'));
}



    public function supervisorDestroy($id)
    {
        $supervisor = Supervisor::find($id);

        if ($supervisor) {
            // Delete the associated account details
            $supervisor->accountDetails()->delete();

            // Delete the supervisor
            $supervisor->delete();

            return redirect()->route('supervisor')->with('success', 'Supervisor and associated Account Details are deleted successfully.');
        } else {
            return redirect()->route('supervisor')->with('error', 'Supervisor not found');
        }
    }

    public function supervisorUpdate(Request $request)
    {
        $supervisor = Supervisor::where('id',$request->id)->first();
        $user = User:: where('id',$supervisor->user_id)->first();

        // Update user Details
        $user->name = $request->supervisor_name;
        $user->email = $request->email;
        $user->contact = $request->mobile_number;
        // Update password only if a new password is provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password); // Hash the password
        }
        $user->role = 'Supervisor'; // Set the role to supervisor
        $user->save();


            // $supervisor = new Supervisor();
            $supervisor->supervisor_name = $request->supervisor_name;
            $supervisor->email = $request->email;
            $supervisor->mobile_number = $request->mobile_number;
            $supervisor->aadhar_number = $request->aadhar_number;
            $supervisor->pan_number = $request->pan_number;
            $supervisor->city_address = $request->city_address;
            $supervisor->city_id = $request->city_id;
            // $supervisor->password = $request->password;
            $supervisor->user_id = $user->id;
            $supervisor->save();

            $delete = AccountDetails::where('supervisor_id',$supervisor->id)->delete();

        for($i=0;$i<count($request->name); $i++){
            if (isset($request->name[$i])){
            $account_details = new AccountDetails();
            $account_details->account_holder = $request->name[$i];
            $account_details->supervisor_id = $supervisor->id;
            $account_details->bank_name = $request->bank[$i];
            $account_details->account_number = $request->ac_n[$i];
            $account_details->ifsc_code = $request->ifsc[$i];
            $account_details->save();
        }
    }
            // dd(1);
            return redirect()->route('supervisor')->with('success', 'Supervisor and Account Details Updated Successfully');

    }


// to update status active or inactive

public function update_supervisor_status($id)
{
    // Get the current status of the vendor
    $supervisor = DB::table('supervisor')->where('id', $id)->first();

    // Determine the new status
    $newStatus = $supervisor->status == '1' ? '0' : '1';

    // Update the supervisor's status
    DB::table('supervisor')->where('id', $id)->update(['status' => $newStatus]);

    // Flash success message and redirect
    session()->flash('success', 'supervisor status has been updated successfully.');
    return redirect()->route('supervisor'); // Adjust redirect route as needed
}




    // Employee Master

    public function employee(Request $request)
    {
        $ac = AccountDetails::where('employee_id', '!=', NULL)->with('employee', 'employee.cityname')->get();
        $emp = Employee::get();

        $city = City::all();
        return view('adminpanel.employee', compact('emp', 'city'));
    }

    public function employeestore(Request $request)
    {
        //  dd($request->all());
        $request->validate([
            'employee_name' => 'required',
            'email' => 'required|',
            'mobile_number' => 'required|',
            'aadhar_number' => 'required|',
            'pan_number' => 'required',
            'city_address' => 'required',
            'city_id' => 'required',

        ]);


        $user = new User();
        $user->name = $request->employee_name;
        $user->email = $request->email;
        $user->contact = $request->mobile_number;
        $user->password = bcrypt($request->password); // Hash the password
        $user->role = 'Employee';
        $user->save();


        $employee = new Employee();
        $employee->employee_name = $request->employee_name;
        $employee->email = $request->email;
        $employee->mobile_number = $request->mobile_number;
        $employee->aadhar_number = $request->aadhar_number;
        $employee->pan_number = $request->pan_number;
        $employee->city_address = $request->city_address;
        $employee->city_id = $request->city_id;
        $employee->user_id = $user->id;

        $employee->save();

        foreach ($request->name as $key => $name) {
            $account_details = new AccountDetails();
            $account_details->account_holder = $request->name[$key];
            $account_details->employee_id = $employee->id;
            $account_details->bank_name = $request->bank[$key];
            $account_details->account_number = $request->ac_n[$key];
            $account_details->ifsc_code = $request->ifsc[$key];
            $account_details->save();
        }
        // dd(1);


        return redirect()->back()->with('success', 'Employee and Account Details Added Successfully');
    }

    public function edit_employee(Request $request)
    {
        $acc_details_edit = AccountDetails::where('employee_id', $request->id)->get();
        $employee_edit = Employee::where('id',$request->id)->first();
// echo json_encode($acc_details_edit);
// echo json_encode($employee_edit);
// exit();
        $city = City::all();

        return view('adminpanel.employee_edit', compact('employee_edit', 'city','acc_details_edit'));
    }


    public function delete_acc_details(Request $request)
        {
        $response = AccountDetails::where('id', $request->id)->delete();
            return response()->json($response);
        }

    public function update_employee(Request $request)
    {
        //  dd($request->all());
        $request->validate([
            'employee_name' => 'required',
            'email' => 'required|',
            'mobile_number' => 'required|',
            'aadhar_number' => 'required|',
            'pan_number' => 'required',
            'city_address' => 'required',
            'city_id' => 'required',

        ]);

        $employee = Employee::where('id',$request->id)->first();


        $user = User:: where('email',$employee->email)->first();
        $user->name = $request->employee_name;
        $user->email = $request->email;
        $user->password = $request->password ? bcrypt($request->password) : $user->password; // Hash the password
        $user->role = 'Employee';
        $user->save();

        // $employee = new Employee();

        $employee->employee_name = $request->employee_name;
        $employee->email = $request->email;
        $employee->mobile_number = $request->mobile_number;
        $employee->aadhar_number = $request->aadhar_number;
        $employee->pan_number = $request->pan_number;
        $employee->city_address = $request->city_address;
        $employee->city_id = $request->city_id;

        $employee->save();

        $delete = AccountDetails::where('employee_id',$employee->id)->delete();

        for($i=0;$i<count($request->name); $i++){
            if (isset($request->name[$i])){
            $account_details = new AccountDetails();
            $account_details->account_holder = $request->name[$i];
            $account_details->employee_id = $employee->id;
            $account_details->bank_name = $request->bank[$i];
            $account_details->account_number = $request->ac_n[$i];
            $account_details->ifsc_code = $request->ifsc[$i];
            $account_details->save();
        }
    }

        return redirect()->route('employee')->with('success', 'Employee and Account Details Added Successfully');
    }

    public function employeeDestroy($id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            // Delete the associated account details
            $employee->accountDetails()->delete();

            // Delete the employee
            $employee->delete();

            return redirect()->route('employee')->with('success', 'employee and associated Account Details are deleted successfully.');
        } else {
            return redirect()->route('employee')->with('error', 'employee not found');
        }
    }


// to update status active or inactive

public function update_employee_status($id)
{
    // Get the current status of the vendor
    $employee = DB::table('employee')->where('id', $id)->first();

    // Determine the new status
    $newStatus = $employee->status == '1' ? '0' : '1';

    // Update the employee's status
    DB::table('employee')->where('id', $id)->update(['status' => $newStatus]);

    // Flash success message and redirect
    session()->flash('success', 'employee status has been updated successfully.');
    return redirect()->route('employee'); // Adjust redirect route as needed
}



// Status


    public function status(){
        $status = Status::all();
        return view('adminpanel.status', compact('status'));
    }

    public function statusStore(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'status' => 'required|',

        ]);
        $status = new Status();
        $status->status = $request->status;

        $status->save();
        return redirect()->route('status')->with('success', 'Status added successfully!');
    }

    public function statusDestroy($id)
    {
        $task = Status::find($id)->delete();
        return redirect()->route('status')->with('success', 'Status is Deleted Successfully');
    }



    public function statusEdit($id){

        $statusAll = Status::all();
        $statusEdit = Status::find($id);
        return view('adminpanel.status_edit', compact('statusAll', 'statusEdit'));
    }

    public function statusUpdate(Request $request)
    {
        $status = Status::find($request->id);
        $status->status = $request->status;
        $status->save();


        return redirect(route('status'))->with('success', 'Successfully Updated !');
    }




    // -----------


    public function category(){
        $category = TaskCategory::all();
        return view('adminpanel.category', compact('category'));
    }

    public function categoryStore(Request $request)
    {
        // Validate the incoming request data
        // $request->validate([
        //     'category_name' => 'required',

        // ]);

        // dd($request->all());
        $category = new TaskCategory();
        $category->category_name = $request->category_name;

        $category->save();
        return redirect()->route('category')->with('success', 'category added successfully!');
    }

    public function categoryDestroy($id)
    {
        $task = TaskCategory::find($id)->delete();
        return redirect()->route('category')->with('success', 'category is Deleted Successfully');
    }



    public function categoryEdit($id){

        $categoryAll = TaskCategory::all();
        $categoryEdit = TaskCategory::find($id);
        return view('adminpanel.category_edit', compact('categoryAll', 'categoryEdit'));
    }

    public function categoryUpdate(Request $request)
    {
        $category = TaskCategory::find($request->id);
        $category->category_name = $request->category_name;
        $category->save();


        return redirect(route('category'))->with('success', 'Successfully Updated !');
    }

    // ------------


    public function subCategory(){
        $category = TaskCategory::all();
        $subcategory = TaskSubCategory::all();
        return view('adminpanel.subcategory', compact('category', 'subcategory'));
    }

    public function subcategoryStore(Request $request)
    {

        // dd($request->all());
        // Validate the incoming request data
        // $request->validate([
        //     'subcategory' => 'required|',

        // ]);
        $subcategory = new TaskSubCategory();
        $subcategory->category_id = $request->category;
        $subcategory->subcategory_name = $request->subcategory_name;

        $subcategory->save();
        return redirect()->route('subcategory')->with('success', 'subcategory added successfully!');
    }

    public function subcategoryDestroy($id)
    {
        $task = TaskSubCategory::find($id)->delete();
        return redirect()->route('subcategory')->with('success', 'subcategory is Deleted Successfully');
    }



    public function subcategoryEdit($id){

        $subcategoryAll = TaskSubCategory::all();
        $subcategoryEdit = TaskSubCategory::find($id);
        $category = TaskCategory::all();

        return view('adminpanel.subcategory_edit', compact('subcategoryAll', 'subcategoryEdit', 'category'));
    }

    public function subcategoryUpdate(Request $request)
    {
        $subcategory = TaskSubCategory::find($request->id);
        $subcategory->category_id = $request->category;
        $subcategory->subcategory_name = $request->subcategory_name;
            $subcategory->save();


        return redirect(route('subcategory'))->with('success', 'Successfully Updated !');
    }



    public function workingUnitType(){
        $unit = WorkingUnitType::all();
        return view('adminpanel.working_unit_type', compact('unit'));
    }

    public function workingUnitTypeStore(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'working_unit_type' => 'required|',

        ]);
        $workingUnitType = new WorkingUnitType();
        $workingUnitType->working_unit_type = $request->working_unit_type;

        $workingUnitType->save();
        return redirect()->route('working_unit_type')->with('success', 'Working Unit Type added successfully!');
    }

    public function workingUnitTypeDestroy($id)
    {
        $workingUnitType = WorkingUnitType::find($id)->delete();
        return redirect()->route('working_unit_type')->with('success', 'Working Unit Type is Deleted Successfully');
    }



    public function workingUnitTypeEdit($id){

        $unitTypeAll = WorkingUnitType::all();
        $unitTypeEdit = WorkingUnitType::find($id);
        return view('adminpanel.working_unit_type_edit', compact('unitTypeAll', 'unitTypeEdit'));
    }

    public function workingUnitTypeUpdate(Request $request)
    {
        $workingUnitType = WorkingUnitType::find($request->id);
        $workingUnitType->working_unit_type = $request->working_unit_type;
        $workingUnitType->save();


        return redirect(route('working_unit_type'))->with('success', 'Successfully Updated !');
    }


    public function nonConsumableCategory(){
        $category = NonConsumableCategory::all();
        return view('adminpanel.non_consumable_category', compact('category'));
    }


    public function nonConsumableCategoryStore(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'category' => 'required|',

        ]);
        $category = new NonConsumableCategory();
        $category->category = $request->category;

        $category->save();
        return redirect()->route('non-consumable-category')->with('success', 'Category added successfully!');
    }



    public function nonConsumableCategoryDestroy($id)
    {
        $category = NonConsumableCategory::find($id)->delete();
        return redirect()->route('non-consumable-category')->with('success', 'Category is Deleted Successfully');
    }



    public function nonConsumableCategoryMaterial(){
        $material = NonConsumableCategoryMaterial::all();
        $category = NonConsumableCategory::all();
        $unit = NonConsumableUnitType::all();
        $brand = NonConsumableBrand::all();

        return view('adminpanel.non_consumable_category_material', compact('material', 'unit', 'category', 'brand'));
    }

    public function getNonConsumableBrands(Request $request)
    {
        $category_id = $request->get('category_id');
        $brands = NonConsumableBrand::where('category_id', $category_id)->get();

        return response()->json($brands);
    }

    public function nonConsumableCategoryMaterialStore(Request $request)
    {
        // Validate the incoming request data
        // $request->validate([
        //     'category' => 'required|',

        // ]);
        $category = new NonConsumableCategoryMaterial();
        $category->category_id = $request->category;
        $category->sub_category_name = $request->sub_category_name;
        $category->brand_id = $request->brand;
        $category->unit_type_id = $request->unit_type;
        $category->minimum_keeping_quantity = $request->minimum_keeping_quantity;
        $category->maximum_keeping_quantity = $request->maximum_keeping_quantity;

        $category->save();
        return redirect()->route('non-consumable-category-material')->with('success', 'Material added successfully!');
    }



    public function nonConsumableCategoryMaterialDestroy($id)
    {
        $category = NonConsumableCategoryMaterial::find($id)->delete();
        return redirect()->route('non-consumable-category-material')->with('success', 'Material is Deleted Successfully');
    }



    public function issue(){
        $issue = Issues::all();
        return view('adminpanel.issue', compact('issue'));
    }

    public function issueStore(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'issue' => 'required|',

        ]);
        $issue = new Issues();
        $issue->issue = $request->issue;

        $issue->save();
        return redirect()->route('issue')->with('success', 'Issue added successfully!');
    }

    public function issueDestroy($id)
    {
        $task = Issues::find($id)->delete();
        return redirect()->route('issue')->with('success', 'Issue is Deleted Successfully');
    }


    public function issueEdit($id){

        $issueAll = Issues::all();
        $issueEdit = Issues::find($id);
        return view('adminpanel.issue_edit', compact('issueAll', 'issueEdit'));
    }

    public function issueUpdate(Request $request)
    {
        $issue = Issues::find($request->id);
        $issue->issue = $request->issue;
        $issue->save();


        return redirect(route('issue'))->with('success', 'Successfully Updated !');
    }


    // roles

    public function appRole(){
        $role = AppRoles::all();
        return view('adminpanel.app_roles', compact('role'));

    }

    public function storeAppRole(Request $request)
    {
        $role = new AppRoles();
        $role -> role = $request->role;
        $role->save();
        return redirect()->route('app-role')->with('success', 'Role added successfully!');

    }

    public function appRoleDestroy($id)
    {
        $role = AppRoles::find($id)->delete();
        return redirect()->route('app-role')->with('success', 'Role Deleted Successfully');
    }


    public function panelRole(){
        $role = PanelRoles::all();
        return view('adminpanel.panel_roles', compact('role'));

    }

    public function storepanelRole(Request $request)
    {
        $role = new PanelRoles();
        $role -> role = $request->role;
        $role->save();
        return redirect()->route('panel-role')->with('success', 'Role added successfully!');

    }

    public function panelRoleDestroy($id)
    {
        $role = PanelRoles::find($id)->delete();
        return redirect()->route('panel-role')->with('success', 'Role Deleted Successfully');
    }



    // Master End


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // public function check(Request $request)
    // {
    //     //dd($request->all());
    //     $email = $request->input('email');
    //     $password = $request->input('password');

    //     // Check if the user exists with the provided email
    //     $user = User::where('email', $email)->first();

    //     // If user exists and password matches
    //     if ($user && \Hash::check($password, $user->password)) {
    //         // Authentication successful, redirect to admin dashboard
    //         return redirect()->route('dashboard');
    //     } else {
    //         // Authentication failed, redirect back to login page with error message
    //         return redirect()->route('login')->with('error', 'Invalid email or password.');
    //     }
    // }
    public function check(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Check if the user exists with the provided email
        $user = User::where('email', $email)->first();

        // If user exists and password matches
        if ($user && \Hash::check($password, $user->password)) {
            // Attempt authentication
            if (auth()->attempt(['email' => $email, 'password' => $password])) {
                // Authentication successful, redirect to admin dashboard
                return redirect()->route('dashboard');
            } else {
                // Redirect back to login page with error message
                return redirect()->route('login')->with('error', 'Invalid email or password.');
            }
        } else {
            // Redirect back to login page with error message
            return redirect()->route('login')->with('error', 'Invalid email or password.');
        }
    }




//engineer

  public function engg()
        {
            $city = City::all();
            $engg = Engineer::all();

            return view('engineer',compact('city','engg'));
        }

 public function enggstore(Request $request)
    {
        //  dd($request->all());
        $request->validate([
            'employee_name' => 'required',
            'email' => 'required|',
            'mobile_number' => 'required|',
            'aadhar_number' => 'required|',
            'pan_number' => 'required',
            'city_address' => 'required',
            'city_id' => 'required',

        ]);

        $user = new User();
        $user->name = $request->employee_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Hash the password
        $user->role = 'Engineer';
        $user->save();

        $employee = new Engineer();
        $employee->user_id = $user->id;
        $employee->employee_name = $request->employee_name;
        $employee->email = $request->email;
        $employee->mobile_number = $request->mobile_number;
        $employee->aadhar_number = $request->aadhar_number;
        $employee->pan_number = $request->pan_number;
        $employee->city_address = $request->city_address;
        $employee->city_id = $request->city_id;
        $employee->account_holder = $request->account_holder;
        $employee->bank_name = $request->bank_name;
        $employee->account_number = $request->account_number;
        $employee->ifsc_code = $request->ifsc_code;
        $employee->save();


        return redirect()->back()->with('success', 'Engineer Added Successfully');
    }

        public function edit_engg($id)
        {
            $edit_engg = Engineer::find($id);
            $city = City::get();
            return view('edit_engg',compact('edit_engg','city'));
        }

        public function update_engg(Request $request)
        {
            $request->validate([
                'employee_name' => 'required',
                'email' => 'required|',
                'mobile_number' => 'required|',
                'aadhar_number' => 'required|',
                'pan_number' => 'required',
                'city_address' => 'required',
                'city_id' => 'required',

            ]);

            $employee = Engineer::where('id',$request->id)->first();

            $user = User:: where('email',$employee->email)->first();
            $user->name = $request->employee_name;
            $user->email = $request->email;
            $user->password = $request->password ? bcrypt($request->password) : $user->password; // Hash the password
            $user->role = 'Engineer';
            $user->save();

            $employee->employee_name = $request->employee_name;
            $employee->email = $request->email;
            $employee->user_id = $user->id;
            $employee->mobile_number = $request->mobile_number;
            $employee->aadhar_number = $request->aadhar_number;
            $employee->pan_number = $request->pan_number;
            $employee->city_address = $request->city_address;
            $employee->city_id = $request->city_id;
            $employee->account_holder = $request->account_holder;
            $employee->bank_name = $request->bank_name;
            $employee->account_number = $request->account_number;
            $employee->ifsc_code = $request->ifsc_code;
            $employee->save();


            return redirect()->route('engg')->with('success', 'Engineer Updated Successfully');
        }

        public function delete_engg($id)
        {
            Engineer::where('id',$id)->delete();
            return back()->with('success','Record deleted successfully');
        }



// to update status active or inactive

public function update_engg_status($id)
{
    // Get the current status of the vendor
    $engineer = DB::table('engineer')->where('id', $id)->first();

    // Determine the new status
    $newStatus = $engineer->status == '1' ? '0' : '1';

    // Update the engineer's status
    DB::table('engineer')->where('id', $id)->update(['status' => $newStatus]);

    // Flash success message and redirect
    session()->flash('success', 'engineer status has been updated successfully.');
    return redirect()->route('engg'); // Adjust redirect route as needed
}
        //site manager

        public function site_manager()
        {
            $city = City::all();
            $site = Site_Manager::all();

            return view('site_manager',compact('city','site'));
        }

        public function site_managerstore(Request $request)
        {
        //  dd($request->all());
        $request->validate([
            'employee_name' => 'required',
            'email' => 'required|',
            'mobile_number' => 'required|',
            'aadhar_number' => 'required|',
            'pan_number' => 'required',
            'city_address' => 'required',
            'city_id' => 'required',

        ]);

        $user = new User();
        $user->name = $request->employee_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Hash the password
        $user->role = 'site-manager';
        $user->save();


        $employee = new Site_Manager();
        $employee->user_id = $user->id;
        $employee->employee_name = $request->employee_name;
        $employee->email = $request->email;
        $employee->mobile_number = $request->mobile_number;
        $employee->aadhar_number = $request->aadhar_number;
        $employee->pan_number = $request->pan_number;
        $employee->city_address = $request->city_address;
        $employee->city_id = $request->city_id;
        $employee->account_holder = $request->account_holder;
        $employee->bank_name = $request->bank_name;
        $employee->account_number = $request->account_number;
        $employee->ifsc_code = $request->ifsc_code;
        $employee->save();


        return redirect()->back()->with('success', 'Site Manager Added Successfully');
        }

        public function edit_site_manager($id)
        {
            $edit_site_manager = Site_Manager::find($id);
            $city = City::get();
            return view('edit_site_manager',compact('edit_site_manager','city'));
        }

        public function update_site_manager(Request $request)
        {
            $request->validate([
                'employee_name' => 'required',
                'email' => 'required|',
                'mobile_number' => 'required|',
                'aadhar_number' => 'required|',
                'pan_number' => 'required',
                'city_address' => 'required',
                'city_id' => 'required',

            ]);

            $employee = Site_Manager::where('id',$request->id)->first();

            $user = User:: where('email',$employee->email)->first();
            $user->name = $request->employee_name;
            $user->email = $request->email;
            $user->password = $request->password ? bcrypt($request->password) : $user->password; // Hash the password
            $user->role = 'site-manager';
            $user->save();

            $employee->user_id = $user->id;
            $employee->employee_name = $request->employee_name;
            $employee->email = $request->email;
            $employee->mobile_number = $request->mobile_number;
            $employee->aadhar_number = $request->aadhar_number;
            $employee->pan_number = $request->pan_number;
            $employee->city_address = $request->city_address;
            $employee->city_id = $request->city_id;
            $employee->account_holder = $request->account_holder;
            $employee->bank_name = $request->bank_name;
            $employee->account_number = $request->account_number;
            $employee->ifsc_code = $request->ifsc_code;
            $employee->save();


            return redirect()->route('site_manager')->with('success', 'Site Manager Updated Successfully');
        }

        public function delete_site_manager($id)
        {
            Site_Manager::where('id',$id)->delete();
            return back()->with('success','Record deleted successfully');
        }



// to update status active or inactive

public function update_site_manager_status($id)
{
    // Get the current status of the vendor
    $site_manager = DB::table('site_manager')->where('id', $id)->first();

    // Determine the new status
    $newStatus = $site_manager->status == '1' ? '0' : '1';

    // Update the site_manager's status
    DB::table('site_manager')->where('id', $id)->update(['status' => $newStatus]);

    // Flash success message and redirect
    session()->flash('success', 'site_manager status has been updated successfully.');
    return redirect()->route('site_manager'); // Adjust redirect route as needed
}


        //site incharge

        public function site_incharge()
        {
            $city = City::all();
            $site = Site_Incharge::all();

            return view('site_incharge',compact('city','site'));
        }

        public function site_inchargestore(Request $request)
        {
        //  dd($request->all());
        $request->validate([
            'employee_name' => 'required',
            'email' => 'required|',
            'mobile_number' => 'required|',
            'aadhar_number' => 'required|',
            'pan_number' => 'required',
            'city_address' => 'required',
            'city_id' => 'required',

        ]);

        $user = new User();
        $user->name = $request->employee_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Hash the password
        $user->role = 'site-incharge';
        $user->save();


        $employee = new Site_Incharge();
        $employee->user_id = $user->id;
        $employee->employee_name = $request->employee_name;
        $employee->email = $request->email;
        $employee->mobile_number = $request->mobile_number;
        $employee->aadhar_number = $request->aadhar_number;
        $employee->pan_number = $request->pan_number;
        $employee->city_address = $request->city_address;
        $employee->city_id = $request->city_id;
        $employee->account_holder = $request->account_holder;
        $employee->bank_name = $request->bank_name;
        $employee->account_number = $request->account_number;
        $employee->ifsc_code = $request->ifsc_code;
        $employee->save();


        return redirect()->back()->with('success', 'Site incharge Added Successfully');
        }

        public function edit_site_incharge($id)
        {
            $edit_site_incharge = Site_Incharge::find($id);
            $city = City::get();
            return view('edit_site_incharge',compact('edit_site_incharge','city'));
        }

        public function update_site_incharge(Request $request)
        {
            $request->validate([
                'employee_name' => 'required',
                'email' => 'required|',
                'mobile_number' => 'required|',
                'aadhar_number' => 'required|',
                'pan_number' => 'required',
                'city_address' => 'required',
                'city_id' => 'required',

            ]);

            $employee = Site_Incharge::where('id',$request->id)->first();

            $user = User:: where('email',$employee->email)->first();
            $user->name = $request->employee_name;
            $user->email = $request->email;
            $user->password = $request->password ? bcrypt($request->password) : $user->password; // Hash the password
            $user->role = 'site-incharge';
            $user->save();

            $employee->user_id = $user->id;
            $employee->employee_name = $request->employee_name;
            $employee->email = $request->email;
            $employee->mobile_number = $request->mobile_number;
            $employee->aadhar_number = $request->aadhar_number;
            $employee->pan_number = $request->pan_number;
            $employee->city_address = $request->city_address;
            $employee->city_id = $request->city_id;
            $employee->account_holder = $request->account_holder;
            $employee->bank_name = $request->bank_name;
            $employee->account_number = $request->account_number;
            $employee->ifsc_code = $request->ifsc_code;
            $employee->save();


            return redirect()->route('site_incharge')->with('success', 'Site incharge Updated Successfully');
        }



// to update status active or inactive

public function update_site_incharge_status($id)
{
    // Get the current status of the vendor
    $site_manager = DB::table('site_manager')->where('id', $id)->first();

    // Determine the new status
    $newStatus = $site_manager->status == '1' ? '0' : '1';

    // Update the site_manager's status
    DB::table('site_manager')->where('id', $id)->update(['status' => $newStatus]);

    // Flash success message and redirect
    session()->flash('success', 'site_manager status has been updated successfully.');
    return redirect()->route('site_manager'); // Adjust redirect route as needed
}

        public function delete_site_incharge($id)
        {
            Site_Incharge::where('id',$id)->delete();
            return back()->with('success','Record deleted successfully');
        }


}
