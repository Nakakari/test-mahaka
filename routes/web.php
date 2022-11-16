<?php

use App\Http\Controllers\entryTransHarianController;
use App\Http\Controllers\masterDataTargetController;
use Illuminate\Support\Facades\Route;

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

// Master Data Target
Route::get('/', [masterDataTargetController::class, 'index']);
Route::post('/list_master_data_target', [masterDataTargetController::class, 'list_data']);
Route::post('/add_master_data_target', [masterDataTargetController::class, 'add_data']);
Route::post('/delete_master_data_target', [masterDataTargetController::class, 'delete_data']);
Route::post('/edit_master_data_target', [masterDataTargetController::class, 'edit_data']);
Route::post('/excell_master_data_target', [masterDataTargetController::class, 'excell_data']);

// Entry Transaksi Harian
Route::get('/trans_harian', [entryTransHarianController::class, 'index']);
