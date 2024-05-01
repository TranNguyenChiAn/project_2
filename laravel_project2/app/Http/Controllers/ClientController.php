<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Doctor;
use App\Models\Gender;
use App\Models\Patient;
use App\Models\Shift;
use App\Models\ShiftDetail;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ClientController extends Controller
{
    public function index()
    {
        $genders = Gender::all();
        $specialization = Specialization::all();

        $doctors = Doctor::with('specialization')
            ->with('gender')
            ->orderBy('id', 'desc')
            ->get();


        return view('customer.homepage.index', [
            'doctors' => $doctors,
            'genders' => $genders,
            'specialization' => $specialization
        ]);
    }

    public function doctorDetail(Doctor $doctor){

        $doctors = Doctor::with('specialization')
            ->with('gender')
            ->where('id', $doctor->id)
            ->first();

        $shift_details = ShiftDetail::with('doctor')
            ->with('shift')
            ->where('doctor_id', $doctor->id)
            ->get();

        return view('customer.appointment.doctor_detail', [
            'doctors' => $doctors,
            'shift_details' => $shift_details
        ]);
    }

    public function appointment(){
        return view('customer.appointment.index');
    }

    public function doctor_list(){
        $doctors = Doctor::with('specialization')
        ->with('shift')
            ->with('gender')
        ->get();
        $shifts = Shift::with('doctor')->get();


        return view('customer.appointment.doctor_list', [
            'doctors' => $doctors,
            'shifts' => $shifts
        ]);
    }

    public function specialization_list(){
        $specializations = Specialization::all();

        return view('customer.appointment.specialization_list', [
            'specializations ' => $specializations
        ]);
    }


    public function appointmentForm(int $id) {
        $shift_detail =  ShiftDetail::with('doctor')
            ->with('shift')
            ->where('doctor_id' , $id )
            ->get();

        $genders = Gender::all();
        $customers = Customer::all();
        $appointments = Appointment::with('doctor')
            ->with('admin')
            ->get();
        $doctors = Doctor::with('specialization')
            ->where('id', $id)
            ->first();

        return view('customer.appointment.form', [
            'customers' => $customers,
            'appointments' => $appointments,
            'genders' => $genders,
            'doctors' => $doctors,
            'shift_detail' => $shift_detail
        ]);
    }

    public function storeForm(Request $request) {

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

        return Redirect::route('index');
//        dd('$patient', $appointment);


    }


}
