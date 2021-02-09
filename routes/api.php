<?php


use App\Models\provinsi;
use App\Models\rw;
use App\Models\kasus2;
use App\Models\kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProvinsiController;
use App\Http\Controllers\Api\ApiController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//API PROVINSI
Route::get('provinsi1',[ProvinsiController::class, 'index']);
Route::post('provinsi',[ProvinsiController::class, 'store']);
Route::get('provinsi/{id}',[ProvinsiController::class, 'show']);
Route::get('provinsi2/{id}',[ProvinsiController::class, 'provinsi']);
Route::delete('provinsi/{id}',[ProvinsiController::class, 'destroy']);

//API KASUS2
Route::get('kasus2/{id}',[ApiController::class, 'show']);
Route::get('hariini',[ApiController::class, 'hari']);
Route::get('indonesia',[ApiController::class, 'index']);
Route::get('indonesia/sprovinsi',[ApiController::class, 'sprovinsi']);
Route::get('indonesia/sprovinsi/kota',[ApiController::class, 'skota']);
Route::get('indonesia/sprovinsi/kota/kecamatan',[ApiController::class, 'skecamatan']);
Route::get('indonesia/sprovinsi/kota/kecamatan/kelurahan',[ApiController::class, 'skelurahan']);
Route::get('sprovinsi/{id}',[ApiController::class, 'dprovinsi']);

