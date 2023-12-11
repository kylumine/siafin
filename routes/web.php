<?php
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\RentDetailController;
use Illuminate\Support\Facades\Route;

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
    return view('base');
});
// Route::get('/customer', function () {
//     return view('customer');
// });
Route::get('/home', function () {
    return view('base');
});

Route::get('/customer', [CustomerController::class,'view'])->name('customer');
Route::get('/customer/create', [CustomerController::class,'create']);
Route::post('/customer/create', [CustomerController::class,'store']);
Route::get('/customer/{customer}', [CustomerController::class,'edit']);
Route::post('/customer/{customer}', [CustomerController::class,'update']);
Route::get('delete/customer/{id}', [CustomerController::class,'destroy']);
Route::delete('customer/delete/{customer}', [CustomerController::class, 'delete']);

Route::get('/movie', [MovieController::class,'view'])->name('movie');
Route::get('/movie/create', [MovieController::class,'create']);
Route::post('/movie/create', [MovieController::class,'store']);
Route::get('/movie/{movie}', [MovieController::class,'edit']);
Route::post('/movie/{movie}', [MovieController::class,'update']);
Route::get('delete/movie/{id}', [MovieController::class,'destroy']);
Route::delete('movie/delete/{movie}', [MovieController::class, 'delete']);

Route::get('/rent', [RentController::class,'view'])->name('rent');
Route::get('/rent/create', [RentController::class,'create']);
Route::post('/rent/create', [RentController::class,'store']);
Route::get('/rent/{rent}', [RentController::class,'edit']);
Route::post('/rent/{rent}', [RentController::class,'update']);
Route::delete('rent/delete/{rent}', [RentController::class, 'delete']);

Route::get('/rentdetail', [RentDetailController::class,'view']);
Route::get('/rentdetail/create', [RentDetailController::class,'create']);
Route::post('/rentdetail/create', [RentDetailController::class,'store']);
Route::get('/rentdetail/{rentdetail}', [RentDetailController::class,'edit']);
Route::post('/rentdetail/{rentdetail}', [RentDetailController::class,'update']);
Route::delete('rentdetail/delete/{rentdetail}', [RentDetailController::class, 'delete']);
