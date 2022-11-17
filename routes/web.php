<?php

use App\Exports\entryDataTargetExport;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\entryTransHarianController;
use App\Http\Controllers\masterDataTargetController;
use App\Http\Controllers\rekeningController;
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

// Dashboard
Route::get('/', [dashboardController::class, 'index']);
// Daftar Rekening
Route::get('/rekening', [rekeningController::class, 'index']);
Route::post('/list_rekening', [rekeningController::class, 'list_rekening']);
Route::post('/add_rekening', [rekeningController::class, 'add_rekening']);
Route::post('/edit_rekening', [rekeningController::class, 'edit_rekening']);
Route::post('/delete_rekening', [rekeningController::class, 'delete_rekening']);
// Master Data Target
Route::get('/data_target', [masterDataTargetController::class, 'index']);
Route::post('/list_master_data_target', [masterDataTargetController::class, 'list_data']);
Route::get('/form_add_master_data_target', [masterDataTargetController::class, 'form_add_data']);
Route::post('/add_master_data_target', [masterDataTargetController::class, 'add_data']);
Route::post('/delete_master_data_target', [masterDataTargetController::class, 'delete_data']);
Route::get('/form_edit_master_data_target/{id}', [masterDataTargetController::class, 'form_edit_data']);
Route::post('/edit_master_data_target', [masterDataTargetController::class, 'edit_data']);
Route::post('/excell_master_data_target', [masterDataTargetController::class, 'excell_data']);
Route::post('/pdf_master_data_target', [masterDataTargetController::class, 'downloadPDF']);

// Entry Transaksi Harian
Route::get('/trans_harian', [entryTransHarianController::class, 'index']);
Route::post('/list_entry_trans_harian', [entryTransHarianController::class, 'list_data']);
Route::post('/delete_entry_trans_harian', [entryTransHarianController::class, 'delete_data']);
Route::post('/excell_entry_trans_harian', [entryTransHarianController::class, 'excell_data']);
Route::get('/form_entry', [entryTransHarianController::class, 'form_data']);
