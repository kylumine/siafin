<?php
use App\Http\Controllers\CustomerApiController;
use App\Http\Controllers\MovieApiController;
use App\Http\Controllers\RentApiController;
use App\Http\Controllers\RentDetailApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/customers/{customer}',[CustomerApiController::class, 'view']);
Route::patch('/customers/{customer}',[CustomerApiController::class, 'update']);
Route::put('/customers/{customer}',[CustomerApiController::class, 'update']);
Route::delete('/customers/{customer}',[CustomerApiController::class, 'destroy']);
Route::get('/customers',[CustomerApiController::class, 'index']);
Route::post('/customers',[CustomerApiController::class, 'store']);

Route::get('/movies/{movie}',[MovieApiController::class, 'view']);
Route::patch('/movies/{movie}',[MovieApiController::class, 'update']);
Route::put('/movies/{movie}',[MovieApiController::class, 'update']);
Route::delete('/movies/{movie}',[MovieApiController::class, 'destroy']);
Route::get('/movies',[MovieApiController::class, 'index']);
Route::post('/movies',[MovieApiController::class, 'store']);

Route::get('/rents/{rent}',[RentApiController::class, 'view']);
Route::patch('/rents/{rent}',[RentApiController::class, 'update']);
Route::put('/rents/{rent}',[RentApiController::class, 'update']);
Route::delete('/rents/{rent}',[RentApiController::class, 'destroy']);
Route::get('/rents',[RentApiController::class, 'index']);
Route::post('/rents',[RentApiController::class, 'store']);

Route::get('/rentdetails/{rentDetail}',[RentDetailApiController::class, 'view']);
Route::patch('/rentdetails/{rentDetail}',[RentDetailApiController::class, 'update']);
Route::put('/rentdetails/{rentDetail}',[RentDetailApiController::class, 'update']);
Route::delete('/rentdetails/{rentDetail}',[RentDetailApiController::class, 'destroy']);
Route::get('/rentdetails',[RentDetailApiController::class, 'index']);
Route::post('/rentdetails',[RentDetailApiController::class, 'store']);