<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\FacilitiesController;
use App\Http\Controllers\Admin\ReservationController;



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

Route::post('/getColleges', [RegisteredUserController::class, 'getCollegesByID']);

Route::post('/getDepartments', [RegisteredUserController::class, 'getDepartmentsByID']);

Route::post('/getOffices', [RegisteredUserController::class, 'getOfficesByID']);

Route::post('/getPositions', [RegisteredUserController::class, 'getPositionsByID']);

Route::post('/getBuildings', [FacilitiesController::class, 'getBuildingByNumber']);

Route::post('/getFloors', [FacilitiesController::class, 'getFloorsEachBuilding']);
