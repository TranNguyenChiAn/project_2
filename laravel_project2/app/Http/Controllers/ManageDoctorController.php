<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Gender;
use App\Models\Room;
use App\Models\Shift;
use App\Models\ShiftDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ManageDoctorController extends Controller
{
    public function index() {
        $genders = Gender::all();
        $department = Department::all();

        $doctors = Doctor::with('department')
            ->with('gender')
            ->orderBy('id','desc')
            -> paginate(3)
            ->withQueryString();


        return view('admin.doctor_manage.index', [
            'doctors' => $doctors,
            'genders' => $genders,
            'department' => $department
        ]);
    }


    public function create() {
        $genders = Gender::all();
        $departments = Department::all();
        $rooms = Room::all();
        $shifts = Shift::all();

        return view('admin.doctor_manage.create',[
            'genders' => $genders,
            'departments' => $departments,
            'rooms' => $rooms,
            'shifts' => $shifts
        ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email'=>'required | unique:doctors',
            'password'=> 'required|min:8',
            'contact_number' => 'required|unique:doctors'
        ], [
            'name.required'=>'Name can not be empty',
            'email.required'=>'Email can not be empty',
            'email.unique' => 'Email has existed. Please try again',
            'password.required'=>'Password can not be empty',
            'password.min' => 'Password has at least 8 character',
            'contact_number' => 'Contact number has been existed. Please try again!',
        ]);

        if($validator->fails()){
            return redirect()->route('doctor.create')->withErrors($validator)->withInput();
        }

        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);

        // Kiểm tra nếu phòng đã có bác sĩ với ca trực giống nhau
        $roomOccupied = ShiftDetail::where('shift_id', $request->shift_id)
            ->whereHas('doctor', function ($query) use ($request) {
                $query->where('room_id', $request->room_id);
            })
            ->exists();

        if ($roomOccupied) {
            return back()->withErrors(['room_id' => 'Phòng này đã có bác sĩ với ca trực giống nhau.']);
        }

        $array = [];
        $array = Arr::add($array, 'name', $request->name);
        $array = Arr::add($array, 'email', $request->email);
        $array = Arr::add($array, 'password', Hash::make($request->password));
        $array = Arr::add($array, 'gender_id', $request->gender_id);
        $array = Arr::add($array, 'department_id', $request->department_id);
        $array = Arr::add($array, 'room_id', $request->room_id);
        $array = Arr::add($array, 'contact_number', $request->contact_number);
        $array = Arr::add($array, 'address', $request->address);
        $array = Arr::add($array, 'image', $imageName);
        $array = Arr::add($array, 'status', $request->status);

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

        return Redirect::route('admin.doctor')->with('success', 'Create successfully');
    }

    public function edit(Doctor $doctor, Request $request)
    {
        $shifts = Shift::all();
        $shift_details = ShiftDetail::with('doctor')
            ->with('shift')
            ->where('doctor_id', $doctor -> id)
            ->get();

        $genders = Gender::all();
        $rooms = Room::all();
        $departments = Department::all();
        // Kiểm tra nếu phòng đã có bác sĩ với ca trực giống nhau
        $roomOccupied = ShiftDetail::where('shift_id', $request->shift_id)
            ->whereHas('doctor', function ($query) use ($request) {
                $query->where('room_id', $request->room_id);
            })
            ->exists();

        if ($roomOccupied) {
            return back()->withErrors(['room_id' => 'Phòng này đã có bác sĩ với ca trực giống nhau.']);
        }

        //Gọi đến view để sửa
        return view('admin.doctor_manage.edit', [
            'doctor' => $doctor,
            'departments' => $departments,
            'genders' => $genders,
            'rooms' => $rooms,
            'shifts' => $shifts,
            'shift_details' => $shift_details
        ]);
    }

    public function getRooms(Request $request) {
        $departmentId = $request->department_id;
        $shiftId = $request->shift_id;

        $consultingRooms = Room::whereDoesntHave('shifts', function ($query) use ($shiftId) {
            $query->where('shift_id', $shiftId);
        })
            ->where('department_')
            ->get();

        return response()->json($consultingRooms);
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
        $array = Arr::add($array, 'department_id', $request->department_id);
        $array = Arr::add($array, 'contact_number', $request->contact_number);
        $array = Arr::add($array, 'gender_id', $request->gender);
        $array = Arr::add($array, 'address', $request->address);
        $array = Arr::add($array, 'room_id', $request-> room_id);
        $array = Arr::add($array, 'image', $imageName);
        $array = Arr::add($array, 'status', $request->status);
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
}
