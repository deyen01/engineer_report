<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserController;

Route::permanentRedirect('/', '/reports')->middleware(['auth', 'euie']);
Route::permanentRedirect('/home', '/reports')->middleware(['auth', 'euie']);
Auth::routes();

Route::any('/register',
function () {
    return response(null, 403);
});

Route::prefix('reports')->middleware(['auth', 'euie'])->group(function (){
    Route::get('/', [ReportController::class, 'list'])->name('reports');
    Route::get('/xlsx', [ReportController::class, 'xlsx'])->name('reportsxlsx');
    Route::get('/check/{id}', [ReportController::class, 'check'])->where('id', '[0-9]+')->name('checkreport');
    Route::post('/savecheck/{id}', [ReportController::class, 'savecheck'])->where('id', '[0-9]+')->name('savecheckreport');
    Route::get('/edit/{id?}', [ReportController::class, 'edit'])->where('id', '[0-9]+')->name('editreport');
    Route::post('/store/{id?}', [ReportController::class, 'store'])->where('id', '[0-9]+')->name('savereport');
    Route::post('/delete/{id}', [ReportController::class, 'delete'])->where('id', '[0-9]+')->name('deletereport');
});

Route::prefix('clients')->middleware(['auth', 'euie'])->group(function (){
    Route::get('/', [ClientController::class, 'list'])->name('clients');
    Route::get('/xlsx', [ClientController::class, 'xlsx'])->name('clientsxlsx');
    Route::get('/edit/{id?}', [ClientController::class, 'edit'])->where('id', '[0-9]+')->name('editclient');
    Route::post('/store/{id?}', [ClientController::class, 'store'])->where('id', '[0-9]+')->name('saveclient');
    Route::post('/delete/{id}', [ClientController::class, 'delete'])->where('id', '[0-9]+')->name('deleteclient');
});

Route::prefix('locations')->middleware(['auth', 'euie'])->group(function (){
    Route::get('/', [LocationController::class, 'list'])->name('locations');
    Route::get('/xlsx', [LocationController::class, 'xlsx'])->name('locationsxlsx');
    Route::get('/edit/{id?}', [LocationController::class, 'edit'])->where('id', '[0-9]+')->name('editlocation');
    Route::post('/store/{id?}', [LocationController::class, 'store'])->where('id', '[0-9]+')->name('savelocation');
    Route::post('/delete/{id}', [LocationController::class, 'delete'])->where('id', '[0-9]+')->name('deletelocation');
});

Route::prefix('devices')->middleware(['auth', 'euie'])->group(function (){
    Route::get('/', [DeviceController::class, 'list'])->name('devices');
    Route::get('/xlsx', [DeviceController::class, 'xlsx'])->name('devicesxlsx');
    Route::get('/edit/{id?}', [DeviceController::class, 'edit'])->where('id', '[0-9]+')->name('editdevice');
    Route::post('/store/{id?}', [DeviceController::class, 'store'])->where('id', '[0-9]+')->name('savedevice');
    Route::post('/delete/{id}', [DeviceController::class, 'delete'])->where('id', '[0-9]+')->name('deletedevice');
});

Route::prefix('branches')->middleware(['auth', 'euie'])->group(function (){
    Route::get('/', [BranchController::class, 'list'])->name('branches');
    Route::get('/xlsx', [BranchController::class, 'xlsx'])->name('branchesxlsx');
    Route::get('/edit/{id?}', [BranchController::class, 'edit'])->where('id', '[0-9]+')->name('editbranch');
    Route::post('/store/{id?}', [BranchController::class, 'store'])->where('id', '[0-9]+')->name('savebranch');
    Route::post('/delete/{id}', [BranchController::class, 'delete'])->where('id', '[0-9]+')->name('deletebranch');
});

Route::prefix('positions')->middleware(['auth', 'euie'])->group(function (){
    Route::get('/', [PositionController::class, 'list'])->name('positions');
    Route::get('/xlsx', [PositionController::class, 'xlsx'])->name('positionsxlsx');
    Route::get('/edit/{id?}', [PositionController::class, 'edit'])->where('id', '[0-9]+')->name('editposition');
    Route::post('/store/{id?}', [PositionController::class, 'store'])->where('id', '[0-9]+')->name('saveposition');
    Route::post('/delete/{id}', [PositionController::class, 'delete'])->where('id', '[0-9]+')->name('deleteposition');
});

Route::prefix('users')->middleware(['auth', 'euie'])->group(function (){
    Route::get('/', [UserController::class, 'list'])->name('users');
    Route::get('/xlsx', [UserController::class, 'xlsx'])->name('usersxlsx');
    Route::get('/edit/{id?}', [UserController::class, 'edit'])->where('id', '[0-9]+')->name('edituser');
    Route::post('/store/{id?}', [UserController::class, 'store'])->where('id', '[0-9]+')->name('saveuser');
    Route::post('/delete/{id}', [UserController::class, 'delete'])->where('id', '[0-9]+')->name('deleteuser');
    Route::get('/updatepwd/{id}', [UserController::class, 'updatepwd'])->where('id', '[0-9]+')->name('updatepwduser');
    Route::post('/savepwd/{id}', [UserController::class, 'savepwd'])->where('id', '[0-9]+')->name('savepwduser');
});
