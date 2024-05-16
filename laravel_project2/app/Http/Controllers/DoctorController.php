<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Gender;
use App\Models\Shift;
use App\Models\ShiftDetail;
use App\Models\Specialization;
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
    public function index() {
        $genders = Gender::all();
        $specialization = Specialization::all();

        $doctors = Doctor::with('specialization')
        ->with('gender')
            ->orderBy('id','desc')
        -> paginate(3)
        ->withQueryString();


        return view('admin.doctor_manage.index', [
            'doctors' => $doctors,
            'genders' => $genders,
            'specialization' => $specialization
        ]);
    }

    public function filter(int $id) {
        $genders = Gender::all();
        $specializations = Specialization::all();

        $doctors = Doctor::with('specialization')
            ->with('gender')
            ->where('specialization_id', '=', $id)
            ->paginate(8)
            ->withQueryString();

        return view('customer.homepage.doctor', [
            'doctors' => $doctors,
            'genders' => $genders,
            'specializations' => $specializations
        ]);
    }

    public function create() {
        $genders = Gender::all();
        $specialization = Specialization::all();
        $shifts = Shift::all();

        return view('admin.doctor_manage.creat/.e',[
            'genders' => $genders,
            'specialization' => $specialization,
            'shifts' => $shifts
        ]);
    }

    public function store(Request $request){

        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);

        $array = [];
        $array = Arr::add($array, 'name', $request->name);
        $array = Arr::add($array, 'email', $request->email);
        $array = Arr::add($array, 'password', Hash::make($request->password));
        $array = Arr::add($array, 'gender_id', $request->gender_id);
        $array = Arr::add($array, 'specialization_id', $request->specialization_id);
        $array = Arr::add($array, 'contact_number', $request->contact_number);
        $array = Arr::add($array, 'address', $request->address);
        $array = Arr::add($array, 'image', $imageName);

        //Lấy dữ liệu từ form và lưu lên db
        $doctor = Doctor::create($array);

        $selectedShiftIds = $request->input('shifts');
        foreach ($selectedShiftIds as $shiftId) {
            ShiftDetail::create(
                [
                    'doctor_id' => $doctor->id,
                    'shift_id' => $shiftId
                ]);
        }

        return Redirect::route('admin.doctor');
    }

    public function edit(Doctor $doctor, Request $request)
    {
        $shifts = Shift::all();
        $shift_details = ShiftDetail::with('doctor')
        ->with('shift')
        ->where('doctor_id', $doctor -> id)
        ->get();

        $genders = Gender::all();
        $specialization = Specialization::all();

        //Gọi đến view để sửa
        return view('admin.doctor_manage.edit', [
            'doctor' => $doctor,
            'specialization' => $specialization,
            'genders' => $genders,
            'shifts' => $shifts,
            'shift_details' => $shift_details
        ]);
    }

    public function update(Request $request, Doctor $doctor)
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();

            // Lưu ảnh vào thư mục public/images
            $image->move(public_path('images'), $imageName);
        }else{
            $imageName = $doctor -> image;
        }

        $doctor = Doctor::findOrFail($doctor->id);
        $shifts = $request->input('shifts');

        // Xóa hết các ca làm việc cũ của bác sĩ
        $doctor->shifts()->detach();

        // Thêm các ca làm việc mới được chọn cho bác sĩ
        foreach ($shifts as $shiftId) {
            ShiftDetail::create(
                [
                    'doctor_id' => $doctor->id,
                    'shift_id' => $shiftId
                ]);
        }

        //Lấy dữ liệu trong form và update lên db
        $array = [];
        $array = Arr::add($array, 'name', $request->name);
        $array = Arr::add($array, 'email', $request->email);
        $array = Arr::add($array, 'specialization_id', $request->specialization);
        $array = Arr::add($array, 'contact_number', $request->contact_number);
        $array = Arr::add($array, 'address', $request->address);
        $array = Arr::add($array, 'gender_id', $request->gender);
        $array = Arr::add($array, 'image', $imageName);
        $doctor->update($array);

        return Redirect::route('admin.doctor');
    }

    public function destroy(Doctor $doctor)
    {
        $shift_details = ShiftDetail::with('doctor')
            ->where('doctor_id', $doctor->id);
        $shift_details->delete();
        $doctor->delete();
        return Redirect::route('admin.doctor')->with('success', 'Delete a doctor successfully!');

    }

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
            return redirect()->route('doctor.appointmentList');
        }
        return Redirect::back() ->with('alert','Wrong password');
    }

    public function logout()
    {
        return Redirect::route('doctor.appointmentList')->with('success', 'Appointment created successfully!');
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
}
