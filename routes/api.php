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
    //route employees method get (Get all resource)
    Route::get('/employees', [EmployeesController::class, 'index']);
    //route employees method get (Get detail resource)
    Route::get('/employees/{id}', [EmployeesController::class, 'show']);
    //route employees method post (Add resource)
    Route::post('/employees', [EmployeesController::class, 'store']);
    //route employees method put (Edit resource)
    Route::put('/employees/{id}', [EmployeesController::class, 'update']);
    //route employees method delete (Delete resource)
    Route::delete('/employees/{id}', [EmployeesController::class, 'destroy']);
    //route employees method get (search resource by name)
    Route::get('/employees/search/{nama}', [EmployeesController::class, 'search']);
    //route employees method get (get active resource)
    Route::get('/employees/status/active', [EmployeesController::class, 'active']);
    //route employees method get (get inactive resource)
    Route::get('/employees/status/inactive', [EmployeesController::class, 'inactive']);
    //route employees method get (Get terminated resource)
    Route::get('/employees/status/terminated', [EmployeesController::class, 'terminated']);
});
//route auth method
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
