<?php

use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\FacilitiesController;
use App\Http\Controllers\Admin\EquipmentController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect']);

Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback']);

Route::get('/dashboard', [ReservationController::class, 'showReservationsInCalendar'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/setReservationAsViewed/{id}', [ReservationController::class, 'setReservationIdAsViewed'])
    ->middleware(['auth', 'verified'])
    ->name('setReservationIdAsViewed');

Route::get('/downloadQRCode/{id}', [ReservationController::class, 'downloadQRCode'])
    ->middleware(['auth', 'verified'])
    ->name('downloadQRCode');

Route::get('/viewReservation/{universityID}/{id}', [ReservationController::class, 'showReservationById'])
    ->middleware(['auth', 'verified'])
    ->name('email.showReservationById');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/edit-reservation-reschedule/{id}/{facilityID}', [ReservationController::class, 'updateReschedule'])->name('updateReschedule');
    Route::get('/scan-qrcode', [ReservationController::class, 'showQrcodeScanner'])
        ->middleware(['auth', 'verified'])
        ->name('scanner');
    Route::post('qrLogin', ['uses' => 'App\Http\Controllers\Admin\ReservationController@checkQrcode']);
});

Route::prefix('admin/')->middleware('auth', 'admin')->group(function () {
    Route::get('settings', [SettingsController::class, 'tableData'])->name('admin.settings');
    Route::post('/toggle-role-status/{roleId}', [SettingsController::class, 'toggleRoleStatus'])->name('toggle-role-status');
    Route::post('/toggle-campus-status/{campusId}', [SettingsController::class, 'toggleCampusStatus'])->name('toggle-campus-status');
    Route::post('/toggle-buildings-status/{buildingId}', [SettingsController::class, 'toggleBuildingStatus'])->name('toggle-building-status');
    Route::patch('/edit-building-data/{buildingId}', [SettingsController::class, 'editBuildingData'])->name('edit-building-data');

    Route::post('/toggle-user-status/{userId}', [SettingsController::class, 'toggleUserStatus'])->name('toggle-user-status');
    Route::patch('/edit-user-data/{userId}', [SettingsController::class, 'editUserData'])->name('edit-user-data');
    Route::post('/toggle-org-status/{orgId}', [SettingsController::class, 'toggleOrgStatus'])->name('toggle-org-status');
    Route::patch('/edit-org-data/{orgId}', [SettingsController::class, 'editOrgData'])->name('edit-org-data');

    Route::get('/show-facilities', [FacilitiesController::class, 'facilities'])->name('facilities');
    Route::post('/addFacility', [FacilitiesController::class, 'addFacility'])->name('addFacility');
    Route::post('/toggle-facilities-status/{facilityId}', [FacilitiesController::class, 'toggleFacilityStatus'])->name('toggle-facility-status');
    Route::patch('/edit-facility-data/{facilityId}', [FacilitiesController::class, 'editFacilityData'])->name('edit-facility-data');

    Route::get('/show-equipments', [EquipmentController::class, 'equipment'])->name('equipment');
    Route::post('admin/addEquipment', [EquipmentController::class, 'addEquipment'])->name('addEquipment');
    Route::post('/toggle-equipment-status/{equipmentId}', [EquipmentController::class, 'toggleEquipmentStatus'])->name('toggle-equipment-status');
    Route::patch('/edit-equipment-data/{equipmentId}', [EquipmentController::class, 'editEquipmentData'])->name('edit-equipment-data');

    Route::get('/reservation/{universityID}', [ReservationController::class, 'showReservations'])->name('showReservations');
    Route::get('/reservation-form/{universityID}/{id}', [ReservationController::class, 'reservationForm'])->name('reservationForm');
    Route::post('/create-reservation/{id}', [ReservationController::class, 'createReservation'])->name('createReservation');
    Route::get('/viewReservation/{universityID}/{id}', [ReservationController::class, 'showReservationById'])->name('showReservationById');
    Route::patch('/reservation/update-status/{id}/{status}', [ReservationController::class, 'updateReservationStatus'])->name('updateReservationStatus');
    Route::get('/update-reservation-form/{universityID}/{id}', [ReservationController::class, 'updateReservation'])->name('updateReservation');
    Route::post('/edit-reservation-pending/{id}', [ReservationController::class, 'updateReservationDetailsPending'])->name('updateReservationDetailsPending');
    Route::get('/edit-reservation-form-reschedule/{universityID}/{id}/{facilityId}', [ReservationController::class, 'updateReservationFormReschedule'])->name('updateReservationFormReschedule');

    Route::get('/generate-reports', [ReportsController::class, 'report'])->name('report');
    Route::post('/generate-reports/results', [ReportsController::class, 'result'])->name('result');
});

Route::prefix('facility-incharge/')->name('fic.')->middleware('auth', 'fic')->group(function () {
    Route::get('/show-facilities', [FacilitiesController::class, 'facilities'])->name('facilities');
    Route::post('/addFacility', [FacilitiesController::class, 'addFacility'])->name('addFacility');
    Route::post('/toggle-facilities-status/{facilityId}', [FacilitiesController::class, 'toggleFacilityStatus'])->name('toggle-facility-status');
    Route::patch('/edit-facility-data/{facilityId}', [FacilitiesController::class, 'editFacilityData'])->name('edit-facility-data');

    Route::get('/show-equipments', [EquipmentController::class, 'equipment'])->name('equipment');
    Route::post('admin/addEquipment', [EquipmentController::class, 'addEquipment'])->name('addEquipment');
    Route::post('/toggle-equipment-status/{equipmentId}', [EquipmentController::class, 'toggleEquipmentStatus'])->name('toggle-equipment-status');
    Route::patch('/edit-equipment-data/{equipmentId}', [EquipmentController::class, 'editEquipmentData'])->name('edit-equipment-data');

    Route::get('/reservation/{universityID}', [ReservationController::class, 'showReservations'])->name('showReservations');
    Route::get('/reservation-form/{universityID}/{id}', [ReservationController::class, 'reservationForm'])->name('reservationForm');
    Route::post('/create-reservation/{id}', [ReservationController::class, 'createReservation'])->name('createReservation');
    Route::get('/viewReservation/{universityID}/{id}', [ReservationController::class, 'showReservationById'])->name('showReservationById');
    Route::patch('/reservation/update-status/{id}/{status}', [ReservationController::class, 'updateReservationStatus'])->name('updateReservationStatus');
    Route::get('/update-reservation-form/{universityID}/{id}', [ReservationController::class, 'updateReservation'])->name('updateReservation');
    Route::post('/edit-reservation-pending/{id}', [ReservationController::class, 'updateReservationDetailsPending'])->name('updateReservationDetailsPending');
    Route::get('/edit-reservation-form-reschedule/{universityID}/{id}/{facilityId}', [ReservationController::class, 'updateReservationFormReschedule'])->name('updateReservationFormReschedule');


    Route::get('/generate-reports', [ReportsController::class, 'report'])->name('report');
    Route::post('/generate-reports/results', [ReportsController::class, 'result'])->name('result');

    Route::get('/scan-qrcode', [ReservationController::class, 'showQrcodeScanner'])
        ->middleware(['auth', 'verified'])
        ->name('scanner');
    Route::post('qrLogin', ['uses' => 'App\Http\Controllers\Admin\ReservationController@checkQrcode']);
});

Route::prefix('user/')->name('user.')->middleware('auth', 'users')->group(function () {

    Route::get('/show-facilities', [FacilitiesController::class, 'facilities'])->name('facilities');

    Route::get('/reservation/{universityID}', [ReservationController::class, 'showReservations'])->name('showReservations');
    Route::get('/reservation-form/{universityID}/{id}', [ReservationController::class, 'reservationForm'])->name('reservationForm');
    Route::post('/create-reservation/{id}', [ReservationController::class, 'createReservation'])->name('createReservation');
    Route::get('/viewReservation/{universityID}/{id}', [ReservationController::class, 'showReservationById'])->name('showReservationById');
    Route::patch('/reservation/update-status/{id}/{status}', [ReservationController::class, 'updateReservationStatus'])->name('updateReservationStatus');
    Route::get('/update-reservation-form/{universityID}/{id}', [ReservationController::class, 'updateReservation'])->name('updateReservation');
    Route::post('/edit-reservation-pending/{id}', [ReservationController::class, 'updateReservationDetailsPending'])->name('updateReservationDetailsPending');
    Route::post('/edit-reservation-pencilbook/{id}', [ReservationController::class, 'updateReservationDetailsPencilBook'])->name('updateReservationDetailsPencilBook');
});


require __DIR__ . '/auth.php';
