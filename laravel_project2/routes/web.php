<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\CustomerController;

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

Route::get('/home', [DoctorController::class, 'index'])->name('home');

//     DOCTOR
Route::get('/doctor', [DoctorController::class, 'index'])->name('doctor');
Route::get('/create', [DoctorController::class, 'create'])->name('doctor.create');
Route::post('/create', [DoctorController::class, 'store'])->name('doctor.store');
Route::get('/{doctor}/edit', [DoctorController::class, 'edit'])->name('doctor.edit');
Route::put('/{doctor}/edit', [DoctorController::class, 'update'])->name('doctor.update');
Route::delete('{doctor}', [DoctorController::class, 'destroy'])->name('doctor.destroy');

////     Customer
Route::prefix('/customer')->group(function(){
    Route::get('/customer', [CustomerController::class,'index'])->name('customer.index');
    Route::get('/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/create', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('/{customer}/edit', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('customer.destroy');
});


//      Specialization
Route::get('/specialization', [SpecializationController::class, 'index'])->name('specialization');
