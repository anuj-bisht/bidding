<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Consumer and provider Category

Route::get('category', [App\Http\Controllers\v1\Consumer\CategoryController::class, 'index'])->withoutMiddleware('api');

Route::get('privacy',[App\Http\Controllers\v1\Consumer\UserController::class,'privacy']);
Route::get('terms_condition',[App\Http\Controllers\v1\Consumer\UserController::class,'terms_condition']);
Route::get('faq',[App\Http\Controllers\v1\Consumer\UserController::class,'faq']);

Route::post('consumerRegister',[App\Http\Controllers\v1\Consumer\UserController::class, 'ConsumerRegister']);


Route::post('providerRegister',[App\Http\Controllers\v1\Provider\UserController::class, 'ProviderRegister']);
Route::post('getVehicle',[App\Http\Controllers\v1\Consumer\VehicleController::class, 'getVehicle']);


Route::post('sendotp',[App\Http\Controllers\v1\Consumer\UserController::class, 'sendotp']);
Route::post('sendOtp',[App\Http\Controllers\v1\Consumer\UserController::class, 'consumerOtp']);

Route::post('login',[App\Http\Controllers\v1\Consumer\UserController::class, 'authenticate']);
Route::post('consumerLogin', [App\Http\Controllers\v1\Consumer\UserController::class, 'ConsumerLogin']);
Route::group(['middleware' => ['jwt.verify']], function() {
Route::post('editConsumerProfile',[App\Http\Controllers\v1\Consumer\UserController::class, 'editConsumerProfile']);
Route::post('consumerLogout', [App\Http\Controllers\v1\Consumer\UserController::class, 'ConsumerLogout']);
Route::post('support', [App\Http\Controllers\v1\Consumer\UserController::class, 'support']);
Route::post('deleteAccount',[App\Http\Controllers\v1\Consumer\UserController::class, 'deleteConsumerAccount']);


Route::get('consumerBids', [App\Http\Controllers\v1\Consumer\UserbidController::class, 'index']);
Route::post('createTransportConsignment', [App\Http\Controllers\v1\Consumer\UserbidController::class, 'createTransportConsignment']);
Route::post('createTourConsignment', [App\Http\Controllers\v1\Consumer\UserbidController::class, 'createTourConsignment']);
Route::post('createPackageConsignment', [App\Http\Controllers\v1\Consumer\UserbidController::class, 'createPackageConsignment']);
Route::post('bidderList', [App\Http\Controllers\v1\Consumer\BidderListController::class, 'bidderList']);
Route::post('acceptBidder', [App\Http\Controllers\v1\Consumer\BidderListController::class, 'acceptBidder']);
Route::post('rejectBidder', [App\Http\Controllers\v1\Consumer\BidderListController::class, 'rejectBidder']);
Route::post('completeBid', [App\Http\Controllers\v1\Provider\OngoingConsignmentController::class, 'completeBid']);


//ongoing Consignment
Route::post('consumerOngoinConsignment', [App\Http\Controllers\v1\Consumer\OngoingConsignmentController::class, 'newconsumerOngoinConsignment']);
Route::post('providerOngoingConsignment', [App\Http\Controllers\v1\Provider\OngoingConsignmentController::class, 'providerOngoingConsignment']);
Route::post('viewOngoing', [App\Http\Controllers\v1\Consumer\OngoingConsignmentController::class, 'viewOngoing']);

//provider payment
Route::post('generateOrder', [App\Http\Controllers\v1\Provider\OrderController::class, 'generateOrder']);
Route::post('verifyPayment', [App\Http\Controllers\v1\Provider\OrderController::class, 'verifyPayment']);
//provider payment
Route::post('consumerGenerateOrder', [App\Http\Controllers\v1\Consumer\OrderController::class, 'generateOrderr']);
Route::post('consumerVerifyPayment', [App\Http\Controllers\v1\Consumer\OrderController::class, 'verifyPaymentt']);

Route::post('updateBid', [App\Http\Controllers\v1\Consumer\UserbidController::class, 'update']);
Route::post('deleteBid', [App\Http\Controllers\v1\Consumer\UserbidController::class, 'delete']);
Route::post('ProviderAction',[App\Http\Controllers\v1\Consumer\UserbidController::class, 'ProviderAction']);
Route::get('truckPreference', [App\Http\Controllers\v1\Consumer\TruckPreferenceController::class, 'TruckPreference']);
//consignment history
Route::post('consignmentHistory',[App\Http\Controllers\v1\Consumer\ConsignmentHistoryController::class, 'consignmentHistory']);

//Estimate Price
Route::post('estimatePrice',[App\Http\Controllers\v1\Consumer\EstimatePriceController::class, 'estimatePrice']);
//Consumer Notification
Route::post('getAllNotification',[App\Http\Controllers\v1\Consumer\NotificationController::class, 'getAllNotification']);
Route::post('unreadNotification',[App\Http\Controllers\v1\Consumer\NotificationController::class, 'unreadNotification']);



//Provider Category
Route::post('providerCategory', [App\Http\Controllers\v1\Provider\CategoryController::class, 'providerCategory']);
Route::post('walletHistory', [App\Http\Controllers\v1\Provider\CategoryController::class, 'walletHistory']);
Route::post('walletPoint', [App\Http\Controllers\v1\Provider\CategoryController::class, 'walletPoint']);


Route::post('consignmentList',[App\Http\Controllers\v1\Provider\GetConsumerBidController::class, 'consignmentList']);
//view userConsignment
Route::post('viewConsignment',[App\Http\Controllers\v1\Provider\GetConsumerBidController::class, 'viewConsignment']);

Route::post('providerApplyOnBid',[App\Http\Controllers\v1\Provider\ApplyBidController::class, 'providerApplyOnBid']);
Route::post('getAllBid',[App\Http\Controllers\v1\Provider\GetAllBidController::class, 'getAllBid']);
Route::post('editBid',[App\Http\Controllers\v1\Provider\ApplyBidController::class, 'editBid']);
Route::post('updateBid',[App\Http\Controllers\v1\Provider\GetAllBidController::class, 'updateBid']);
Route::post('bidList', [App\Http\Controllers\v1\Provider\GetAllBidController::class, 'bidList']);

//plan
Route::post('getAllPlan',[App\Http\Controllers\v1\Provider\PlanController::class, 'getAllPlan']);

//distance
Route::post('editDocuments',[App\Http\Controllers\v1\Provider\UserController::class, 'editDocuments']);
Route::post('editProviderProfile',[App\Http\Controllers\v1\Provider\UserController::class, 'editProviderProfile']);
Route::post('getMyProfile',[App\Http\Controllers\v1\Provider\UserController::class, 'getMyProfile']);
Route::post('deleteAccount',[App\Http\Controllers\v1\Provider\UserController::class, 'deleteProviderAccount']);







});
Route::post('findDistance',[App\Http\Controllers\v1\Consumer\UserController::class, 'findDistance']);
Route::get('splashScreen',[App\Http\Controllers\v1\Consumer\UserController::class, 'splashScreen']);

// Route::post('loginSocial', 'UserController@loginSocial');
// Route::post('loginNormal', 'UserController@loginNormal');


////Payment----

// Route::post('/orders/generateOrder', 'OrderController@generateOrder');
// Route::post('/orders/verifyPayment', 'OrderController@verifyPayment');
Route::get('flatType',[App\Http\Controllers\v1\Provider\ApplyBidController::class, 'flatType']);


