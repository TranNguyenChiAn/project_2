<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientContronller;
use App\Http\Middleware\CheckLoginCustomer;
use App\Http\Middleware\CheckLoginAdmin;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Models\Appointment;


Route::get('/', [ClientController::class, 'index'])->name('home');

//   RESISTER AND LOGIN
Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/login', [AdminController::class, 'loginProcess'])->name('admin.loginProcess');
Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

//     DOCTOR Manage
Route::middleware(CheckLoginAdmin::class)->group(function (){
    Route::prefix('doctor')->group(function (){
        Route::get('/index', [DoctorController::class, 'index'])->name('admin.doctor');
        Route::get('/create', [DoctorController::class, 'create'])->name('doctor.create');
        Route::post('/create', [DoctorController::class, 'store'])->name('doctor.store');
        Route::get('/{doctor}/edit', [DoctorController::class, 'edit'])->name('doctor.edit');
        Route::put('/{doctor}/edit', [DoctorController::class, 'update'])->name('doctor.update');
        Route::delete('{doctor}', [DoctorController::class, 'destroy'])->name('doctor.destroy');
    });

});


////     Customer Manage
Route::middleware(CheckLoginAdmin::class)->group(function(){
    Route::prefix('manage_customer')->group(function (){
        Route::get('/index', [CustomerController::class,'index'])->name('customer.index');
        Route::get('/create', [CustomerController::class, 'create'])->name('customer.create');
        Route::post('/create', [CustomerController::class, 'store'])->name('customer.store');
        Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
        Route::put('/{customer}/edit', [CustomerController::class, 'update'])->name('customer.update');
        Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('customer.destroy');
    });

});


//      Specialization Manage
Route::middleware(CheckLoginAdmin::class)->group( function(){
    Route::prefix('specialization')->group(function (){
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

});

//      Appointment Manage
Route::middleware(CheckLoginAdmin::class)->group(function(){
    Route::prefix('appointment')->group(function () {
        Route::get('/index', [AppointmentController::class, 'index'])->name('appointment.index');
        Route::get('/create', [AppointmentController::class, 'create'])->name('appointment.create');
        Route::get('/events', [AppointmentController::class, 'getEvents'])->name('appointment.getEvent');
        Route::get('/showData', [AppointmentController::class, 'showData'])->name('appointment.showData');
        Route::post('/create', [AppointmentController::class, 'store'])->name('appointment.store');
        Route::get('{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointment.edit');
        Route::put('{appointment}/edit', [AppointmentController::class, 'update'])->name('appointment.update');
        Route::delete('{appointment}', [AppointmentController::class, 'destroy'])->name('appointment.destroy');
    });
});

//  PATIENT MANAGE
Route::middleware(CheckLoginAdmin::class)->group(function(){
    Route::prefix('patient')->group(function () {
        Route::get('/index', [PatientContronller::class, 'index'])->name('patient.index');
        Route::get('{patient}/edit', [PatientContronller::class, 'edit'])->name('patient.edit');
        Route::put('{patient}/edit', [PatientContronller::class, 'update'])->name('patient.update');
        Route::delete('{patient}', [PatientContronller::class, 'destroy'])->name('patient.destroy');
    });
});


//      Client
Route::prefix('customer')->group(function(){
    Route::get('/index', [ClientController::class, 'index'])->name('index');

    Route::get('/register', [ClientController::class, 'register'])->name('register');
    Route::post('/register', [ClientController::class, 'register'])->name('register');

    Route::get('{profile}/edit', [ClientController::class, 'edit'])->name('profile.edit');
    Route::put('{profile}/edit', [ClientController::class, 'update'])->name('profile.update');

    Route::delete('{doctor}', [ClientController::class, 'destroy'])->name('client.destroy');
    Route::get('/specialization_{id}', [DoctorController::class, 'filter'])->name('filter');

    Route::get('appointment',[ClientController::class, 'appointmentForm'])->name('showForm');
    Route::post('appointment',[ClientController::class, 'storeForm'])->name('storeForm');

});



