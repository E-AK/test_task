<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;

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

Route::post('/create', [AssetController::class, 'create']);
Route::get('/', [AssetController::class, 'get_all']);
Route::put('/update/{id}', [AssetController::class, 'update']);
Route::delete('/{id}', [AssetController::class, 'delete']);
