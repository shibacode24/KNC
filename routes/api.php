<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('registration', [ApiController::class, 'registration']);

Route::post('login', [ApiController::class, 'login']);

Route::get('get_user', [ApiController::class, 'get_user']);

Route::get('getAssignSite', [ApiController::class, 'getAssignSite']);

Route::get('getAssignSiteById', [ApiController::class, 'getAssignSiteById']);

Route::post('addTeamContact', [ApiController::class, 'addTeamContact']);

Route::get('getTeamContact', [ApiController::class, 'getTeamContact']);

Route::post('postTask', [ApiController::class, 'postTask']);

Route::get('getTask', [ApiController::class, 'getTask']);

Route::get('getMaterial', [ApiController::class, 'getMaterial']);

Route::get('getRawMaterial', [ApiController::class, 'getRawMaterial']);

Route::get('getRawMaterialBrand', [ApiController::class, 'getRawMaterialBrand']);

Route::post('postRequestMaterial', [ApiController::class, 'postRequestMaterial']);

Route::get('getRequestedMaterial', [ApiController::class, 'getRequestedMaterial']);

Route::get('getCategory', [ApiController::class, 'getCategory']);

Route::get('getTaskSubCategory', [ApiController::class, 'getTaskSubCategory']);

Route::get('getWorkingUnitType', [ApiController::class, 'getWorkingUnitType']);

Route::get('getAllContractor', [ApiController::class, 'getAllContractor']);

Route::post('postAssignedTask', [ApiController::class, 'postAssignedTask']);

Route::get('getAssignedTask', [ApiController::class, 'getAssignedTask']);

Route::post('postCompleteAssignedTask', [ApiController::class, 'postCompleteAssignedTask']);

Route::get('getAllIssues', [ApiController::class, 'getAllIssues']);

Route::post('postAssignedTaskIssues', [ApiController::class, 'postAssignedTaskIssues']);

Route::get('getAssignedTaskIssues', [ApiController::class, 'getAssignedTaskIssues']);

Route::get('getAllMaterialBrands', [ApiController::class, 'getAllMaterialBrands']);

Route::get('getAllMaterialUnitType', [ApiController::class, 'getAllMaterialUnitType']);

Route::post('postReceivedMaterial', [ApiController::class, 'postReceivedMaterial']);

Route::get('getReceivedMaterial', [ApiController::class, 'getReceivedMaterial']);

Route::post('postLostMaterialRequest', [ApiController::class, 'postLostMaterialRequest']);

Route::get('getLostMaterial', [ApiController::class, 'getLostMaterial']);

Route::post('postSupervisorAttendance', [ApiController::class, 'postSupervisorAttendance']);
Route::get('getSupervisorAttendance', [ApiController::class, 'getSupervisorAttendance']);
Route::get('getParticularSupervisorAttendance', [ApiController::class, 'getParticularSupervisorAttendance']);
Route::get('getSupervisorAttendanceAgainstDate', [ApiController::class, 'getSupervisorAttendanceAgainstDate']);

Route::post('applyLeave', [ApiController::class, 'applyLeave']);

Route::get('getAppliedLeaves', [ApiController::class, 'getAppliedLeaves']);

Route::post('postWorkplace', [ApiController::class, 'postWorkplace']);

Route::get('getWorkplace', [ApiController::class, 'getWorkplace']);

Route::post('postTransferWorkplaceMaterial', [ApiController::class, 'postTransferWorkplaceMaterial']);

Route::get('getTransferWorkplaceMaterial', [ApiController::class, 'getTransferWorkplaceMaterial']);

Route::get('getNonConsumableCategories', [ApiController::class, 'getNonConsumableCategories']);

Route::get('getNonConsumableCategoryMaterial', [ApiController::class, 'getNonConsumableCategoryMaterial']);

Route::post('postMaterialConsumed', [ApiController::class, 'postMaterialConsumed']);

Route::get('getMaterialConsumed', [ApiController::class, 'getMaterialConsumed']);

Route::get('getAllWarehouse', [ApiController::class, 'getAllWarehouse']);

Route::post('postRepairingAndMaintenance', [ApiController::class, 'postRepairingAndMaintenance']);

Route::get('getRepairingAndMaintenance', [ApiController::class, 'getRepairingAndMaintenance']);

Route::post('updateAssignedTaskWeightage', [ApiController::class, 'updateAssignedTaskWeightage']);
