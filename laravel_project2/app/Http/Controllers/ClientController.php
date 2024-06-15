<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Doctor;
use App\Models\Gender;
use App\Models\Room;
use App\Models\Shift;
use App\Models\ShiftDetail;
use App\Models\Department;
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
        $departments = Department::all();

        $doctors = Doctor::with('department')
            ->with('gender')
            ->orderBy('id', 'desc')
            ->paginate(8)
            ->withQueryString();


        return view('customer.homepage.doctor', [
            'doctors' => $doctors,
            'genders' => $genders,
            'departments' => $departments
        ]);
    }

    public function doctorDetail(Doctor $doctor){
        $doctors = Doctor::with('department')
            ->with('gender')
            ->where('id', $doctor->id)
            ->first();
        $customerId = Auth::guard('customer')->id();
        $customer = Customer::with('appointment')
        ->where('id','=', $customerId)
        ->first();

        $shift_details = ShiftDetail::with('doctor')
            ->with('shift')
            ->where('doctor_id', $doctors->id)
            ->get();

        // Tạo danh sách ngày trong 4 ngày tiếp theo
        $dates = [];
        for ($i = 1; $i < 5; $i++) {
            $dates[] = Carbon::now()->addDays($i)->format('d-m-Y');
        }

        // Lấy danh sách các lịch hẹn của bác sĩ trong ngày cụ thể
        $appointments = Appointment::where('doctor_id', $doctors->id)
            ->pluck('time');

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

        return view('customer.appointment.doctor_detail', [
            'doctors' => $doctors,
            'shift_details' => $shift_details,
            'availableTime' => $available_times,
            'dates' => $dates,
            'customer' => $customer,
            'appointments' => $appointments,
        ]);
    }

    public function appointment(){
        return view('customer.appointment.index');
    }

    public function doctor_list(){
        $doctors = Doctor::with('department')
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
        $customerId = Auth::guard('customer')->id();
        $appointments = Appointment::with('doctor')
            ->with('room')
            ->with('gender')
            ->where('customer_id', $customerId)
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('customer.appointment.index', [
            'appointments' => $appointments
        ]);
    }

    public function appointment_detail(Appointment $appointment){
        $rooms = Room::all();

        return view("customer.appointment.appointment_detail", [
            'appointment' => $appointment,
            'rooms' => $rooms
        ]);

    }

    public function editAppointment(Appointment $appointment){
        $genders = Gender::all();
        return view("customer.appointment.edit", [
            'appointment' => $appointment,
            'genders' => $genders,
        ]);

    }

    public function updateAppointment(Request $request ,Appointment $appointment){
        $array= [];
        $array = Arr::add($array, 'customer_name', $request->customer_name);
        $array = Arr::add($array, 'date_birth', $request->date_birth);
        $array = Arr::add($array, 'gender_id', $request-> input('gender_id'));
        $array = Arr::add($array, 'insurance_number', $request->insurance_number);
        $array = Arr::add($array, 'phone', $request->phone_number);
        $array = Arr::add($array, 'customer_notes', $request->customer_notes);
        $appointment->update($array);

        return Redirect::route('appointment.list');

    }

    public function cancelAppointment(Appointment $appointment){
        $array= [];
        $array = Arr::add($array, 'approval_status', 3);
        $appointment->update($array);

        return Redirect::route('appointment.list');
    }

    public function undoCancel(Appointment $appointment){
        $array= [];
        $array = Arr::add($array, 'approval_status', 1);
        $appointment->update($array);

        return Redirect::route('appointment.list');

    }

    public function storeForm(Request $request) {
        $customerId = Auth::guard('customer')->id();
        $date = $request->date;

        $formattedDate = Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');
        $appointments = [];
        $appointments = Arr::add($appointments, 'doctor_id', $request->doctor_id);
        $appointments = Arr::add($appointments, 'customer_id', $customerId);
        $appointments = Arr::add($appointments, 'customer_name', $request->name);
        $appointments = Arr::add($appointments , 'date_birth', $request->date_birth);
        $appointments = Arr::add($appointments , 'gender_id', $request-> input('gender_id'));
        $appointments = Arr::add($appointments , 'insurance_number', $request->insurance_number);
        $appointments = Arr::add($appointments , 'phone', $request->phone_number);
        $appointments = Arr::add($appointments, 'date', $formattedDate);
        $appointments = Arr::add($appointments, 'room_id', 1);
        $appointments = Arr::add($appointments, 'time', $request->appointment_time);
        $appointments = Arr::add($appointments, 'approval_status', 1);
        $appointments = Arr::add($appointments, 'appointment_status', 1);
        $appointments = Arr::add($appointments, 'payment_status', 1);
        $appointments = Arr::add($appointments, 'customer_notes', $request->customer_notes);

       Appointment::create($appointments);
        $appointment = Appointment::where('customer_id', $customerId)
            ->max('id');
        

//        ->with('success', 'Appointment created successfully!')
        return Redirect::route('customer.payment', $appointment);
    }

    public function payment(Appointment $appointment){
        $customerId = Auth::guard('customer')->id();
        $gender = Gender::all();
        $doctor = Doctor::all();

//        dd($appointment);
        return view("customer.payment.index", [
            'appointment' => $appointment,
            'gender' => $gender,
            'doctor' => $doctor,
        ]);

    }

    public function contact_us() {
        return view('customer.homepage.contact_us');
    }

    public function about_us() {
        return view('customer.homepage.about_us');
    }


}
