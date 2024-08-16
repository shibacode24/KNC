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
use App\Models\{UnitType, RawMaterial, LostMaterial, ApplyLeave, WorkPlace, TransferWorkPlaceMaterial, NonConsumableCategory, NonConsumableCategoryMaterial, MaterialConsumed, RepairingAndMaintenance, Warehouse, TransferAppMaterial, ConsumedMaterialByWorkplace};
use App\Models\Inventory\IssueMaterialByInventory;
use App\Models\Warehouse\IssueMaterialByWareHouse;
use App\Models\Attendance\AttendanceSupervisor;
use Illuminate\Support\Facades\File;
use App\Models\Contractor;
use Carbon\Carbon;
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
	public function getAssignSite2(Request $request)
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

	public function getAssignSite3(Request $request)
{

    $assignSites = AssignSite::all();
    $userIds = [];

    // Collect all user IDs from the results
    foreach ($assignSites as $site) {
        $userIds = array_merge($userIds, $site->user_id);
    }

    // Remove duplicates
    $userIds = array_unique($userIds);

    // Fetch users from the User model
    $users = User::whereIn('id', $userIds)->pluck('name', 'id');

    // Map user names to each AssignSite
    foreach ($assignSites as $site) {
        $site->user_names = array_map(function($id) use ($users) {
            return $users[$id] ?? null;
        }, $site->user_id);
    }

    if ($assignSites->isNotEmpty()) {
        return response()->json(['status' => true, 'data' => $assignSites]);
    } else {
        return response()->json(['status' => false, 'message' => 'No Task Found']);
    }
}

public function getAssignSite(Request $request)
{
    // Validate the request
    $validated = $request->validate([
        'user_id' => 'required|integer',
    ]);

    $userId = $validated['user_id'];

    // Fetch AssignSite entries where user_id array contains the specified user_id
    $assignSites = AssignSite::whereJsonContains('user_id', $userId)
        ->leftJoin('sites', 'sites.id', '=', 'assign_site.site_assign')
        ->select('sites.id', 'sites.site_name', 'sites.city_address', 'assign_site.user_id')
        ->get();

    // Fetch the user names for the given user_id
    $user = User::find($userId);

    if (!$user) {
        return response()->json(['status' => false, 'message' => 'User Not Found']);
    }

    $userName = $user->name;

    // Map the site names and user name to the result
    $result = $assignSites->map(function ($site) use ($userName) {
        return [
            'site_name' => $site->site_name,
            'user_name' => $userName,
			'city_address' => $site->city_address,
			'site_id' => $site->id,
        ];
    });

    if ($result->isNotEmpty()) {
        return response()->json(['status' => true, 'data' => $result]);
    } else {
        return response()->json(['status' => false, 'message' => 'No Assign Site Found']);
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
		'workplace_id'=>$request->input('workplace_id'),
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
	public function getTask222(Request $request){
		$task = Task::
		leftJoin('task_category', 'task_category.id', '=', 'task.task_category_id')
		->where('site_id', $request->site_id)
		->where('workplace_id', $request->workplace_id)
		->select('task.*', 'task_category.category_name' )
			->get();
		  if ($task->isEmpty()) {
        return response()->json(['status' => false, 'message' => 'No tasks found']);
    } else {
        return response()->json(['status' => true, 'data' => $task]);
    }
	}


	public function getTask333(Request $request) {
    // Get the tasks along with aggregated assigned task counts and statuses
    $tasks = Task::leftJoin('task_category', 'task_category.id', '=', 'task.task_category_id')
        ->leftJoin(DB::raw('(SELECT task_id,
                               COUNT(*) as total_assigned,
                               SUM(CASE WHEN status = "Pending" THEN 1 ELSE 0 END) as pending_count,
                               SUM(CASE WHEN status = "Inprogress" THEN 1 ELSE 0 END) as in_progress_count,
                               SUM(CASE WHEN status = "Delayed" THEN 1 ELSE 0 END) as delayed_count,
							   SUM(CASE WHEN status = "Completed" THEN 1 ELSE 0 END) as completed_count
                           FROM assigned_task
                           GROUP BY task_id) as aggregated_assigned_task'),
            'aggregated_assigned_task.task_id', '=', 'task.id')
        ->where('site_id', $request->site_id)
        ->where('workplace_id', $request->workplace_id)
        ->select(
            'task.*',
            'task_category.category_name',
            'aggregated_assigned_task.total_assigned',
            'aggregated_assigned_task.pending_count',
            'aggregated_assigned_task.in_progress_count',
            'aggregated_assigned_task.delayed_count',
		    'aggregated_assigned_task.completed_count',
        )
        ->get();

    if ($tasks->isEmpty()) {
        return response()->json(['status' => false, 'message' => 'No tasks found']);
    }

    // Process tasks to include status aggregation
    $tasks->each(function($task) {
         if ($task->total_assigned == 0) {
            // No assigned tasks
            $task->status_summary = ['No Assigned Task' => 0];
        } else {
			 $status_summary = [];
        if ($task->pending_count > 0) {
            $status_summary['Pending'] = $task->pending_count;
        }
        if ($task->in_progress_count > 0) {
            $status_summary['Inprogress'] = $task->in_progress_count;
        }
        if ($task->delayed_count > 0) {
            $status_summary['Delayed'] = $task->delayed_count;
        }
		 if ($task->completed_count > 0) {
            $status_summary['Completed'] = $task->completed_count;
        }
        $task->status_summary = $status_summary;
		 }
        // Remove the individual count fields from the response if not needed
        unset($task->pending_count);
        unset($task->in_progress_count);
        unset($task->delayed_count);
		unset($task->completed_count);

    });

    return response()->json(['status' => true, 'data' => $tasks]);
}

	public function getTask(Request $request) {
    // Get the tasks along with aggregated assigned task counts and statuses
    $tasks = Task::leftJoin('task_category', 'task_category.id', '=', 'task.task_category_id')
        ->leftJoin(DB::raw('(SELECT task_id,
                               COUNT(*) as total_assigned,
                               SUM(CASE WHEN status = "Pending" THEN 1 ELSE 0 END) as pending_count,
                               SUM(CASE WHEN status = "Inprogress" THEN 1 ELSE 0 END) as in_progress_count,
                               SUM(CASE WHEN status = "Delayed" THEN 1 ELSE 0 END) as delayed_count,
							   SUM(CASE WHEN status = "Completed" THEN 1 ELSE 0 END) as completed_count,
                               SUM(CASE WHEN status = "Completed" THEN weightage ELSE 0 END) as total_completed_weightage
                           FROM assigned_task
                           GROUP BY task_id) as aggregated_assigned_task'),
            'aggregated_assigned_task.task_id', '=', 'task.id')
        ->where('site_id', $request->site_id)
        ->where('workplace_id', $request->workplace_id)
        ->select(
            'task.*',
            'task_category.category_name',
            'aggregated_assigned_task.total_assigned',
            'aggregated_assigned_task.pending_count',
            'aggregated_assigned_task.in_progress_count',
            'aggregated_assigned_task.delayed_count',
            'aggregated_assigned_task.completed_count',
            'aggregated_assigned_task.total_completed_weightage',
        )
        ->get();

    if ($tasks->isEmpty()) {
        return response()->json(['status' => false, 'message' => 'No tasks found']);
    }

    // Process tasks to include status aggregation
    $tasks->each(function($task) {
        if ($task->total_assigned == 0) {
            // No assigned tasks
            $task->status_summary = ['No Assigned Task' => 0];
        } else {
            $status_summary = [];
            if ($task->pending_count > 0) {
                $status_summary['Pending'] = $task->pending_count;
            }
            if ($task->in_progress_count > 0) {
                $status_summary['Inprogress'] = $task->in_progress_count;
            }
            if ($task->delayed_count > 0) {
                $status_summary['Delayed'] = $task->delayed_count;
            }
            if ($task->completed_count > 0) {
                $status_summary['Completed'] = $task->completed_count;
            }
            $task->status_summary = $status_summary;
        }

        // Remove the individual count fields from the response if not needed
        unset($task->pending_count);
        unset($task->in_progress_count);
        unset($task->delayed_count);
        unset($task->completed_count);
    });

    return response()->json([
        'status' => true,
        'data' => $tasks,
    ]);
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
        $currentDate = Carbon::now()->startOfDay(); // Ensure the current date has no time component
        $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
        $endDate = Carbon::parse($request->input('end_date'))->startOfDay();

        // Determine the status
        if ($currentDate->gt($endDate)) {
            $status = 'Delayed';
        } elseif ($currentDate->gte($startDate) && $currentDate->lte($endDate)) {
            $status = 'Inprogress';
        } elseif ($currentDate->lt($startDate)) {
            $status = 'Pending';
        } else {
            $status = 'Unknown'; // Fallback status if needed
        }

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
            'status' => $status, // Store the determined status
        ]);

        if ($task) {
            return response()->json(['status' => true, 'data' => $task]);
        } else {
            return response()->json(['status' => false, 'message' => 'Something Error Occurred']);
        }
    }


public function getAssignedTask(Request $request)
{
    $tasks = AssignedTask::
        leftJoin('sites', 'sites.id', '=', 'assigned_task.site_id')
        ->leftJoin('task', 'task.id', '=', 'assigned_task.task_id')
        ->leftJoin('task_category', 'task_category.id', '=', 'assigned_task.task_category_id')
        ->leftJoin('task_subcategory', 'task_subcategory.id', '=', 'assigned_task.task_subcategory_id')
        ->leftJoin('contractor', 'contractor.id', '=', 'assigned_task.contractor_id')
        ->leftJoin('working_unit_type', 'working_unit_type.id', '=', 'assigned_task.work_unit_type_id')
        ->where('assigned_task.task_id', $request->task_id)
        ->where('assigned_task.site_id', $request->site_id)
        ->select(
            'assigned_task.id',
            'assigned_task.task_id',
            'sites.site_name',
            'task_category.category_name',
            'task_subcategory.subcategory_name',
            'contractor.contractor_name',
            'working_unit_type.working_unit_type',
            'assigned_task.start_date',
            'assigned_task.end_date',
            'assigned_task.total_work',
            'assigned_task.status'
        )
        ->get();

    // Count the number of tasks for the given task_id
    $taskCount = $tasks->count();

    // Calculate weightage for each task
    $weightage = $taskCount > 0 ? 100 / $taskCount : 0;

    // Update statuses and weightages
    $currentDate = Carbon::now()->startOfDay();
    foreach ($tasks as $task) {
        if ($task->status === 'Completed') {
            // Skip tasks that are already completed
            continue;
        }

        $startDate = Carbon::parse($task->start_date)->startOfDay();
        $endDate = Carbon::parse($task->end_date)->startOfDay();

        if ($currentDate->gt($endDate)) {
            $task->status = 'Delayed';
        } elseif ($currentDate->gte($startDate) && $currentDate->lte($endDate)) {
            $task->status = 'Inprogress';
        } elseif ($currentDate->lt($startDate)) {
            $task->status = 'Pending';
        }

        // Assign weightage
        $task->weightage = $weightage;

        // Save the updated status and weightage
        $task->save();
    }

    if ($tasks->isNotEmpty()) {
        return response()->json(['status' => true, 'data' => $tasks]);
    } else {
        return response()->json(['status' => false, 'message' => 'No tasks found for the given criteria.']);
    }
}

	 public function postCompleteAssignedTask(Request $request){
                $complete_task = AssignedTask::where('id', $request->assigned_task_id)->first();
                if ($complete_task->id) {
                    $complete_task->update([

                         'status'=>'Completed',
                    ]);
                    return response()->json(['status' => true, 'message' => 'Data Updated Successfully']);
                } else {
                    return response()->json(['status' => false, 'message' => 'Something Error Occure At Server']);
                }
            }
	public function updateAssignedTaskWeightage(Request $request){
                $complete_task = AssignedTask::where('id', $request->assigned_task_id)->first();
                if ($complete_task->id) {
                    $complete_task->update([

                        'weightage'=>$request->weightage,
                    ]);
                    return response()->json(['status' => true, 'message' => 'Data Updated Successfully']);
                } else {
                    return response()->json(['status' => false, 'message' => 'Something Error Occure At Server']);
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
			->select('material.material', 'brand.brand', 'unit_type.unit_type', 'unit_type.id as unit_id', 'raw_material.raw_material_name', 'raw_material.id',  'raw_material.brand_id', 'raw_material.maximum_keeping_quantity', 'raw_material.minimum_keeping_quantity',)
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
		'material_unit_type_id' => $request->input('unit_id'),
		'requested_quantity' => $request->input('requested_quantity'),
		'material_type' => $request->input('material_type'),

		]);

		if($material){
			return response()->json(['status'=>true, 'data'=>$material]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}



	public function getRequestedConsumableMaterial(Request $request)
	{
		$material = RequestedMaterial::
leftJoin('material', 'material.id', '=', 'requested_material.material_id')
->leftJoin('raw_material', 'raw_material.id', '=', 'requested_material.raw_material_id')
->leftJoin('brand', 'brand.id', '=', 'requested_material.brand_id')
->leftJoin('users', 'users.id', '=', 'requested_material.supervisor_id')
->leftJoin('unit_type', 'unit_type.id', '=', 'raw_material.unit')
->leftJoin('issue_material_by_inventory', 'issue_material_by_inventory.requested_material_id', '=', 'requested_material.id')
->leftJoin('status', 'status.id', '=', 'issue_material_by_inventory.app_status')
 ->where('requested_material.site_id', $request->site_id)
->where('requested_material.material_type', 'Consumable')
->whereNull('requested_material.received_quantity')
->select( 'material.material', 'requested_material.id', 'raw_material.raw_material_name', 'users.name as supervisor_name', 'requested_material.requested_quantity', 'unit_type.unit_type', 'brand.brand', 'requested_material.material_type', 'requested_material.created_at', 'status.status', 'issue_material_by_inventory.issue_material')
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

	public function getRequestedNonConsumableMaterial(Request $request)
	{
		$material = RequestedMaterial::
leftJoin('material', 'material.id', '=', 'requested_material.material_id')
->leftJoin('raw_material', 'raw_material.id', '=', 'requested_material.raw_material_id')
->leftJoin('brand', 'brand.id', '=', 'requested_material.brand_id')
->leftJoin('users', 'users.id', '=', 'requested_material.supervisor_id')
->leftJoin('unit_type', 'unit_type.id', '=', 'raw_material.unit')
->leftJoin('issue_material_by_inventory', 'issue_material_by_inventory.requested_material_id', '=', 'requested_material.id')
->leftJoin('status', 'status.id', '=', 'issue_material_by_inventory.app_status')
 ->where('requested_material.site_id', $request->site_id)
->where('requested_material.material_type', 'Non-Consumable')
->whereNull('requested_material.received_quantity')
->select( 'material.material', 'requested_material.id', 'raw_material.raw_material_name', 'users.name as supervisor_name', 'requested_material.requested_quantity', 'unit_type.unit_type', 'brand.brand', 'requested_material.material_type', 'requested_material.created_at', 'status.status', 'issue_material_by_inventory.issue_material')
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
		'latitude' => $request->input('latitude'),
		'longitude' => $request->input('longitude'),
    ]);

    if ($task) {
        return response()->json(['status' => true, 'data' => $task]);
    } else {
        return response()->json(['status' => false, 'message' => 'Something Error Occured']);
    }
}

	public function getAssignedTaskIssues(Request $request)
{
    // Retrieve the assigned task issues
    $taskIssues = AssignedTaskIssues::where('assigned_task_id', $request->assigned_task_id)->get();

    if ($taskIssues->isEmpty()) {
        return response()->json(['status' => false, 'message' => 'No tasks found']);
    }

    // Collect all issue IDs from the task issues
    $issueIds = $taskIssues->flatMap(function ($taskIssue) {
        return explode(',', $taskIssue->issue_id);
    })->unique()->toArray();

    // Retrieve the issues
    $issues = Issues::whereIn('id', $issueIds)->get()->keyBy('id');

    // Append issue details to each task issue
    $taskIssues->each(function ($taskIssue) use ($issues) {
        $issueIds = explode(',', $taskIssue->issue_id); // Convert the comma-separated string to an array
        $taskIssue->issue_details = collect($issueIds)->map(function ($id) use ($issues) {
            return $issues->get($id);
        });
    });

    return response()->json(['status' => true, 'data' => $taskIssues]);
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



	public function getConsumableReceivedMaterial(Request $request)
{
    $material = RequestedMaterial::
        leftJoin('material', 'material.id', '=', 'requested_material.material_id')
        ->leftJoin('raw_material', 'raw_material.id', '=', 'requested_material.raw_material_id')
        ->leftJoin('brand', 'brand.id', '=', 'raw_material.brand_id')
        ->leftJoin('unit_type', 'unit_type.id', '=', 'raw_material.unit')
        ->leftJoin('issue_material_by_inventory', 'issue_material_by_inventory.requested_material_id', '=', 'requested_material.id')
        ->leftJoin('status', 'status.id', '=', 'issue_material_by_inventory.app_status')
        ->where('requested_material.site_id', $request->site_id)
		->where('requested_material.material_type', 'Consumable')
        ->whereNotNull('requested_material.received_quantity')
        ->selectRaw(
            'material.material,
            raw_material.raw_material_name,
            requested_material.material_id,
            requested_material.raw_material_id,
            SUM(requested_material.requested_quantity) as requested_quantity,
            unit_type.unit_type,
            brand.brand,
            SUM(requested_material.received_quantity) as received_quantity,
            SUM(requested_material.remaining_quantity) as remaining_quantity,
            DATE(requested_material.created_at) as date,
            issue_material_by_inventory.app_status,
            status.status'
        )
        ->groupBy(
            'material.material',
            'raw_material.raw_material_name',
            'requested_material.material_id',
            'requested_material.raw_material_id',
            'unit_type.unit_type',
            'brand.brand',
            'date', // Group by the formatted date
            'issue_material_by_inventory.app_status',
            'status.status'
        )
        ->get()
        ->groupBy('date'); // Group by the formatted date part

    if ($material) {
        return response()->json(['status' => true, 'data' => $material]);
    } else {
        return response()->json(['status' => false, 'message' => 'Something Error Occured']);
    }
}





	public function getNonConsumableReceivedMaterial(Request $request)
{
    $material = RequestedMaterial::
        leftJoin('material', 'material.id', '=', 'requested_material.material_id')
        ->leftJoin('raw_material', 'raw_material.id', '=', 'requested_material.raw_material_id')
        ->leftJoin('brand', 'brand.id', '=', 'raw_material.brand_id')
        ->leftJoin('unit_type', 'unit_type.id', '=', 'raw_material.unit')
        ->leftJoin('issue_material_by_inventory', 'issue_material_by_inventory.requested_material_id', '=', 'requested_material.id')
        ->leftJoin('status', 'status.id', '=', 'issue_material_by_inventory.app_status')
        ->where('requested_material.site_id', $request->site_id)
		->where('requested_material.material_type', 'Non-Consumable')
        ->whereNotNull('requested_material.received_quantity')
        ->selectRaw(
            'material.material,
            raw_material.raw_material_name,
            requested_material.material_id,
            requested_material.raw_material_id,
            SUM(requested_material.requested_quantity) as requested_quantity,
            unit_type.unit_type,
            brand.brand,
            SUM(requested_material.received_quantity) as received_quantity,
            SUM(requested_material.remaining_quantity) as remaining_quantity,
            DATE(requested_material.created_at) as date,
            issue_material_by_inventory.app_status,
            status.status'
        )
        ->groupBy(
            'material.material',
            'raw_material.raw_material_name',
            'requested_material.material_id',
            'requested_material.raw_material_id',
            'unit_type.unit_type',
            'brand.brand',
            'date', // Group by the formatted date
            'issue_material_by_inventory.app_status',
            'status.status'
        )
        ->get()
        ->groupBy('date'); // Group by the formatted date part

    if ($material) {
        return response()->json(['status' => true, 'data' => $material]);
    } else {
        return response()->json(['status' => false, 'message' => 'Something Error Occured']);
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
		'material_type' => $request->input('material_type'),
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

	public function getConsumableLostMaterial(Request $request)
	{
		$lostMaterial = LostMaterial::where('site_id', $request->site_id)
			->where('lost_material.material_type', 'Consumable')
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

	public function getNonConsumableLostMaterial(Request $request)
	{
		$lostMaterial = LostMaterial::where('site_id', $request->site_id)
			->where('lost_material.material_type', 'Non-Consumable')
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


		public function postTransferWorkplaceMaterial(Request $request)
	{
		$workplace = TransferWorkPlaceMaterial::create([
		'site_id' => $request -> input('site_id'),
		'source_workplace_id' => $request -> input('source_workplace_id'),
		'target_workplace_id' => $request -> input('target_workplace_id'),
		'material_id' => $request -> input('material_id'),
		'quantity' => $request -> input('quantity'),
		]);

		if($workplace){
			return response()->json(['status'=>true, 'data'=>$workplace]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}

		public function getTransferWorkplaceMaterial(Request $request)
	{
		$workplace = TransferWorkPlaceMaterial::where('site_id', $request->site_id)->get();
		if($workplace){
			return response()->json(['status'=>true, 'data'=>$workplace]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}

	public function getNonConsumableCategories(Request $request)
	{
		$category = NonConsumableCategory::all();
		if($category){
			return response()->json(['status'=>true, 'data'=>$category]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}

		public function getNonConsumableCategoryMaterial(Request $request)
	{

		$material = NonConsumableCategoryMaterial::where('non_consumable_category_material.category_id', $request->category_id)
			->leftJoin('non_consumable_brand', 'non_consumable_brand.id', '=', 'non_consumable_category_material.brand_id')
			->leftJoin('non_consumable_unit_type', 'non_consumable_unit_type.id', '=', 'non_consumable_category_material.unit_type_id')
			->leftJoin('non_consumable_category', 'non_consumable_category.id', '=', 'non_consumable_category_material.category_id')
			->select('non_consumable_category.category', 'non_consumable_brand.brand', 'non_consumable_unit_type.unit_type', 'non_consumable_category_material.unit_type_id', 'non_consumable_category_material.sub_category_name', 'non_consumable_category_material.id',  'non_consumable_category_material.brand_id', 'non_consumable_category_material.maximum_keeping_quantity', 'non_consumable_category_material.minimum_keeping_quantity',)
			->get();
		if($material){
			return response()->json(['status'=>true, 'data'=>$material]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}

	public function getNonConsumableBrand(Request $request)
	{
		$category = NonConsumableBrand::where('material_id', $request->category_id)->get();
		if($category){
			return response()->json(['status'=>true, 'data'=>$category]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}

	public function getNonConsumableUnitType(Request $request)
	{
		$category = NonConsumableUnitType::all();
		if($category){
			return response()->json(['status'=>true, 'data'=>$category]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}

	public function postMaterialConsumed(Request $request)
	{
		$material = MaterialConsumed::create([
		'site_id' => $request -> input('site_id'),
		'workplace_id' => $request -> input('workplace_id'),
		'material_id' => $request -> input('material_id'),
		'raw_material_id' => $request -> input('raw_material_id'),
		'consumed_quantity' => $request -> input('consumed_quantity'),
		]);

		if($material){
			return response()->json(['status'=>true, 'message'=>'Data Added Successfully', 'data'=>$material]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}


		public function getMaterialConsumed(Request $request)
	{
		$material = MaterialConsumed::
leftJoin('material', 'material.id', '=', 'material_consumed.material_id')
->leftJoin('raw_material', 'raw_material.id', '=', 'material_consumed.raw_material_id')
->leftJoin('unit_type', 'unit_type.id', '=', 'raw_material.unit')
->leftJoin('brand', 'brand.id', '=', 'raw_material.brand_id')
->where('workplace_id', $request->workplace_id)
->select( 'material.material', 'raw_material.raw_material_name', 'unit_type.unit_type', 'brand.brand', 'material_consumed.consumed_quantity', 'material_consumed.created_at')
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


public function getAllWarehouse(){
 $warehouse = Warehouse::all();
	if($warehouse){
			return response()->json(['status'=>true, 'data'=>$warehouse]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
}

	public function getAllSites(Request $request)
	{
	$site = Site::select('id', 'site_name')->get();
		if($site){
        return response()->json(['status' => true, 'message'=>'Data Added Successfully', 'data' => $site]);
    } else {
        return response()->json(['status' => false, 'message' => 'No data found']);
    }
	}

		public function postRepairingAndMaintenance(Request $request)
	{
		$material = RepairingAndMaintenance::create([
		'site_id' => $request -> input('site_id'),
		'warehouse_id' => $request -> input('warehouse_id'),
		'non_consumable_category_id' => $request -> input('non_consumable_category_id'),
		'non_consumable_material_id' => $request -> input('non_consumable_material_id'),
		'quantity' => $request -> input('quantity'),
		'remark' => $request -> input('remark'),
		]);

		if($material){
			return response()->json(['status'=>true, 'message'=>'Data Added Successfully', 'data'=>$material]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}

public function getRepairingAndMaintenance(Request $request){
 $repairing = RepairingAndMaintenance::where('site_id', $request->site_id)->get();
	if($repairing){
			return response()->json(['status'=>true, 'data'=>$repairing]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
}


		public function postTransferMaterial(Request $request)
	{
		$material = TransferAppMaterial::create([
		'supervisor_id' => $request -> input('supervisor_id'),
		'material_type' => $request -> input('material_type'),
		'transfer_type' =>$request -> input('transfer_type'),
		'source_site_id' => $request -> input('source_site_id'),
		'dest_site_id' => $request -> input('dest_site_id'),
		'dest_warehouse_id' => $request -> input('dest_warehouse_id'),
		'material_id' => $request -> input('material_id'),
		'raw_material_id' => $request -> input('raw_material_id'),
		'brand_id' => $request -> input('brand_id'),
		'unit_type_id' => $request -> input('unit_type_id'),
		'transfer_quantity' => $request -> input('transfer_quantity')
		]);

		if($material){
			return response()->json(['status'=>true, 'message'=>'Data Added Successfully', 'data'=>$material]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}

	public function getTransferConsumableMaterial(Request $request)
{
    $material = TransferAppMaterial::leftJoin('supervisor', 'supervisor_name', '=', 'transfer_app_material.supervisor_id')
		->leftJoin('sites as source', 'source.id', '=', 'transfer_app_material.source_site_id')
        ->leftJoin('sites as dest', 'dest.id', '=', 'transfer_app_material.dest_site_id')
        ->leftJoin('warehouse', 'warehouse.id', '=', 'transfer_app_material.dest_warehouse_id')
		->leftJoin('material', 'material.id', '=', 'transfer_app_material.material_id')
        ->leftJoin('raw_material', 'raw_material.id', '=', 'transfer_app_material.raw_material_id')
        ->leftJoin('brand', 'brand.id', '=', 'transfer_app_material.brand_id')
        ->leftJoin('unit_type', 'unit_type.id', '=', 'transfer_app_material.unit_type_id')
        ->leftJoin('users', 'users.id', '=', 'transfer_app_material.supervisor_id')
		->where('material_type', 'Consumable')
        ->select(
            'transfer_app_material.id',
		    'transfer_app_material.material_type',
            'transfer_app_material.transfer_type',
            'transfer_app_material.supervisor_id',
			'users.name',
		    'transfer_app_material.source_site_id',
			'source.site_name as source_site_name',
			'transfer_app_material.dest_site_id',
			'dest.site_name as dest_site_name',
			'transfer_app_material.dest_warehouse_id',
			'warehouse.warehouse_name',
			'material.material',
			'raw_material.raw_material_name',
			'brand.brand',
			'unit_type.unit_type',
			'transfer_app_material.transfer_quantity',
        )
        ->get();

    if ($material->isNotEmpty()) {
        return response()->json(['status' => true, 'message'=>'Data Added Successfully', 'data' => $material]);
    } else {
        return response()->json(['status' => false, 'message' => 'No data found']);
    }
}


	public function getTransferNonConsumableMaterial(Request $request)
{
    $material = TransferAppMaterial::leftJoin('supervisor', 'supervisor_name', '=', 'transfer_app_material.supervisor_id')
		->leftJoin('sites as source', 'source.id', '=', 'transfer_app_material.source_site_id')
        ->leftJoin('sites as dest', 'dest.id', '=', 'transfer_app_material.dest_site_id')
        ->leftJoin('warehouse', 'warehouse.id', '=', 'transfer_app_material.dest_warehouse_id')
		->leftJoin('non_consumable_category', 'non_consumable_category.id', '=', 'transfer_app_material.material_id')
        ->leftJoin('non_consumable_category_material', 'non_consumable_category_material.id', '=', 'transfer_app_material.raw_material_id')
        ->leftJoin('non_consumable_brand', 'non_consumable_brand.id', '=', 'transfer_app_material.brand_id')
        ->leftJoin('non_consumable_unit_type', 'non_consumable_unit_type.id', '=', 'transfer_app_material.unit_type_id')
        ->leftJoin('users', 'users.id', '=', 'transfer_app_material.supervisor_id')
		->where('material_type', 'Non-Consumable')
        ->select(
            'transfer_app_material.id',
		    'transfer_app_material.material_type',
            'transfer_app_material.transfer_type',
            'transfer_app_material.supervisor_id',
			'users.name',
		    'transfer_app_material.source_site_id',
			'source.site_name as source_site_name',
			'transfer_app_material.dest_site_id',
			'dest.site_name as dest_site_name',
			'transfer_app_material.dest_warehouse_id',
			'warehouse.warehouse_name',
			'non_consumable_category.category',
			'non_consumable_category_material.material',
			'non_consumable_brand.brand',
			'non_consumable_unit_type.unit_type',
			'transfer_app_material.transfer_quantity',
        )
        ->get();

    if ($material->isNotEmpty()) {
        return response()->json(['status' => true, 'message'=>'Data Added Successfully', 'data' => $material]);
    } else {
        return response()->json(['status' => false, 'message' => 'No data found']);
    }
}

		public function postConsumedMaterialByWorkplace(Request $request)
	{
		$material = ConsumedMaterialByWorkplace::create([
		'supervisor_id' => $request -> input('supervisor_id'),
		'site_id' => $request -> input('site_id'),
		'workplace_id' => $request -> input('workplace_id'),
		'material_id' => $request -> input('material_id'),
		'raw_material_id' => $request -> input('raw_material_id'),
		'brand_id' => $request -> input('brand_id'),
		'unit_type_id' => $request -> input('unit_type_id'),
		]);

		if($material){
			return response()->json(['status'=>true, 'message'=>'Data Added Successfully', 'data'=>$material]);
		}else{
			return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
		}
	}

	public function getConsumedMaterialByWorkplace(Request $request)
	{
	$material = ConsumedMaterialByWorkplace::where('workplace_id', $request->workplace_id)
		->leftJoin('sites', 'sites.id', '=', 'consumed_material_by_workplace.site_id')
		->leftJoin('workplace', 'workplace.id', '=', 'consumed_material_by_workplace.workplace_id')
		->leftJoin('users', 'users.id', '=', 'consumed_material_by_workplace.supervisor_id')
		->leftJoin('material', 'material.id', '=', 'consumed_material_by_workplace.material_id')
		->leftJoin('raw_material', 'raw_material.id', '=', 'consumed_material_by_workplace.raw_material_id')
		->leftJoin('brand', 'brand.id', '=', 'consumed_material_by_workplace.brand_id')
		->leftJoin('unit_type', 'unit_type.id', '=', 'consumed_material_by_workplace.unit_type_id')
		->select('consumed_material_by_workplace.*', 'sites.site_name', 'workplace.workplace_name', 'users.name', 'material.material', 'raw_material.raw_material_name', 'brand.brand', 'unit_type.unit_type')
		->get()
		  ->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });
		if($material){
        return response()->json(['status' => true, 'message'=>'Data Added Successfully', 'data' => $material]);
    } else {
        return response()->json(['status' => false, 'message' => 'No data found']);
    }
	}



public function postTrackEmpLocation(Request $request)
{
    $emp = TrackEmpLocation::create([
        'emp_type' => $request-> input('emp_type'),
        'emp_id'=> $request->input('emp_id'),
        'latitude'=> $request->input('latitude'),
        'longitude'=> $request->input('longitude'),
    ]);

    if($emp){
        return response()->json(['status' => true, 'message'=>'Data Added Successfully']);
    }else{
        return response()->json(['status'=>false, 'message'=>'Something Error Occured']);
    }

}


}
