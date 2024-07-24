<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Site;
use App\Models\AssignSite;
use App\Models\Supervisor;
use App\Models\TeamContact;
use App\Models\Task;
use App\Models\Material;
use App\Models\RequestedMaterial;
use App\Models\Status;
use App\Models\TaskCategory;
use App\Models\TaskSubCategory;
use App\Models\WorkingUnitType;
use App\Models\AssignedTask;
use App\Models\AssignedTaskIssues;
use App\Models\Issues;
use App\Models\Brand;
use App\Models\{UnitType, RawMaterial, LostMaterial, ApplyLeave, WorkPlace};
use App\Models\Inventory\IssueMaterialByInventory;
use App\Models\Warehouse\IssueMaterialByWareHouse;

use App\Models\Attendance\AttendanceSupervisor;
use Illuminate\Support\Facades\File;

use App\Models\Contractor;


use DB;

use Illuminate\Support\Facades\Hash;


class ApiController extends Controller
{
    public function registration(Request $request)
	{
		$registration = User::create([
		'email'=>$request ->user_name,
		'name'=>$request->name,
		'password'=>$request->password,
		'role'=>'supervisor',
		]);

		if($registration){
			return response()->json(['status'=>true, 'message'=>'Data Submitted Successfully']);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}

	}

	public function login(Request $request){
		$user = User::where('contact', $request->username)->first();

		if($user && Hash::check($request->password, $user->password)){
			return response()->json(['status'=>true, 'message'=>'User Login Successfully', 'user'=>$user]);
		}else{
			return response()->json(['status'=>false, 'message'=>'User Not Found']);
		}
	}

	public function get_user(Request $request){
		$user = User::where('id', $request->user_id)->first();

		if($user){
			return response()->json(['status'=>true, 'user'=>$user]);
		}else{
			return response()->json(['status'=>false, 'message'=>'User Not Found']);
		}
	}

	public function asignTask2(Request $request)
	{

		$task = AssignSite::where('supervisor', $request->supervisor_id)
							-> leftjoin('sites', 'sites.id', '=', 'assign_site.site_assign')
							-> leftjoin('supervisor', 'supervisor.id', '=', 'assign_site.supervisor')
		       ->groupBy('sites.id', 'sites.site_name', 'sites.city_address', 'supervisor.supervisor_name', )
			   ->get();
		if($task){
			return response()->json(['status'=>true, 'data'=>$task]);
		}else{
			return response()->json(['status'=>false, 'message'=>'No Task Found']);
		}
	}

		// get all sites details and supervisor name
	public function getAssignSite(Request $request)
{
     $task = DB::table('assign_site')

       ->leftJoin('sites', 'sites.id', '=', 'assign_site.site_assign')
        ->leftJoin('supervisor', 'supervisor.id', '=', 'assign_site.supervisor')
		 ->where('supervisor', $request->supervisor_id)
        ->select( 'sites.id', 'sites.site_name', 'sites.city_address', 'supervisor.supervisor_name')
        ->groupBy('sites.id', 'sites.site_name', 'sites.city_address','supervisor.supervisor_name')
        ->get();

    if ($task->isNotEmpty()) {
        return response()->json(['status' => true, 'data' => $task]);
    } else {
        return response()->json(['status' => false, 'message' => 'No Task Found']);
    }
}

// get particular site by site id
	public function getAssignSiteById(Request $request)
	{
		$task = Site::where('id', $request->site_id)->get();
		if($task){
			return response()->json(['status'=>true, 'data'=>$task]);
		}else{
			return response()->json(['status'=>false, 'message'=>'No Task Found']);
		}
	}


//Get all main task like construction etc.
	public function getCategory(Request $request)
	{
		$category = TaskCategory::all();
		if($category){
			return response()->json(['status'=>true, 'data'=>$category]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}



// post task for a particular site
	public function postTask(Request $request)
	{
	$task = Task::create([
		'site_id'=>$request->input('site_id'),
		'task_category_id'=>$request->input('task_category_id'),
		'description'=>$request->input('description'),
		//'start_date'=>$request->input('start_date'),
		//'end_date'=>$request->input('end_date'),
	]);

		if($task){
		 	return response()->json(['status'=>true, 'message'=>'Data Submitted Successfully']);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}


// retrieve all working task against site id
	public function getTask(Request $request){
		$task = Task::
		leftJoin('task_category', 'task_category.id', '=', 'task.task_category_id')
		->where('site_id', $request->site_id)
		->select('task.*', 'task_category.category_name' )
			->get();
		  if ($task->isEmpty()) {
        return response()->json(['status' => false, 'message' => 'No tasks found']);
    } else {
        return response()->json(['status' => true, 'data' => $task]);
    }
	}

	//To retrieve all sub category of a task like in construction category the subcategory is ceiling work.
	public function getTaskSubCategory(Request $request)
	{
		$subcategory = TaskSubCategory::where('category_id', $request->category_id)->get();
		if($subcategory){
			return response()->json(['status'=>true, 'data'=>$subcategory]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}

//To retrieve all contractors
	public function getAllContractor(){
		$contractor = Contractor::all();
		if($contractor){
			return response()->json(['status'=>true, 'data'=>$contractor]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}

	}

//To retrieve all working unit type only

public function getWorkingUnitType(){
		$unitType = WorkingUnitType::all();
		if($unitType){
			return response()->json(['status'=>true, 'data'=>$unitType]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}

	}


//Assign particular task sub category to particular contractor of a particular category of a site
	public function postAssignedTask(Request $request)
	{
		$task = AssignedTask::create([
		'site_id' => $request->input('site_id'),
		'task_id' => $request->input('task_id'),
		'task_category_id' => $request->input('task_category_id'),
		'task_subcategory_id' => $request->input('task_subcategory_id'),
		'contractor_id' => $request->input('contractor_id'),
		'start_date' => $request->input('start_date'),
		'end_date' => $request->input('end_date'),
		'total_work' => $request->input('total_work'),
		'work_unit_type_id' => $request->input('work_unit_type_id'),
		]);

		if($task){
			return response()->json(['status'=>true, 'data'=>$task]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}

// get all assigned task based on task id, the task id of  task which is created by app
	public function getAssignedTask(Request $request){
		$contractor = AssignedTask::
		leftJoin('sites', 'sites.id', '=', 'assigned_task.site_id')
		->leftJoin('task', 'task.id', '=', 'assigned_task.task_id')
		->leftJoin('task_category', 'task_category.id', '=', 'assigned_task.task_category_id')
		->leftJoin('task_subcategory', 'task_subcategory.id', '=', 'assigned_task.task_subcategory_id')
		->leftJoin('contractor', 'contractor.id', '=', 'assigned_task.contractor_id')
		->leftJoin('working_unit_type', 'working_unit_type.id', '=', 'assigned_task.work_unit_type_id')

 ->where('assigned_task.task_id', $request->task_id)
->where('assigned_task.site_id', $request->site_id)
->select( 'assigned_task.task_id', 'sites.site_name', 'task_category.category_name', 'task_subcategory.subcategory_name', 'contractor.contractor_name', 'working_unit_type.working_unit_type', 'assigned_task.start_date', 'assigned_task.end_date', 'assigned_task.total_work')
->get();
		if($contractor){
			return response()->json(['status'=>true, 'data'=>$contractor]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}

	}


//Add issue of that assigned task
	public function postAssignedTaskIssues2(Request $request)
	{
		$task = AssignedTaskIssues::create([
		'assigned_task_id' => $request->input('assigned_task_id'),
		'issue_id' => $request->input('issue_id'),
		]);

		if($task){
			return response()->json(['status'=>true, 'data'=>$task]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}

//Get that issues based on task
	public function getAssignedTaskIssues2(){
		$contractor = AssignedTaskIssues::where('assigned_task_id', $request->assigned_task_id)->get();
		if($contractor){
			return response()->json(['status'=>true, 'data'=>$contractor]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}

	}


	public function addTeamContact(Request $request)
	{
		$contact = TeamContact::create([
		'site_id'=> $request->input('site_id'),
		'team_name'=> $request->input('team_name'),
		'contact'=> $request->input('contact'),
		'work'=> $request->input('work'),
		]);

		if($contact){
			return response()->json(['status'=>true, 'message'=>'Data Submitted Successfully']);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);			}
	}

	public function getTeamContact(Request $request)
	{
		$contact = TeamContact::where('site_id', $request->site_id)->get();
		if($contact){
			return response()->json(['status'=>true, 'data'=>$contact]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}



	public function getMaterial(Request $request)
	{
		$material = Material::all();
		if($material){
			return response()->json(['status'=>true, 'data'=>$material]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}

	public function getRawMaterial(Request $request)
	{
		$material = RawMaterial::where('raw_material.material_id', $request->material)
			->leftJoin('brand', 'brand.id', '=', 'raw_material.brand_id')
			->leftJoin('unit_type', 'unit_type.id', '=', 'raw_material.unit')
			->leftJoin('material', 'material.id', '=', 'raw_material.material_id')
			->select('material.material', 'brand.brand', 'unit_type.unit_type', 'raw_material.raw_material_name', 'raw_material.id',  'raw_material.brand_id', 'raw_material.maximum_keeping_quantity', 'raw_material.minimum_keeping_quantity', )
			->get();
		if($material){
			return response()->json(['status'=>true, 'data'=>$material]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}

	public function getRawMaterialBrand(Request $request)
	{
		$material = RawMaterial::where('id', $request->raw_material_id)
			->leftJoin('brand', 'brand.id', '=', 'raw_material.brand_id')
			->select('brand.brand')->get();
		if($material){
			return response()->json(['status'=>true, 'data'=>$material]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}

	public function postRequestMaterial(Request $request)
	{
		$material = RequestedMaterial::create([
		'site_id' => $request->input('site_id'),
		'supervisor_id' => $request->input('supervisor_id'),
		'material_id' => $request->input('material_id'),
		'raw_material_id' => $request->input('raw_material_id'),
		'brand_id' => $request->input('brand_id'),
		'requested_quantity' => $request->input('requested_quantity'),
		'material_unit_type_id' => $request->input('unit_id'),

		]);

		if($material){
			return response()->json(['status'=>true, 'data'=>$material]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}


	public function getRequestedMaterial(Request $request)
	{
		$material = RequestedMaterial::
leftJoin('material', 'material.id', '=', 'requested_material.material_id')
->leftJoin('raw_material', 'raw_material.id', '=', 'requested_material.raw_material_id')
->leftJoin('brand', 'brand.id', '=', 'requested_material.brand_id')
->leftJoin('users', 'users.id', '=', 'requested_material.supervisor_id')
->leftJoin('unit_type', 'unit_type.id', '=', 'requested_material.material_unit_type_id')
->leftJoin('issue_material_by_inventory', 'issue_material_by_inventory.requested_material_id', '=', 'requested_material.id')
->leftJoin('status', 'status.id', '=', 'issue_material_by_inventory.app_status')
 ->where('requested_material.site_id', $request->site_id)
->whereNull('requested_material.received_quantity')
->select( 'material.material', 'requested_material.id', 'raw_material.raw_material_name', 'users.name as supervisor_name', 'requested_material.requested_quantity', 'unit_type.unit_type', 'brand.brand', 'requested_material.created_at', 'status.status', 'issue_material_by_inventory.issue_material')
//->groupBy('material.material', 'requested_material.*')
->get()
	  ->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });
		if($material){
			return response()->json(['status'=>true, 'data'=>$material]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}


public function getAllIssues(Request $request)
{
$issue = Issues::all();

	if($issue){
			return response()->json(['status'=>true, 'data'=>$issue]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
}


//Add issue of that assigned task
	public function postAssignedTaskIssues33(Request $request)
	{

		 // Store the uploaded file
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('photo'), $fileName);
        $photoPath = '' . $fileName;
    } else {
        $photoPath = null;
    }
		$task = AssignedTaskIssues::create([
		'assigned_task_id' => $request->input('assigned_task_id'),
		'issue_id' => $request->input('issue_id'),
		'photo' => $photoPath,
		]);

		if($task){
			return response()->json(['status'=>true, 'data'=>$task]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}


public function postAssignedTaskIssues(Request $request)
{
    if ($request->has('photo')) {
        $photo = $request->input('photo');
        $photo = str_replace('data:image/png;base64,', '', $photo);
        $photo = str_replace(' ', '+', $photo);
        $photoName = time() . '.png';
        $filePath = public_path('photo') . '/' . $photoName;
        File::put($filePath, base64_decode($photo));
        $photoPath = $photoName;
    } else {
        $photoPath = null;
    }

    $task = AssignedTaskIssues::create([
        'assigned_task_id' => $request->input('assigned_task_id'),
        'issue_id' => $request->input('issue_id'),
        'photo' => $photoPath,
    ]);

    if ($task) {
        return response()->json(['status' => true, 'data' => $task]);
    } else {
        return response()->json(['status' => false, 'message' => 'Something Error Occured']);
    }
}
	public function getAssignedTaskIssues(Request $request)
	{
		$task = AssignedTaskIssues::where('assigned_task_id', $request->assigned_task_id)
			->leftJoin('issues', 'issues.id', '=', 'assigned_task_issues.issue_id')
			->select('assigned_task_issues.*', 'issues.issue')
			->get();

		if($task){
			return response()->json(['status'=>true, 'data'=>$task]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}

	}

	public function getAllMaterialBrands(Request $request)
	{
	 $brand = Brand::where('material_id', $request->material_id)->get();
		if($brand){
			return response()->json(['status'=>true, 'data'=>$brand]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}

	}

	public function getAllMaterialUnitType(Request $request)
	{
		$unitType = UnitType::all();
		if($unitType){
			return response()->json(['status'=>true, 'data'=>$unitType]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}

	public function postReceivedMaterial2(Request $request)
	{
		 $material = RequestedMaterial::where('id', $request->requested_material_id)->update([
        'received_quantity' => $request->input('received_quantity'),
        'remaining_quantity' => $request->input('remaining_quantity'),
		'received_remark' => $request->input('received_remark'),
        //'specification' => $request->input('specification'), // Uncomment this line if you need to update the specification field
    ]);


		if($material){
			return response()->json(['status'=>true, 'data'=>$material]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}

	public function postReceivedMaterial(Request $request)
{
    // Update the RequestedMaterial table
    $material = RequestedMaterial::where('id', $request->requested_material_id)->update([
        'received_quantity' => $request->input('received_quantity'),
        'remaining_quantity' => $request->input('remaining_quantity'),
        'received_remark' => $request->input('received_remark'),
    ]);

    // If the update on RequestedMaterial was successful, proceed to update the other tables
    if ($material) {
        // Update the app_status in issue_material_by_inventory
        $inventoryUpdate = IssueMaterialByInventory::where('requested_material_id', $request->requested_material_id)
            ->update(['app_status' => 8]);

        // Update the app_status in issue_material_by_warehouse
     //   $warehouseUpdate = IssueMaterialByWareHouse::where('requested_material_id', $request->requested_material_id)
      //      ->update(['app_status' => 8]);

       // if ($inventoryUpdate && $warehouseUpdate) {
		        if ($inventoryUpdate ) {

            return response()->json(['status' => true, 'message' => 'Material and statuses updated successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed to update statuses in related tables']);
        }
    } else {
        return response()->json(['status' => false, 'message' => 'Failed to update material']);
    }
}


		public function getReceivedMaterial(Request $request)
	{
		$material = RequestedMaterial::
leftJoin('material', 'material.id', '=', 'requested_material.material_id')
->leftJoin('brand', 'brand.id', '=', 'requested_material.brand_id')
->leftJoin('unit_type', 'unit_type.id', '=', 'requested_material.material_unit_type_id')
->leftJoin('issue_material_by_inventory', 'issue_material_by_inventory.requested_material_id', '=', 'requested_material.id')
->leftJoin('status', 'status.id', '=', 'issue_material_by_inventory.app_status')
->where('requested_material.site_id', $request->site_id)
->whereNotNull('requested_material.received_quantity')
->select( 'material.material', 'requested_material.id', 'requested_material.received_remark','requested_material.requested_quantity', 'unit_type.unit_type', 'brand.brand', 'requested_material.received_quantity', 'requested_material.remaining_quantity', 'requested_material.created_at', 'issue_material_by_inventory.app_status', 'status.status' )
//->groupBy('material.material', 'requested_material.*')
->get()
	  ->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });
		if($material){
			return response()->json(['status'=>true, 'data'=>$material]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}

	public function postLostMaterialRequest(Request $request)
	{
		$material = LostMaterial::create([
		'site_id' => $request->input('site_id'),
		'material_id' => $request->input('material_id'),
		'raw_material_id' => $request->input('raw_material_id'),
		'brand_id'=>$request->input('brand_id'),
		'unit_type_id' => $request->input('unit_id'),
		//'material_type' => $request->input('material_type'),
		'lost_quantity' => $request->input('lost_quantity'),
		'remark' => $request->input('remark'),
		//'status' => $request->input('status'),

		]);

		if($material){
			return response()->json(['status'=>true, 'data'=>$material]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}

	public function getLostMaterial(Request $request)
	{
		$lostMaterial = LostMaterial::where('site_id', $request->site_id)
			->leftJoin('material', 'material.id', '=', 'lost_material.material_id')
			->leftJoin('raw_material', 'raw_material.id', '=', 'lost_material.raw_material_id')
			->leftJoin('unit_type', 'unit_type.id', '=', 'lost_material.unit_type_id')
			->leftJoin('brand', 'brand.id', '=', 'raw_material.brand_id')
			->select('lost_material.*', 'material.material', 'raw_material.raw_material_name', 'brand.brand', 'unit_type.unit_type')
			->get();
		if($lostMaterial){
			return response()->json(['status'=>true, 'data'=>$lostMaterial]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}

	public function postSupervisorAttendance2(Request $request)
	{
		$attendance = AttendanceSupervisor::create([
		'supervisor_id' => $request->input('supervisor_id'),
		'date' => $request->input('date'),
		'checkin_time' => $request->input('checkin_time'),
		//'checkout_time' => $request->input('checkout_time'),

		]);

		if($attendance){
			return response()->json(['status'=>true, 'data'=>$attendance, 'message'=>'Attendance Added Successfully']);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}


	public function postSupervisorAttendance(Request $request)
{
    // Find the attendance record by supervisor_id and date
    $attendance = AttendanceSupervisor::where('supervisor_id', $request->input('supervisor_id'))
        ->where('date', $request->input('date'))
        ->first();
    // Check if checkout_time is provided
    if ($request->has('checkout_time') && !empty($request->input('checkout_time'))) {

        if ($attendance) {

			   if (!empty($attendance->checkout_time)) {
                return response()->json(['status' => false, 'message' => 'Checkout Time Already Recorded']);
            }
            // Update the checkout_time for the found record
            $attendance->checkout_time = $request->input('checkout_time');
            $attendance->save();

            return response()->json(['status' => true, 'data' => $attendance, 'message' => 'Checkout Time Updated Successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'Attendance Record Not Found']);
        }
    } else {
		 if ($attendance) {
            return response()->json(['status' => false, 'message' => 'Attendance Record Already Exists for this Date']);
        } else {
        // Create a new attendance record
        $attendance = AttendanceSupervisor::create([
            'supervisor_id' => $request->input('supervisor_id'),
            'date' => $request->input('date'),
            'checkin_time' => $request->input('checkin_time'),
            //'checkout_time' => $request->input('checkout_time'), // Not included in creation
        ]);

        if ($attendance) {
            return response()->json(['status' => true, 'data' => $attendance, 'message' => 'Attendance Added Successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'Something Error Occurred']);
        }
    }
}
	}

	public function getSupervisorAttendance(Request $request)
	{
		$attendance = AttendanceSupervisor::all();
		if($attendance){
			return response()->json(['status'=>true, 'data'=>$attendance]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}

	public function getParticularSupervisorAttendance(Request $request)
	{
		$attendance = AttendanceSupervisor::where('supervisor_id', $request->supervisor_id)->get();
		if($attendance){
			return response()->json(['status'=>true, 'data'=>$attendance]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}

	public function getSupervisorAttendanceAgainstDate(Request $request)
{
    // Validate the request data
    $request->validate([
        'from_date' => 'required|date',
        'to_date' => 'required|date',
    ]);

    // Retrieve the date range from the request
    $fromDate = $request->input('from_date');
    $toDate = $request->input('to_date');

    // Fetch attendance data within the specified date range
    $attendance = AttendanceSupervisor::where('supervisor_id', $request->supervisor_id)
		->whereBetween('date', [$fromDate, $toDate])->get();

    // Check if attendance data is found
    if ($attendance->isNotEmpty()) {
        return response()->json(['status' => true, 'data' => $attendance]);
    } else {
        return response()->json(['status' => false, 'message' => 'No attendance records found for the specified date range']);
    }
}


	public function applyLeave(Request $request)
	{
		$leave = ApplyLeave::create([
		'supervisor_id' => $request->input('supervisor_id'),
		'from_date' => $request->input('from_date'),
		'to_date' => $request->input('to_date'),
		'leave_type'=>$request->input('leave_type'),
		'reason' => $request->input('reason'),
		]);
		if($leave){
			return response()->json(['status'=>true, 'data'=>$leave]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}

	public function getAppliedLeaves(Request $request)
	{
		$leave = ApplyLeave::where('supervisor_id', $request->supervisor_id)->get();
		if($leave){
			return response()->json(['status'=>true, 'data'=>$leave]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}

	public function postWorkplace(Request $request)
	{
		$workplace = WorkPlace::create([
		'site_id' => $request -> input('site_id'),
		'supervisor_id' => $request -> input('supervisor_id'),
		'workplace_name' => $request -> input('workplace_name'),
		'workplace_address' => $request -> input('workplace_address'),
		]);

		if($workplace){
			return response()->json(['status'=>true, 'data'=>$workplace]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}

	public function getWorkplace(Request $request)
	{
		$workplace = WorkPlace::where('site_id', $request->site_id)->get();
		if($workplace){
			return response()->json(['status'=>true, 'data'=>$workplace]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}
}
