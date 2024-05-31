<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Doctor;
use App\Models\Gender;
use App\Models\Room;
use App\Models\Shift;
use App\Models\ShiftDetail;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function index() {
        $appointments = Appointment::with('doctor')
            ->with('gender')
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('admin.appointment_management.index', [
            'appointments' => $appointments,
        ]);
    }

    public function edit(Appointment $appointment){
        $rooms = Room::all();

        return view("admin.appointment_management.edit", [
            'appointment' => $appointment,
            'rooms' => $rooms
        ]);

    }

    public function update(Appointment $appointment, Request $request){
        $array = [];
        $array = Arr::add($array, 'room_id', $request->room_id);
        $array = Arr::add($array, 'approval_status', $request->status);
        $appointment->update($array);

        return Redirect::route('appointment.index');
    }

    public function showData(){
        $appointments = Appointment::all();
        return view('admin.appointment_management.calendar', compact('appointments'));
    }

    public function show($id)
    {
        $appointment = Appointment::with('doctor')->findOrFail($id);
        return response()->json($appointment);
    }

    public function create() {
        $genders = Gender::all();
        $shifts = Shift::all();
        $appointments = Appointment::with('doctor')
        ->with('admin')
        ->get();
        $rooms = Room::all();
        $doctors = Doctor::with('department')
        ->get();

        return view('admin.appointment_management.add', [
            'appointments' => $appointments,
            'shifts' => $shifts,
            'genders' => $genders,
            'doctors' => $doctors,
            'rooms' => $rooms
        ]);
    }

    public function store(Request $request) {
        $appointment = [];
        $appointment = Arr::add($appointment, 'doctor_id', $request->input('doctor_id'));
        $appointment = Arr::add($appointment, 'customer_id', $request->customer_id);
        $appointment = Arr::add($appointment, 'customer_name', $request->customer_name);
        $appointment = Arr::add($appointment, 'date_birth', $request->date_birth);
        $appointment = Arr::add($appointment, 'gender_id', $request-> input('gender_id'));
        $appointment = Arr::add($appointment, 'phone', $request->phone_number);
        $appointment = Arr::add($appointment, 'room_id', 1);
        $appointment = Arr::add($appointment, 'date', $request->date);
        $appointment = Arr::add($appointment, 'time', $request->time);
        $appointment = Arr::add($appointment, 'approval_status', 1);
        $appointment = Arr::add($appointment, 'customer_notes', $request->customer_notes);
        Appointment::create($appointment);

        return Redirect::route('appointment.index');
    }

}
