<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ClientController;

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

Route::get('/', [DoctorController::class, 'index'])->name('home');

//     DOCTOR Manage
Route::prefix('/doctor')->group(function (){
    Route::get('/doctor', [DoctorController::class, 'index'])->name('doctor');
    Route::get('/create', [DoctorController::class, 'create'])->name('doctor.create');
    Route::post('/create', [DoctorController::class, 'store'])->name('doctor.store');
    Route::get('/{doctor}/edit', [DoctorController::class, 'edit'])->name('doctor.edit');
    Route::put('/{doctor}/edit', [DoctorController::class, 'update'])->name('doctor.update');
    Route::delete('{doctor}', [DoctorController::class, 'destroy'])->name('doctor.destroy');
});


////     Customer Manage
Route::prefix('/customer')->group(function(){
    Route::get('/index', [CustomerController::class,'index'])->name('customer.index');
    Route::get('/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/create', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('/{customer}/edit', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('customer.destroy');
});


//      Specialization Manage
Route::prefix('specialization')->group(function(){
    Route::get('/index', [SpecializationController::class, 'index'])->name('specialization.index');
    Route::get('/create', [SpecializationController::class, 'create'])->name('specialization.create');
    Route::post('/create', [SpecializationController::class, 'store'])->name('specialization.store');
    Route::get('{specialization}/edit', [SpecializationController::class, 'edit'])
        ->name('specialization.edit');
    Route::put('{specialization}/edit', [SpecializationController::class, 'update'])
        ->name('specialization.update');
    Route::delete('{specialization}', [SpecializationController::class, 'destroy'])
        ->name('specialization.destroy');

});

//      Appointment Manage
Route::prefix('appointment')->group(function(){
    Route::get('/index', [DoctorController::class, 'index'])->name('appointment.index');
    Route::get('/create', [DoctorController::class, 'create'])->name('appointment.create');
    Route::post('/create', [DoctorController::class, 'store'])->name('appointment.store');
    Route::get('{doctor}/edit', [DoctorController::class, 'edit'])->name('appointment.edit');
    Route::put('{doctor}/edit', [DoctorController::class, 'update'])->name('appointment.update');
    Route::delete('{doctor}', [DoctorController::class, 'destroy'])->name('appointment.destroy');
});


//      Customer
Route::prefix('client')->group(function(){
    Route::get('/index', [ClientController::class, 'index'])->name('client.index');
    Route::get('/create', [ClientController::class, 'create'])->name('client.create');
    Route::post('/create', [ClientController::class, 'store'])->name('client.store');
    Route::get('{doctor}/edit', [ClientController::class, 'edit'])->name('client.edit');
    Route::put('{doctor}/edit', [ClientController::class, 'update'])->name('client.update');
    Route::delete('{doctor}', [ClientController::class, 'destroy'])->name('client.destroy');
});



