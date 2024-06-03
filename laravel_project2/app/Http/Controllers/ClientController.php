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

        $customers = Customer::all();

        $shift_details = ShiftDetail::with('doctor')
            ->with('shift')
            ->where('doctor_id', $doctors->id)
            ->get();

        // Tạo danh sách ngày trong 4 ngày tiếp theo
        $dates = [];
        for ($i = 0; $i < 4; $i++) {
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
                $appointment_time = $interval->format('H:i');
                if (!$appointments->contains($appointment_time)) {
                    $available_times[] = $interval->format('H:i');
                }
                $interval->addMinutes(30);
            }
        }

        return view('customer.appointment.doctor_detail', [
            'doctors' => $doctors,
            'shift_details' => $shift_details,
            'availableTime' => $available_times,
            'dates' => $dates,
            'customers' => $customers,
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
        $appointments = Appointment::with('doctor')
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
        $appointment = [];
        $appointment = Arr::add($appointment, 'doctor_id', $request->doctor_id);
        $appointment = Arr::add($appointment, 'customer_id', $customerId);
        $appointment = Arr::add($appointment, 'customer_name', $request->name);
        $appointment = Arr::add($appointment , 'date_birth', $request->date_birth);
        $appointment = Arr::add($appointment , 'gender_id', $request-> input('gender_id'));
        $appointment = Arr::add($appointment , 'insurance_number', $request->insurance_number);
        $appointment = Arr::add($appointment , 'phone', $request->phone_number);
        $appointment = Arr::add($appointment, 'date', $formattedDate);
        $appointment = Arr::add($appointment, 'room_id', 1);
        $appointment = Arr::add($appointment, 'time', $request->appointment_time);
        $appointment = Arr::add($appointment, 'approval_status', 1);
        $appointment = Arr::add($appointment, 'appointment_status', 1);
        $appointment = Arr::add($appointment, 'payment_status', 1);
        $appointment = Arr::add($appointment, 'customer_notes', $request->customer_notes);

       Appointment::create($appointment);
        $appointments = Appointment::where('customer_id', $customerId)
            ->max('id');
        

//        ->with('success', 'Appointment created successfully!')
        return Redirect::route('customer.payment', $appointments);
    }

    public function payment(Appointment $appointments){
        $customerId = Auth::guard('customer')->id();
        $gender = Gender::all();
        $doctor = Doctor::all();

//        dd($appointment);
        return view("customer.payment.index", [
            'appointments' => $appointments,
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
