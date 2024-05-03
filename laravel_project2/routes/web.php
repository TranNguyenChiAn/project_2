<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ShiftContronller;
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

Route::get('/register', [AdminController::class, 'register'])->name('admin.register');
Route::post('/registerProcess', [AdminController::class, 'registerProcess'])->name('admin.registerProcess');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

//     DOCTOR MANANGE
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

//  SHIFT MANAGE
Route::middleware(CheckLoginAdmin::class)->group(function(){
    Route::prefix('shift')->group(function () {
        Route::get('/index', [ShiftContronller::class, 'index'])->name('shift.index');
        Route::get('/create', [ShiftContronller::class, 'create'])->name('shift.create');
        Route::post('/create', [ShiftContronller::class, 'store'])->name('shift.store');
        Route::get('edit/{shift}', [ShiftContronller::class, 'edit'])->name('shift.edit');
        Route::put('edit/{shift}', [ShiftContronller::class, 'update'])->name('shift.update');
        Route::delete('{shift}', [ShiftContronller::class, 'destroy'])->name('shift.destroy');
    });
});


//      Client
Route::prefix('customer')->group(function () {
    Route::get('/index', [ClientController::class, 'index'])->name('index');

    Route::get('login', [CustomerController::class, 'login'])->name('customer.login');
    Route::get('login', [CustomerController::class, 'loginProcess'])->name('customer.loginProcess');
    Route::get('/register', [CustomerController::class, 'register'])->name('customer.register');
    Route::post('/register', [CustomerController::class, 'registerProcess'])->name('customer.registerProcess');

    Route::get('{profile}/edit', [ClientController::class, 'edit'])->name('profile.edit');
    Route::put('{profile}/edit', [ClientController::class, 'update'])->name('profile.update');
    Route::get('/specialization_{id}', [DoctorController::class, 'filter'])->name('filter');

    Route::get("/doctor_{doctor}/detail", [ClientController::class, 'doctorDetail'])->name('doctor_detail');
});

Route::middleware(CheckLoginCustomer::class)->group(function() {
    Route::prefix('customer')->group(function () {

        Route::delete('{doctor}', [ClientController::class, 'destroy'])->name('client.destroy');
//
        Route::get('/appointment', [ClientController::class, 'appointment'])->name('appointment.choose');
        Route::get('/doctor_list', [ClientController::class, 'doctor_list'])->name('appointment.doctor_list');
        Route::get('/specialization_list', [ClientController::class, 'specialization_list'])
            ->name('appointment.specialization_list');
        Route::get('/book_doctor_{id}', [ClientController::class, 'appointmentForm'])->name('appointment.Form');
        Route::post('/store', [ClientController::class, 'storeForm'])->name('appointment.storeForm');

    });
});



