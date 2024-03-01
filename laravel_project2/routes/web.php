<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;

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
Route::get('/', [DoctorController::class, 'index'])->name('home');
Route::get('/doctor', [DoctorController::class, 'index'])->name('doctor');
Route::get('/create', [DoctorController::class, 'create'])->name('doctor.create');
Route::post('/create', [DoctorController::class, 'store'])->name('doctor.store');
Route::get('/{doctor}/edit', [DoctorController::class, 'edit'])->name('doctor.edit');
Route::put('/{doctor}/update', [DoctorController::class, 'update'])->name('doctor.update');
Route::delete('{doctor}', [DoctorController::class, 'destroy'])->name('doctor.destroy');

