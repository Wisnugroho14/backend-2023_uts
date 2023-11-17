<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeesController;
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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/employees', [EmployeesController::class, 'index']);
    Route::get('/employees/{id}', [EmployeesController::class, 'show']);
    Route::post('/employees', [EmployeesController::class, 'store']);
    Route::put('/employees/{id}', [EmployeesController::class, 'update']);
    Route::delete('/employees/{id}', [EmployeesController::class, 'destroy']);
    Route::get('/employees/search/{nama}', [EmployeesController::class, 'search']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
