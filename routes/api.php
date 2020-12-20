<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\LoginController;
use App\Models\DokterModel;
use Illuminate\Auth\Events\Login;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('login/{username}/{password}', [LoginController::class, 'login']);

Route::get('user', [UserController::class, 'get_all_user']);
Route::get('user/{id}', [UserController::class, 'getUserById']);
Route::get('user/{id}/riwayat', [UserController::class, 'getUserBookingHistory']);

Route::post('user/tambah', [UserController::class, 'insert_user']);
Route::put('user/update/{id}', [UserController::class, 'update_user']);
// Route::patch('user/update/{id}', [UserController::class, 'update_user']);
Route::delete('user/delete/{id}', [UserController::class, 'delete_user']);

Route::get('booking', [BookingController::class, 'get_all_booking']);
Route::get('booking/{id}', [BookingController::class, 'getBookingById']);
Route::post('booking/tambah', [BookingController::class, 'insert_booking']);
Route::put('booking/update/{id}', [BookingController::class, 'update_booking']);
// Route::patch('booking/update/{id}', [BookingController::class, 'update_booking']);
Route::delete('booking/delete/{id}', [BookingController::class, 'delete_booking']);

Route::get('cari/{key}', [DokterController::class, 'getDokterByKey']);

Route::get('dokter', [DokterController::class, 'get_all_dokter']);
Route::get('dokter/{id}', [DokterController::class, 'getDokterById']);
Route::post('dokter/tambah', [DokterController::class, 'insert_dokter']);
Route::put('dokter/update/{id}', [DokterController::class, 'update_dokter']);
// Route::patch('dokter/update/{id}', [DokterController::class, 'update_dokter']);
Route::delete('dokter/delete/{id}', [DokterController::class, 'delete_dokter']);



// Route::apiResource('booking', 'BookingController');