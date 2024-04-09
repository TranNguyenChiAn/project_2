<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Doctor;
use App\Models\Gender;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AppointmentController extends Controller
{
    public function index() {
        $appointment = Appointment::with('patient')
        ->get();

        return view('admin.appointment_management.index', [
            'appointment' => $appointment,
        ]);
    }

    public function showData(){
        $appointment = Appointment::with('patient')
            ->get();
        $eventArray = [];
        while ($row = $appointment){
            $eventArray = $row;
            $event = json_encode($eventArray);
            echo $event;
        }
    }

    public function create() {
        $genders = Gender::all();
        $patients = Patient::all();
        $appointments = Appointment::with('doctor')
        ->with('admin')
        ->get();
        $doctors = Doctor::with('specialization')
        ->get();

        return view('admin.appointment_management.add', [
            'patients' => $patients,
            'appointments' => $appointments,
            'genders' => $genders,
            'doctors' => $doctors
        ]);
    }

    public function store(Request $request) {

        $array = [];
        $array = Arr::add($array, 'name', $request->name);
        $array = Arr::add($array, 'date_birth', $request->date_birth);
        $array = Arr::add($array, 'gender_id', $request-> input('gender_id'));
        $array = Arr::add($array, 'insurance_number', $request->insurance_number);
        $array = Arr::add($array, 'phone_number', $request->phone_number);
        $array = Arr::add($array, 'address', $request->address);
        Patient::create($array);


        $admin_id = Auth::guard('admin')->id();
        $maxPatientID = Patient::max('id');
        $appointment = [];
        $appointment = Arr::add($appointment, 'doctor_id', $request->input('doctor_id'));
        $appointment = Arr::add($appointment, 'admin_id', $admin_id);
        $appointment = Arr::add($appointment, 'patient_id', $maxPatientID);
        $appointment = Arr::add($appointment, 'appointment_time', $request->date_time);
        $appointment = Arr::add($appointment, 'status', 'pending');
        $appointment = Arr::add($appointment, 'status', $request-> status);
        $appointment = Arr::add($appointment, 'note', $request->note);
        Appointment::create($appointment);

        return Redirect::route('appointment.index');
//        dd('$patient', $appointment);


    }

    public function getEvents(){
        $appointments = Appointment::all();
        return response()->json($appointments);
    }

}
