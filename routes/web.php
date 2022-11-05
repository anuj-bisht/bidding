<?php
use App\Exports\UsersExport;
use App\Exports\ProvidersExport;
use App\Exports\PackageExport;
use App\Exports\TourExport;
use App\Exports\TransportExport;
use App\Exports\VehicleExport;
use App\Exports\CtrasactionExport;
use App\Exports\PtrasactionExport;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/privacy-policy', [App\Http\Controllers\Controller::class, 'privacyPol']);

Route::get('/', function () {
    return view('welcome');
});


Route::get('/sellerRegister', [App\Http\Controllers\Seller\UserRegister::class, 'SellerRegister'])->name('SellerReg');
Route::post('/sellerRegister', [App\Http\Controllers\Seller\UserRegister::class, 'UserRegister'])->name('seller.register');
Route::get('bidderLoginform',[App\Http\Controllers\Seller\UserRegister::class, 'UserLoginForm']);
Route::post('userlogin',[App\Http\Controllers\Seller\UserRegister::class, 'UserLogin'])->name('user.login');
Route::group(['middleware'=>['auth']], function(){
Route::get('/userdashboard',[App\Http\Controllers\Seller\UserRegister::class, 'UserDashboard']);
Route::get('/createbid',[App\Http\Controllers\User\UserBid::class, 'CreateBid'])->name('create.bid');
Route::post('/submitbid',[App\Http\Controllers\User\UserBid::class, 'SubmitBid'])->name('submit.bid');
});
//Admin
Auth::routes();

Route::group(['middleware'=>[ 'auth']], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::view('/admindashboard', 'admin/dashboard');

    Route::get('/roles', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('Roles');
    Route::get('/createRole', [App\Http\Controllers\Admin\RoleController::class, 'create'])->name('create.role');
    Route::post('/storeRole', [App\Http\Controllers\Admin\RoleController::class, 'store'])->name('role.store');
    Route::get('/edit/role/{id}', [App\Http\Controllers\Admin\RoleController::class, 'edit']);
    Route::post('/update/role/{id}', [App\Http\Controllers\Admin\RoleController::class, 'update']);
    Route::post('/roles/{role}/permission', [App\Http\Controllers\Admin\RoleController::class, 'givePermission'])->name('admin.roles.permissions');
    Route::post('/admin/roles/{role}/{permission}', [App\Http\Controllers\Admin\RoleController::class, 'revokePermission']);




    Route::get('/permission', [App\Http\Controllers\Admin\PermissionController::class, 'index'])->name('Permission');
    Route::get('/createPermission', [App\Http\Controllers\Admin\PermissionController::class, 'create'])->name('create.permission');
    Route::post('/storePermission', [App\Http\Controllers\Admin\PermissionController::class, 'store'])->name('permission.store');
    Route::get('/edit/permission/{id}', [App\Http\Controllers\Admin\PermissionController::class, 'edit']);
    Route::post('/update/permission/{id}', [App\Http\Controllers\Admin\PermissionController::class, 'update']);
    Route::post('/permissions/{permission}/role', [App\Http\Controllers\Admin\PermissionController::class, 'giveRole'])->name('admin.permissions.roles');
    Route::post('/admin/permissions/{permission}/{role}', [App\Http\Controllers\Admin\PermissionController::class, 'revokeRole']);



    Route::get('/user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('Users');
    Route::get('/userbid/{id}', [App\Http\Controllers\Admin\UserController::class, 'UserBid']);
    Route::get('/viewdetail/{id}', [App\Http\Controllers\Admin\UserController::class, 'viewDetail']);
    Route::get('/notification', [App\Http\Controllers\Admin\UserController::class, 'notification'])->name('Notification');
    Route::post('sendNotifications', [App\Http\Controllers\Admin\UserController::class,'sendNotificationUser'])->name('sendNotificationUser');
    Route::get('bidderlist/{consignment_id}', [App\Http\Controllers\Admin\UserController::class,'bidderList'])->name('bidderList');
    Route::get('particularusertourconsignment/{id}', [App\Http\Controllers\Admin\UserController::class,'particularUserConsignment']);
    Route::get('particularuserpackageconsignment/{id}', [App\Http\Controllers\Admin\UserController::class,'particularPackageConsignment']);
    Route::get('particularusertransportconsignment/{id}', [App\Http\Controllers\Admin\UserController::class,'particularTransportConsignment']);

    Route::get('/providers', [App\Http\Controllers\Admin\ProviderController::class, 'index'])->name('Providers');
    Route::get('/toggleProviderStatus/{id}', [App\Http\Controllers\Admin\ProviderController::class, 'toggleProviderStatus'])->name('toggleProviderStatus');
    Route::get('/verifyProviderDocument/{id}/{type}', [App\Http\Controllers\Admin\ProviderController::class, 'verifyDocument'])->name('verifyDocument');
    Route::get('/viewproviderdetail/{id}', [App\Http\Controllers\Admin\ProviderController::class, 'viewDetail']);
    Route::get('/addCoins/{id}', [App\Http\Controllers\Admin\ProviderController::class, 'addCoinForm']);
    Route::post('/submitcoin', [App\Http\Controllers\Admin\ProviderController::class, 'submitCoin']);
    Route::get('/allbids/{id}', [App\Http\Controllers\Admin\ProviderController::class, 'allBids']);
    Route::get('/viewconsignment/{bid_id}', [App\Http\Controllers\Admin\ProviderController::class, 'viewConsignment']);
//Consumer Consignment
Route::get('/consumerConsignment', [App\Http\Controllers\Admin\ConsumerConsignmentController::class, 'index']);


//Provider CXonsignment
Route::get('/providerConsignment', [App\Http\Controllers\Admin\ProviderConsignmentController::class, 'index']);
//Admin Category
Route::get('/test', [App\Http\Controllers\Admin\CategoryController::class, 'test']);

Route::get('/categories', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('show.categories');
Route::get('/addcategories', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('add.categories');
Route::post('/submitcategories', [App\Http\Controllers\Admin\CategoryController::class, 'submitCategory'])->name('submit.categories');
Route::get('/editcategories/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'editCategory']);
Route::post('/updatecategories', [App\Http\Controllers\Admin\CategoryController::class, 'updateCategory'])->name('update.categories');
Route::get('/categoryStatus/{category}/{status}', [App\Http\Controllers\Admin\CategoryController::class, 'changeStatus']);

//Admin CMS
Route::get('/cms', [App\Http\Controllers\Admin\ContentManagement::class, 'index'])->name('show.cms');
Route::get('/createCms', [App\Http\Controllers\Admin\ContentManagement::class, 'create'])->name('create.cms');
Route::post('/submitCms', [App\Http\Controllers\Admin\ContentManagement::class, 'submit'])->name('submit.cms');
Route::get('/editcms/{id}', [App\Http\Controllers\Admin\ContentManagement::class, 'editCms']);
Route::post('/submitcms', [App\Http\Controllers\Admin\ContentManagement::class, 'updateCms'])->name('update.cms');

//Admin Vehicles
Route::get('/vehicles', [App\Http\Controllers\Admin\VehicleController::class, 'index'])->name('show.vehicles');
Route::get('/createvehicle', [App\Http\Controllers\Admin\VehicleController::class, 'create'])->name('create.vehicle');
Route::post('/submitvehicle', [App\Http\Controllers\Admin\VehicleController::class, 'submit'])->name('submit.vehicle');
Route::get('/editvehicle/{id}', [App\Http\Controllers\Admin\VehicleController::class, 'edit']);
Route::get('/deletevehicle/{id}', [App\Http\Controllers\Admin\VehicleController::class, 'delete']);
Route::post('/updatevehicle', [App\Http\Controllers\Admin\VehicleController::class, 'update'])->name('update.vehicle');

Route::get('/vehiclesize', [App\Http\Controllers\Admin\SizeController::class, 'index'])->name('show.size');
Route::get('/createvehiclesize', [App\Http\Controllers\Admin\SizeController::class, 'create'])->name('create.vehiclesize');
Route::post('/submitvehiclesize', [App\Http\Controllers\Admin\SizeController::class, 'submit'])->name('submit.vehiclesize');
Route::get('/editvehiclesize/{id}', [App\Http\Controllers\Admin\SizeController::class, 'edit']);
Route::get('/deletevehiclesize/{id}', [App\Http\Controllers\Admin\SizeController::class, 'delete']);

Route::post('/updatevehiclesize', [App\Http\Controllers\Admin\SizeController::class, 'update'])->name('update.vehiclesize');

Route::get('/allflat', [App\Http\Controllers\Admin\FlatController::class, 'index'])->name('show.flat');
Route::get('/deleteFlat/{id}', [App\Http\Controllers\Admin\FlatController::class, 'delete']);
Route::get('/addFlat', [App\Http\Controllers\Admin\FlatController::class, 'create'])->name('create.flat');
Route::post('/submitflattype', [App\Http\Controllers\Admin\FlatController::class, 'submit'])->name('submit.flat');

 //Admin Plans
 Route::get('/allPlans', [App\Http\Controllers\Admin\PlanController::class, 'index']);
 Route::view('/createPlan', 'admin/plan/create')->name('create.plan');
 Route::post('/submitPlan', [App\Http\Controllers\Admin\PlanController::class, 'submit']);
 Route::get('/planStatus/{plan_id}/{status}', [App\Http\Controllers\Admin\PlanController::class, 'changeStatus']);
 Route::get('/editplan/{id}', [App\Http\Controllers\Admin\PlanController::class, 'editPlan']);
 Route::post('/submitplan', [App\Http\Controllers\Admin\PlanController::class, 'updatePlan'])->name('update.plan');
 Route::get('/deleteplan/{id}', [App\Http\Controllers\Admin\PlanController::class, 'deletePlan']);

 //Trasaction Management
 Route::get('/ctransaction', [App\Http\Controllers\Admin\TransactionController::class, 'consumerTransaction']);
 Route::get('/ptransaction', [App\Http\Controllers\Admin\TransactionController::class, 'providerTransaction']);


 //support
 Route::get('/support', [App\Http\Controllers\Admin\QueryController::class, 'index']);

Route::get('/providerExport', function () {
    return Excel::download(new UsersExport,"Provider"." ".Carbon::now().".xlsx");
});

Route::get('/userExport', function () {
    return Excel::download(new ProvidersExport,"User"." ".Carbon::now().".xlsx");
});

Route::get('/tourExport', function () {
    return Excel::download(new TourExport,"TourConsignment"." ".Carbon::now().".xlsx");
});
Route::get('/transportExport', function () {
    return Excel::download(new TransportExport,"TransportConsignment"." ".Carbon::now().".xlsx");
});
Route::get('/consumerTrsactionExport', function () {
    return Excel::download(new CtrasactionExport," ".Carbon::now().".xlsx");
});
Route::get('/providerTrsactionExport', function () {
    return Excel::download(new PtrasactionExport," ".Carbon::now().".xlsx");
});
Route::get('/packageExport', function () {
    return Excel::download(new PackageExport,"PackageConsignment"." ".Carbon::now().".xlsx");
});
Route::get('/vehicleExport', function () {
    return Excel::download(new VehicleExport,"Vehicles"." ".Carbon::now().".xlsx");
});


   });


//



Route::get('/hom', [App\Http\Controllers\HomeController::class, 'index'])->name('hom');


