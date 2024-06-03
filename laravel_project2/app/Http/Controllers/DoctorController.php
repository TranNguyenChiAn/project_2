<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
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
            ->where('doctor_id', $doctorId)
            ->get();
        $appointments_today_count = $appointments_today->count();

        return view('doctor.index', [
            'appointments_today' => $appointments_today,
            'appointments_today_count' => $appointments_today_count,
        ]);
    }

    public function appointment_list() {
        $doctor = Auth::guard('doctor')->check();
        $appointments = Appointment::with('doctor')
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
        $array = Arr::add($array, 'room_id', $request->room_id);
        $array = Arr::add($array, 'approval_status', $request->approval_status);
        $array = Arr::add($array, 'appointment_status', $request->appointment_status);
        $appointment->update($array);

        return Redirect::route('doctor.appointmentList');
    }
}
