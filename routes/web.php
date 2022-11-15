<?php

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

Route::get('/', [masterDataTargetController::class, 'index']);
Route::post('/list_master_data_target', [masterDataTargetController::class, 'list_data']);
