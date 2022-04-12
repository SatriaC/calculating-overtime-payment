<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\SettingController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/settings/{id}', [SettingController::class, 'update'])->name('setting.update');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employee.store');
Route::get('/employees', [EmployeeController::class, 'index'])->name('employee.index');
Route::post('/overtimes', [OvertimeController::class, 'store'])->name('overtime.store');
Route::get('/overtimes', [OvertimeController::class, 'index'])->name('overtime.index');
Route::get('/overtime-pays/calculate', [EmployeeController::class, 'calculate'])->name('overtime.calculate');


