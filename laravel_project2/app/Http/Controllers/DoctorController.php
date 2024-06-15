<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isNull;

class DoctorController extends Controller
{
    public function login(){
        return view('doctor.account.login');
    }

    public function loginProcess(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email'=>'required',
            'password'=> 'required'
        ], [
            'email.required'=>'Email can not be empty',
            'password.required'=>'Password can not be empty',
        ]);

        if($validator->fails()){
            return redirect()->route('doctor.login')->withErrors($validator)->withInput();
        }
        $loginInfor = ['email' => $request->email, 'password' => $request->password];

        if(Auth::guard('doctor')->attempt($loginInfor)){

            //Lấy thông tin của doctor đang login
            $doctor= Auth::guard('doctor')->user();
            //Cho login
            Auth::guard('doctor')->login($doctor);
            //Ném thông tin doctor đăng nhập lên session
            session(['doctor' => $doctor]);
            return redirect()->route('doctor.index');
        }
        return Redirect::back() ->with('alert','Wrong password');
    }

    public function logout()
    {
        Auth::guard('doctor')->logout();
        session()->forget('doctor');
        return Redirect::route('doctor.login');
    }

    public function index() {
        // Lấy ngày hiện tại
        $today = date('Y-m-d');

        $doctorId = Auth::guard('doctor')->id();
        $appointments_today = Appointment::with('doctor')
            ->where('date', $today)
            ->where('doctor_id','=', $doctorId)
            ->get();
        $appointments_today_count = $appointments_today->count();

        return view('doctor.index', [
            'appointments_today' => $appointments_today,
            'appointments_today_count' => $appointments_today_count,
        ]);
    }

    public function appointment_list() {
        $doctor = Auth::guard('doctor')->check();
        $doctorId = Auth::guard('doctor')->id();
        $appointments = Appointment::with('doctor')
            ->where('doctor_id','=', $doctorId)
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('doctor.appointment.index', [
            'appointments' => $appointments,
            'doctor' => $doctor
        ]);
    }

    public function filter(Request $request) {
        $department_id = $request->department_id;
        $genders = Gender::all();
        $departments = Department::all();

        $doctors = Doctor::with('department')
            ->with('gender')
            ->where('department_id', '=', $department_id )
            ->paginate(8)
            ->withQueryString();

        return view('customer.homepage.doctor', [
            'doctors' => $doctors,
            'genders' => $genders,
            'departments' => $departments
        ]);
    }

    public function schedule(){
        // Lấy ngày hiện tại
        $today = date('Y-m-d');

        $doctorId = Auth::guard('doctor')->id();
        $appointments_today = Appointment::with('doctor')
            ->where('date', $today)
            ->where('doctor_id', $doctorId)
            ->get();
        $appointments_today_count = $appointments_today->count();
        return view('doctor.index', [
            'appointments_today' => $appointments_today,
            'appointments_today_count' => $appointments_today_count,
        ]);
    }

    public function storeAppointment(Request $request){

        $doctorId = Auth::guard('doctor')->id();
        $maxCustomerId = Customer::max('customer_id') + 1;
        $appointment = [];
        $appointment = Arr::add($appointment, 'doctor_id', $doctorId);
        $appointment = Arr::add($appointment, 'customer_id', $maxCustomerId);
        $appointment = Arr::add($appointment, 'customer_name', $request->customer_name);
        $appointment = Arr::add($appointment, 'date_birth', $request->date_birth);
        $appointment = Arr::add($appointment, 'gender_id', $request-> input('gender_id'));
        $appointment = Arr::add($appointment, 'phone', $request->phone_number);
        $appointment = Arr::add($appointment, 'date', $request->date);
        $appointment = Arr::add($appointment, 'time', $request->time);
        $appointment = Arr::add($appointment, 'customer_notes', $request->customer_notes);
        $appointment = Arr::add($appointment, 'insurance_number', $request->insurance_number);
        $appointment = Arr::add($appointment, 'doctor_notes', $request->customer_notes);
        $appointment = Arr::add($appointment, 'approval_status', 1);
        $appointment = Arr::add($appointment, 'appointment_status', 1);
        Appointment::create($appointment);

        return Redirect::route('doctor.appointmentList');
    }

    public function show($id)
    {
        $appointment = Appointment::with('doctor')->findOrFail($id);
        return response()->json($appointment);
    }

    public function editAppointment(Appointment $appointment){
        $rooms = Room::all();

        return view("doctor.appointment.edit", [
            'appointment' => $appointment,
            'rooms' => $rooms
        ]);

    }

    public function updateAppointment(Appointment $appointment, Request $request){
        $array = [];
        $array = Arr::add($array, 'approval_status', $request->approval_status);
        $array = Arr::add($array, 'appointment_status', $request->appointment_status);
        $array = Arr::add($array, 'doctor_notes', $request->doctor_notes);
        $appointment->update($array);

        return Redirect::route('doctor.appointmentList');
    }
}
