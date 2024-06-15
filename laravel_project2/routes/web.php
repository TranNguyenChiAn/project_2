<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ManageDoctorController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ShiftContronller;
use App\Http\Middleware\CheckLoginCustomer;
use App\Http\Middleware\CheckLoginAdmin;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Middleware\CheckLoginDoctor;
use App\Http\Controllers\MailController;
use App\Http\Controllers\VnpayController;
use App\Http\Controllers\RoomController;


Route::get('/', [ClientController::class, 'index'])->name('home');
Route::get('/find_doctor', [ClientController::class, 'findDoctor'])->name('findDoctor');
Route::post('/get-doctors', [DoctorController::class, 'filter'])->name('filter');

//   RESISTER AND LOGIN
Route::prefix('admin')->group(function (){
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'loginProcess'])->name('admin.loginProcess');

    Route::get('/register', [AdminController::class, 'register'])->name('admin.register');
    Route::post('/registerProcess', [AdminController::class, 'registerProcess'])->name('admin.registerProcess');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
});

// STATISTIC
Route::middleware(CheckLoginAdmin::class)->group(function (){
        Route::get('/admin/index', [StatisticController::class, 'index'])->name('admin.index');
});

//STATISTIC MANAGE
Route::middleware(CheckLoginAdmin::class)->group(function (){
    Route::prefix('manage_statistic')->group(function (){
        Route::get('/index', [StatisticController::class, 'index'])->name('statistic.index');
    });
    Route::post('/get-appointments-data', [StatisticController::class, 'getData'])->name('statistic.getAppointmentsData');

});


//     DOCTOR MANAGE
Route::middleware(CheckLoginAdmin::class)->group(function (){
    Route::prefix('manage_doctor')->group(function (){
        Route::get('/index', [ManageDoctorController::class, 'index'])->name('admin.doctor');
        Route::get('/create', [ManageDoctorController::class, 'create'])->name('doctor.create');
        Route::post('/create', [ManageDoctorController::class, 'store'])->name('doctor.store');
        Route::get('/{doctor}/edit', [ManageDoctorController::class, 'edit'])->name('doctor.edit');
        Route::put('/{doctor}/edit', [ManageDoctorController::class, 'update'])->name('doctor.update');
        Route::delete('{doctor}', [ManageDoctorController::class, 'destroy'])->name('doctor.destroy');
        Route::post('/get-rooms',[ManageDoctorController::class, 'getRooms'])->name('doctor.getRooms');


        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

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


//      Department Manage
Route::middleware(CheckLoginAdmin::class)->group( function(){
    Route::prefix('manage_department')->group(function (){
        Route::get('/index', [DepartmentController::class, 'index'])->name('department.index');
        Route::get('/create', [DepartmentController::class, 'create'])->name('department.create');
        Route::post('/create', [DepartmentController::class, 'store'])->name('department.store');
        Route::get('{department}/edit', [DepartmentController::class, 'edit'])
            ->name('department.edit');
        Route::put('{department}/edit', [DepartmentController::class, 'update'])
            ->name('department.update');
        Route::delete('{department}', [DepartmentController::class, 'destroy'])
            ->name('department.destroy');
    });

});

//      Appointment Manage
Route::middleware(CheckLoginAdmin::class)->group(function(){
    Route::prefix('manage_appointment')->group(function () {
        Route::get('/index', [AppointmentController::class, 'index'])->name('appointment.index');
        Route::get('/appointments/{id}', [AppointmentController::class, 'show']);

        Route::get('/create', [AppointmentController::class, 'create'])->name('appointment.create');
        Route::post('/create', [AppointmentController::class, 'store'])->name('appointment.store');
        Route::get('{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointment.edit');
        Route::put('{appointment}/edit', [AppointmentController::class, 'update'])->name('appointment.update');
        Route::delete('{appointment}', [AppointmentController::class, 'destroy'])->name('appointment.destroy');
        Route::get('/schedule', [AppointmentController::class, 'showData'])->name('appointment.showData');
    });
});

//  SHIFT MANAGE
Route::middleware(CheckLoginAdmin::class)->group(function(){
    Route::prefix('manage_shift')->group(function () {
        Route::get('/index', [ShiftContronller::class, 'index'])->name('shift.index');
        Route::get('/create', [ShiftContronller::class, 'create'])->name('shift.create');
        Route::post('/create', [ShiftContronller::class, 'store'])->name('shift.store');
        Route::get('edit/{shift}', [ShiftContronller::class, 'edit'])->name('shift.edit');
        Route::put('edit/{shift}', [ShiftContronller::class, 'update'])->name('shift.update');
        Route::delete('{shift}', [ShiftContronller::class, 'destroy'])->name('shift.destroy');

    });
});

//  ROOM MANAGE
Route::middleware(CheckLoginAdmin::class)->group(function(){
    Route::prefix('manage_room')->group(function () {
        Route::get('/index', [RoomController::class, 'index'])->name('room.index');
        Route::get('/create', [RoomController::class, 'create'])->name('room.create');
        Route::post('/create', [RoomController::class, 'store'])->name('room.store');
        Route::get('edit/{room}', [RoomController::class, 'edit'])->name('room.edit');
        Route::put('edit/{room}', [RoomController::class, 'update'])->name('room.update');
        Route::delete('{room}', [RoomController::class, 'destroy'])->name('room.destroy');

    });
});


//      Client
Route::prefix('customer')->group(function () {
    Route::get('/index', [ClientController::class, 'index'])->name('index');

    Route::get('login', [CustomerController::class, 'login'])->name('customer.login');
    Route::post('login', [CustomerController::class, 'loginProcess'])->name('customer.loginProcess');
    Route::get('/register', [CustomerController::class, 'register'])->name('customer.register');
    Route::post('/register', [CustomerController::class, 'registerProcess'])->name('customer.registerProcess');
    Route::get('/contact_us', [ClientController::class, 'contact_us'])->name('customer.contact');
    Route::get('/about_us', [ClientController::class, 'about_us'])->name('customer.about_us');

    Route::get('/{profile}/edit', [ClientController::class, 'edit'])->name('profile.edit');
    Route::put('/{profile}/edit', [ClientController::class, 'update'])->name('profile.update');
});

Route::middleware(CheckLoginCustomer::class)->group(function() {
    Route::get("/doctor_{doctor}/detail", [ClientController::class, 'doctorDetail'])->name('doctor_detail');
    Route::get('/doctor_list', [ClientController::class, 'doctor_list'])->name('appointment.doctor_list');
    Route::get('/book_doctor_{id}', [ClientController::class, 'appointmentForm'])->name('appointment.Form');

    Route::get('/appointment_list', [ClientController::class, 'appointment_list'])
        ->name('appointment.list');
    Route::get('/appointment_{appointment}_detail', [ClientController::class, 'appointment_detail'])
        ->name('appointment.detail');
    Route::get('/edit_appointment/{appointment}', [ClientController::class, 'editAppointment'])
        ->name('customer.editAppointment');
    Route::put('/edit_appointment/{appointment}', [ClientController::class, 'updateAppointment'])
        ->name('customer.updateAppointment');
    Route::put('/cancel_appointment/{appointment}', [ClientController::class, 'cancelAppointment'])
        ->name('customer.cancelAppointment');
    Route::put('/undoCancel_appointment/{appointment}', [ClientController::class, 'undoCancel'])
        ->name('customer.undoCancel');

    Route::post('/store', [ClientController::class, 'storeForm'])->name('appointment.storeForm');

    Route::get('/logout', [CustomerController::class, 'logout'])->name('customer.logout');

    Route::get('/payment/appointmentId={appointment}', [ClientController::class, 'payment'])->name('customer.payment');
    Route::post('/vnpay_payment', [VnpayController::class, 'createPayment'])->name('vnpay.payment');
    Route::get('/vnpay_return', [VnpayController::class, 'vnpayReturn'])->name('vnpay.return');
});


//      Doctor
Route::prefix('doctor')->group(function () {
    Route::get('login', [DoctorController::class, 'login'])->name('doctor.login');
    Route::post('login', [DoctorController::class, 'loginProcess'])->name('doctor.loginProcess');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showDoctorRequestForm'])->name('doctor.requestPw');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkDoctorEmail'])->name('doctor.requestEmail');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showDoctorResetForm'])->name('doctor.resetPw');
    Route::post('/reset-password', [ResetPasswordController::class, 'resetDoctorPw'])->name('doctor.updatePw');

    Route::get('{profile}/edit', [DoctorController::class, 'edit'])->name('doctor.editProfile');
    Route::put('{profile}/edit', [DoctorController::class, 'update'])->name('doctor.updateProfile');
});

Route::middleware(CheckLoginDoctor::class)->group(function() {
    Route::prefix('doctor')->group(function () {
        Route::get('/index', [DoctorController::class, 'index'])
            ->name('doctor.index');
        Route::get('/appointment', [DoctorController::class, 'appointment_list'])
            ->name('doctor.appointmentList');
        Route::get('/create_appointment', [DoctorController::class, 'createAppointment'])
            ->name('doctor.createAppointment');
        Route::post('/store', [DoctorController::class, 'storeAppointment'])
            ->name('doctor.storeAppointment');
        Route::get('/edit_appointment/{appointment}', [DoctorController::class, 'editAppointment'])
            ->name('doctor.editAppointment');
        Route::put('/edit_appointment/{appointment}', [DoctorController::class, 'updateAppointment'])
            ->name('doctor.updateAppointment');
        Route::get('/schedule', [DoctorController::class, 'schedule'])
            ->name('doctor.schedule');
        Route::get('/logout', [DoctorController::class, 'logout'])->name('doctor.logout');
    });
});

Route::get('/send-mail', [MailController::class, 'sendMail']);








