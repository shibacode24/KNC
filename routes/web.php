<?php

use App\Http\Controllers\panel\PurchaseDepartmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\panel\DashboardController;
use App\Http\Controllers\panel\UserRolesController;
use App\Http\Controllers\panel\WarehouseController;
use App\Http\Controllers\panel\InventoryManagementController;
use App\Http\Controllers\panel\AccountDepartmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('adminpanel.login');
});


//DashboardController
Route::get('/login', [DashboardController::class, 'index'])->name('login');

Route::post('/check', [DashboardController::class, 'check'])->name('check');

Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');


Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware('auth')->name('dashboard');

Route::get('/assign-site', [DashboardController::class, 'assign_site'])->name('assign_site');
Route::get('assign-site-destroy/{id}', [DashboardController::class, 'assignSiteDestroy'])->name('assign-site-destroy');
Route::get('assign-site-edit/{id}', [DashboardController::class, 'assignSiteEdit'])->name('assign-site-edit');
Route::post('assign-site-update', [DashboardController::class, 'assignSiteUpdate'])->name('assign-site-update');
Route::get('/get-users-by-role', [DashboardController::class, 'getUsersByRole'])->name('get-users-by-role');
//Route::get('/get-users-by-role', 'YourController@getUsersByRole')->name('get-users-by-role');

Route::get('/city', [DashboardController::class, 'city'])->name('city');
Route::get('city-destroy/{id}', [DashboardController::class, 'cityDestroy'])->name('city-destroy');
Route::get('city-edit/{id}', [DashboardController::class, 'cityEdit'])->name('city-edit');
Route::post('city-update', [DashboardController::class, 'cityUpdate'])->name('city-update');

Route::get('/firm', [DashboardController::class, 'firm'])->name('firm');
Route::get('firm-destroy/{id}', [DashboardController::class, 'firmDestroy'])->name('firm-destroy');
Route::get('firm-edit/{id}', [DashboardController::class, 'firmEdit'])->name('firm-edit');
Route::post('firm-update', [DashboardController::class, 'firmUpdate'])->name('firm-update');

Route::get('/branch', [DashboardController::class, 'branch'])->name('branch');
Route::get('branch-destroy/{id}', [DashboardController::class, 'branchDestroy'])->name('branch-destroy');
Route::get('branch-edit/{id}', [DashboardController::class, 'branchEdit'])->name('branch-edit');
Route::post('branch-update', [DashboardController::class, 'branchUpdate'])->name('branch-update');

Route::get('/client', [DashboardController::class, 'client'])->name('client');
Route::get('client-destroy/{id}', [DashboardController::class, 'clientDestroy'])->name('client-destroy');
Route::get('client-edit/{id}', [DashboardController::class, 'clientEdit'])->name('client-edit');
Route::post('client-update', [DashboardController::class, 'clientUpdate'])->name('client-update');

Route::get('/site', [DashboardController::class, 'site'])->name('site');
Route::get('site-destroy/{id}', [DashboardController::class, 'siteDestroy'])->name('site-destroy');
Route::get('site-edit/{id}', [DashboardController::class, 'siteEdit'])->name('site-edit');
Route::post('site-update', [DashboardController::class, 'siteUpdate'])->name('site-update');

Route::get('/unit_type', [DashboardController::class, 'unit_type'])->name('unit_type');
Route::get('unit-type-destroy/{id}', [DashboardController::class, 'unitTypeDestroy'])->name('unit-type-destroy');
Route::get('unit-type-edit/{id}', [DashboardController::class, 'unitTypeEdit'])->name('unit-type-edit');
Route::post('unit-type-update', [DashboardController::class, 'unitTypeUpdate'])->name('unit-type-update');

Route::get('/material', [DashboardController::class, 'material'])->name('material');
Route::get('material-destroy/{id}', [DashboardController::class, 'materialDestroy'])->name('material-destroy');
Route::get('material-edit/{id}', [DashboardController::class, 'materialEdit'])->name('material-edit');
Route::post('material-update', [DashboardController::class, 'materialUpdate'])->name('material-update');

Route::get('/raw_material', [DashboardController::class, 'raw_material'])->name('raw_material');
Route::get('raw-material-destroy/{id}', [DashboardController::class, 'rawMaterialDestroy'])->name('raw-material-destroy');
Route::get('raw-material-edit/{id}', [DashboardController::class, 'rawMaterialEdit'])->name('raw-material-edit');
Route::post('raw-material-update', [DashboardController::class, 'rawMaterialUpdate'])->name('raw-material-update');
Route::get('/brands/getBrands', [DashboardController::class, 'getBrands'])->name('brands.getBrands');

Route::get('/brand', [DashboardController::class, 'brand'])->name('brand');
Route::get('brand-destroy/{id}', [DashboardController::class, 'brandDestroy'])->name('brand-destroy');
Route::get('brand-edit/{id}', [DashboardController::class, 'brandEdit'])->name('brand-edit');
Route::post('brand-update', [DashboardController::class, 'brandUpdate'])->name('brand-update');

Route::get('/warehouse', [DashboardController::class, 'warehouse'])->name('warehouse');
Route::get('warehouse-destroy/{id}', [DashboardController::class, 'warehouseDestroy'])->name('warehouse-destroy');
Route::get('warehouse-edit/{id}', [DashboardController::class, 'warehouseEdit'])->name('warehouse-edit');
Route::post('warehouse-update', [DashboardController::class, 'warehouseUpdate'])->name('warehouse-update');

Route::get('/contractor', [DashboardController::class, 'contractor'])->name('contractor');
Route::get('contractor-destroy/{id}', [DashboardController::class, 'contractorDestroy'])->name('contractor-destroy');
Route::get('contractor-edit/{id}', [DashboardController::class, 'contractorEdit'])->name('contractor-edit');
Route::post('contractor-update', [DashboardController::class, 'contractorUpdate'])->name('contractor-update');

Route::get('/vendors', [DashboardController::class, 'vendor'])->name('vendor');
Route::get('vendor-destroy/{id}', [DashboardController::class, 'vendorDestroy'])->name('vendor-destroy');
Route::get('vendors-edit/{id}', [DashboardController::class, 'vendorsEdit'])->name('vendors-edit');
Route::post('vendors-update', [DashboardController::class, 'vendorsUpdate'])->name('vendors-update');

Route::get('/supervisor', [DashboardController::class, 'supervisor'])->name('supervisor');
Route::get('supervisor-destroy/{id}', [DashboardController::class, 'supervisorDestroy'])->name('supervisor-destroy');
Route::get('supervisor-edit/{id}', [DashboardController::class, 'supervisorEdit'])->name('supervisor-edit');
Route::post('supervisor-update', [DashboardController::class, 'supervisorUpdate'])->name('supervisor-update');

//employee
Route::get('/employee', [DashboardController::class, 'employee'])->name('employee');
Route::get('edit_employee/{id}', [DashboardController::class, 'edit_employee'])->name('edit_employee');
Route::post('update_employee', [DashboardController::class, 'update_employee'])->name('update_employee');
Route::post('delete_acc_details', [DashboardController::class, 'delete_acc_details'])->name('delete_acc_details');

//engineer
Route::get('engg', [DashboardController::class, 'engg'])->name('engg');
Route::post('enggstore', [DashboardController::class, 'enggstore'])->name('enggstore');
Route::get('edit_engg/{id}', [DashboardController::class, 'edit_engg'])->name('edit_engg');
Route::get('delete_engg/{id}', [DashboardController::class, 'delete_engg'])->name('delete_engg');
Route::post('update_engg', [DashboardController::class, 'update_engg'])->name('update_engg');

//site_manager
Route::get('site_manager', [DashboardController::class, 'site_manager'])->name('site_manager');
Route::post('site_managerstore', [DashboardController::class, 'site_managerstore'])->name('site_managerstore');
Route::get('edit_site_manager/{id}', [DashboardController::class, 'edit_site_manager'])->name('edit_site_manager');
Route::get('delete_site_manager/{id}', [DashboardController::class, 'delete_site_manager'])->name('delete_site_manager');
Route::post('update_site_manager', [DashboardController::class, 'update_site_manager'])->name('update_site_manager');

//site_incharge
Route::get('site_incharge', [DashboardController::class, 'site_incharge'])->name('site_incharge');
Route::post('site_inchargestore', [DashboardController::class, 'site_inchargestore'])->name('site_inchargestore');
Route::get('edit_site_incharge/{id}', [DashboardController::class, 'edit_site_incharge'])->name('edit_site_incharge');
Route::get('delete_site_incharge/{id}', [DashboardController::class, 'delete_site_incharge'])->name('delete_site_incharge');
Route::post('update_site_incharge', [DashboardController::class, 'update_site_incharge'])->name('update_site_incharge');


Route::get('employee-destroy/{id}', [DashboardController::class, 'employeeDestroy'])->name('employee-destroy');
Route::get('employee-edit/{id}', [DashboardController::class, 'employeeEdit'])->name('employee-edit');
Route::post('employee-update', [DashboardController::class, 'employeeUpdate'])->name('employee-update');

Route::get('/status', [DashboardController::class, 'status'])->name('status');
Route::post('/status-store', [DashboardController::class, 'statusStore'])->name('status-store');
Route::get('status-destroy/{id}', [DashboardController::class, 'statusDestroy'])->name('status-destroy');
Route::get('status-edit/{id}', [DashboardController::class, 'statusEdit'])->name('status-edit');
Route::post('status-update', [DashboardController::class, 'statusUpdate'])->name('status-update');


Route::get('/category', [DashboardController::class, 'category'])->name('category');
Route::post('/category-store', [DashboardController::class, 'categoryStore'])->name('category-store');
Route::get('category-destroy/{id}', [DashboardController::class, 'categoryDestroy'])->name('category-destroy');
Route::get('category-edit/{id}', [DashboardController::class, 'categoryEdit'])->name('category-edit');
Route::post('category-update', [DashboardController::class, 'categoryUpdate'])->name('category-update');


Route::get('/subcategory', [DashboardController::class, 'subcategory'])->name('subcategory');
Route::post('/subcategory-store', [DashboardController::class, 'subcategoryStore'])->name('subcategory-store');
Route::get('subcategory-destroy/{id}', [DashboardController::class, 'subcategoryDestroy'])->name('subcategory-destroy');
Route::get('subcategory-edit/{id}', [DashboardController::class, 'subcategoryEdit'])->name('subcategory-edit');
Route::post('subcategory-update', [DashboardController::class, 'subcategoryUpdate'])->name('subcategory-update');

Route::get('/non-consumable-category', [DashboardController::class, 'nonConsumableCategory'])->name('non-consumable-category');
Route::post('/non-consumable-category-store', [DashboardController::class, 'nonConsumableCategoryStore'])->name('non-consumable-category-store');
Route::get('non-consumable-category-destroy/{id}', [DashboardController::class, 'nonConsumableCategoryDestroy'])->name('non-consumable-category-destroy');

Route::get('/non-consumable-category-material', [DashboardController::class, 'nonConsumableCategoryMaterial'])->name('non-consumable-category-material');
Route::post('/non-consumable-category-material-store', [DashboardController::class, 'nonConsumableCategoryMaterialStore'])->name('non-consumable-category-material-store');
Route::get('non-consumable-category-material-destroy/{id}', [DashboardController::class, 'nonConsumableCategoryMaterialDestroy'])->name('non-consumable-category-material-destroy');

Route::get('/issue', [DashboardController::class, 'issue'])->name('issue');
Route::post('/issue-store', [DashboardController::class, 'issueStore'])->name('issue-store');
Route::get('issue-destroy/{id}', [DashboardController::class, 'issueDestroy'])->name('issue-destroy');
Route::get('issue-edit/{id}', [DashboardController::class, 'issueEdit'])->name('issue-edit');
Route::post('issue-update', [DashboardController::class, 'issueUpdate'])->name('issue-update');

Route::get('working_unit_type', [DashboardController::class, 'workingUnitType'])->name('working_unit_type');
Route::post('working_unit_type_store', [DashboardController::class, 'workingUnitTypeStore'])->name('working_unit_type_store');
Route::get('working-unit-type-destroy/{id}', [DashboardController::class, 'workingUnitTypeDestroy'])->name('working-unit-type-destroy');
Route::get('working_unit_type-edit/{id}', [DashboardController::class, 'workingUnitTypeEdit'])->name('working-unit-type-edit');
Route::post('working-unit-type-update', [DashboardController::class, 'workingUnitTypeUpdate'])->name('working-unit-type-update');

Route::get('app-role', [DashboardController::class, 'appRole'])->name('app-role');
Route::post('store-app-role', [DashboardController::class, 'storeAppRole'])->name('app-role.store');
Route::get('app-role-destroy/{id}', [DashboardController::class, 'appRoleDestroy'])->name('app-role-destroy');

Route::get('panel-role', [DashboardController::class, 'panelRole'])->name('panel-role');
Route::post('store-panel-role', [DashboardController::class, 'storePanelRole'])->name('panel-role.store');
Route::get('panel-role-destroy/{id}', [DashboardController::class, 'panelRoleDestroy'])->name('panel-role-destroy');

//InventoryManagementController
Route::get('/add-material', [InventoryManagementController::class, 'add_material'])->name('add_material');
Route::post('add-material-store', [InventoryManagementController::class, 'addMaterialstore'])->name('add-material-store');
Route::get('/material/getMaterialBrands', [InventoryManagementController::class, 'getMaterialBrands'])->name('material.getBrands');
Route::get('/material/getRawMaterial', [InventoryManagementController::class, 'getRawMaterial'])->name('material.getRawMaterial');

Route::get('/direct-issue-material', [InventoryManagementController::class, 'directIssueMaterial'])->name('direct-issue-material');
Route::post('add-direct-issue-material', [InventoryManagementController::class, 'addDirectIssueMaterial'])->name('direct-issue-material.store');


Route::get('/site-material', [InventoryManagementController::class, 'site_material'])->name('site_material');
Route::get('/viewservicearea', [InventoryManagementController::class, 'viewservicearea'])->name('viewservicearea');
Route::post('/get-available-material', [InventoryManagementController::class, 'getAvailableMaterial'])->name('get-available-material');
Route::post('/add-issued-material', [InventoryManagementController::class, 'addIssuedMaterial'])->name('add-issued-material');

Route::get('/site-non-consumed-material', [InventoryManagementController::class, 'site_non_consumed_material'])->name('site-non-consumed-material');

//WarehouseController
Route::get('/grn', [WarehouseController::class, 'grn'])->name('grn');
Route::post('grn-store', [WarehouseController::class, 'grnStore'])->name('grn-store');
Route::post('/add-issued-material-by-warehouse', [WarehouseController::class, 'addIssuedMaterialByWarehouse'])->name('add-issued-material-by-warehouse');
// GRN Out
Route::get('/issue-material', [WarehouseController::class, 'issue_material'])->name('issue_material');
Route::get('/viewgrn', [WarehouseController::class, 'viewgrn'])->name('viewgrn');

//PurchaseDepartmentController
Route::get('/req-material', [PurchaseDepartmentController::class, 'req_material'])->name('req_material');
Route::post('/store-order', [PurchaseDepartmentController::class, 'storeOrder'])->name('storeOrder');
Route::get('/order-details', [PurchaseDepartmentController::class, 'order_details'])->name('order_details');
Route::get('/feedback', [PurchaseDepartmentController::class, 'feedback'])->name('feedback');
Route::post('/add-invoice', [PurchaseDepartmentController::class, 'addInvoice'])->name('add-invoice');
// direct po
Route::get('/direct-po-list', [PurchaseDepartmentController::class, 'directPoList'])->name('direct-po-list');

Route::post('/citystore', [DashboardController::class, 'citystore'])->name('city.store');
Route::post('/firmstore', [DashboardController::class, 'firmstore'])->name('firm.store');
Route::post('/branchtore', [DashboardController::class, 'branchstore'])->name('branch.store');
Route::post('/unit-typestore', [DashboardController::class, 'unit_typestore'])->name('unit_type.store');
Route::post('/materialstore', [DashboardController::class, 'materialstore'])->name('material.store');
Route::post('/rawmaterialstore', [DashboardController::class, 'rawmaterialstore'])->name('rawmaterial.store');
Route::post('/brandstore', [DashboardController::class, 'brandstore'])->name('brand.store');
Route::post('/clientstore', [DashboardController::class, 'clientstore'])->name('client.store');
Route::post('/sitestore', [DashboardController::class, 'sitestore'])->name('sitepersonalorbuisness.store');
Route::get('/sitesindex/{id?}', [DashboardController::class, 'sitesindex'])->name('sites.index');
Route::post('/warehousestore', [DashboardController::class, 'warehousestore'])->name('warehousestore');
Route::post('/supervisorstore', [DashboardController::class, 'supervisorstore'])->name('supervisor.store');
Route::post('/vendorstore', [DashboardController::class, 'vendorstore'])->name('vendor.store');
Route::post('/employeestore', [DashboardController::class, 'employeestore'])->name('employee.store');
Route::post('/contractorstore', [DashboardController::class, 'contractorstore'])->name('contractor.store');


Route::post('/assign-site-store', [DashboardController::class, 'assignSiteStore'])->name('assign_site.store');


// routes/web.php




// User Roles
Route::get('panel-user-roles', [UserRolesController::class, 'panelUserRole'])->name('panel-user-roles');
Route::post('panel-user-role-store', [UserRolesController::class, 'panelUserRolestore'])->name('panel-user-role-store');
Route::get('panel-user', [UserRolesController::class, 'panelUser'])->name('panel-user');
Route::post('panel-user-store', [UserRolesController::class, 'panelUserStore'])->name('panelUser.store');


Route::get('app-user-roles', [UserRolesController::class, 'appUserRole'])->name('app-user-roles');
Route::post('app-user-store', [UserRolesController::class, 'appUserstore'])->name('app-user-store');


// Account Department
Route::get('expense-master', [AccountDepartmentController::class, 'expenseMaster'])->name('expence-master');
Route::post('expence_category_create', [AccountDepartmentController::class, 'expence_category_create'])->name('expence_category_create');
Route::get('edit_expence_category/{id}', [AccountDepartmentController::class, 'edit_expence_category'])->name('edit_expence_category');
Route::post('update_expence_category', [AccountDepartmentController::class, 'update_expence_category'])->name('update_expence_category');
Route::get('expence_category_delete/{id}', [AccountDepartmentController::class, 'expence_category_delete'])->name('expence_category_delete');

Route::post('expence_category_head', [AccountDepartmentController::class, 'expence_category_head'])->name('expence_category_head');
Route::get('edit_expence_head/{id}', [AccountDepartmentController::class, 'edit_expence_head'])->name('edit_expence_head');
Route::post('update_expence_head', [AccountDepartmentController::class, 'update_expence_head'])->name('update_expence_head');
Route::get('expence_head_delete/{id}', [AccountDepartmentController::class, 'expence_head_delete'])->name('expence_head_delete');

Route::get('income-billing', [AccountDepartmentController::class, 'incomeBilling']);
Route::get('expense-entry', [AccountDepartmentController::class, 'expenseEntry']);


