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
        return view('customer.homepage.index');
    }

    public function findDoctor()
    {
        $genders = Gender::all();
        $specializations = Specialization::all();

        $doctors = Doctor::with('specialization')
            ->with('gender')
            ->orderBy('id', 'desc')
            ->paginate(8)
            ->withQueryString();


        return view('customer.homepage.doctor', [
            'doctors' => $doctors,
            'genders' => $genders,
            'specializations' => $specializations
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

    public function appointment_list(){
        $appointments = Appointment::with('doctor')
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('customer.appointment.index', [
            'appointments' => $appointments
        ]);
    }


    public function appointmentForm(int $id)
    {
        $genders = Gender::all();
        $customers = Customer::all();
        $doctors = Doctor::with('specialization')
            ->where('id', $id)
            ->first();

        // Lấy danh sách các lịch hẹn của bác sĩ trong ngày cụ thể
        $appointments = Appointment::where('doctor_id', $doctors->id)
//            ->whereDate('date', $selected_date)
            ->pluck('time');


        $shift_details = ShiftDetail::with('doctor')
            ->with('shift')
            ->where('doctor_id', $doctors->id)
            ->get();

        // Lọc ra các ca làm việc còn trống
        $available_times = [];
        foreach ($shift_details as $shift_detail) {
            $start = Carbon::parse($shift_detail->shift->start_time);
            $end = Carbon::parse($shift_detail->shift->end_time);
            $interval = $start->copy();

            while ($interval->lte($end)) {
                $appointment_time = $interval->format('H:i:s');
                if (!$appointments->contains($appointment_time)) {
                    $available_times[] = $interval->format('H:i:s');
                }
                $interval->addMinutes(30);
            }
        }

        return view('customer.appointment.form', [
            'customers' => $customers,
            'appointments' => $appointments,
            'genders' => $genders,
            'doctors' => $doctors,
            'shift_details' => $shift_details,
            'availableTime' => $available_times
        ]);
    }

    public function storeForm(Request $request) {
        $customerId = Auth::guard('customer')->id();

        $appointment = [];
        $appointment = Arr::add($appointment, 'doctor_id', $request->doctor_id);
        $appointment = Arr::add($appointment, 'customer_id', $customerId);
        $appointment = Arr::add($appointment, 'customer_name', $request->name);
        $appointment = Arr::add($appointment , 'date_birth', $request->date_birth);
        $appointment = Arr::add($appointment , 'gender_id', $request-> input('gender_id'));
        $appointment = Arr::add($appointment , 'insurance_number', $request->insurance_number);
        $appointment = Arr::add($appointment , 'phone', $request->phone_number);
        $appointment = Arr::add($appointment, 'date', $request->date);
        $appointment = Arr::add($appointment, 'time', $request->appointment_time);
        $appointment = Arr::add($appointment, 'status', 1);
        $appointment = Arr::add($appointment, 'note', $request->note);
        Appointment::create($appointment);

        return Redirect::route('home')->with('success', 'Appointment created successfully!');
    }


}
