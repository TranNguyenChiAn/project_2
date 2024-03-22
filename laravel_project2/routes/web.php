<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Middleware\CheckLoginCustomer;
use App\Http\Middleware\CheckLoginAdmin;
use App\Http\Controllers\AdminController;


Route::get('/', [ClientController::class, 'index'])->name('home');

//   RESISTER AND LOGIN
Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/login', [AdminController::class, 'loginProcess'])->name('admin.loginProcess');

Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/forgot_password', [AdminController::class, 'forgotPassword'])->name('admin.forgotPassword');


//     DOCTOR Manage
Route::middleware(CheckLoginAdmin::class)->group(function (){
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
    Route::get('/index', [AppointmentController::class, 'index'])->name('appointment.index');
    Route::get('/create', [DoctorController::class, 'create'])->name('appointment.create');
    Route::post('/create', [DoctorController::class, 'store'])->name('appointment.store');
    Route::get('{doctor}/edit', [DoctorController::class, 'edit'])->name('appointment.edit');
    Route::put('{doctor}/edit', [DoctorController::class, 'update'])->name('appointment.update');
    Route::delete('{doctor}', [DoctorController::class, 'destroy'])->name('appointment.destroy');
});


//      Client
Route::middleware(CheckLoginCustomer::class)->group(function(){
    Route::get('/index', [ClientController::class, 'index'])->name('client.index');

    Route::get('/create', [ClientController::class, 'create'])->name('client.create');
    Route::post('/create', [ClientController::class, 'store'])->name('client.store');

    Route::get('{doctor}/edit', [ClientController::class, 'edit'])->name('client.edit');
    Route::put('{doctor}/edit', [ClientController::class, 'update'])->name('client.update');

    Route::delete('{doctor}', [ClientController::class, 'destroy'])->name('client.destroy');

    Route::get('appointment',[ClientController::class, 'appointmentForm'])->name('client.appointment');
});

//   RESISTER AND LOGIN
Route::get('/login', [CustomerController::class, 'login'])->name('customer.login');
Route::post('/login', [CustomerController::class, 'loginProcess'])->name('customer.loginProcess');

Route::get('/logout', [CustomerController::class, 'logout'])->name('customer.logout');
Route::get('/forgot_password', [CustomerController::class, 'forgotPassword'])->name('customer.forgotPassword');



