<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Doctor;
use App\Models\Gender;
use App\Models\Shift;
use App\Models\ShiftDetail;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
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
        $specialization = Specialization::all();

        $doctors = Doctor::with('specialization')
            ->with('gender')
            ->where('specialization_id', '=', $id)
            ->paginate(8)
            ->withQueryString();


        return view('customer.homepage.filter', [
            'doctors' => $doctors,
            'genders' => $genders,
            'specialization' => $specialization
        ]);
    }

    public function create() {
        $genders = Gender::all();
        $specialization = Specialization::all();
        $shifts = Shift::all();

        return view('admin.doctor_manage.create',[
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

        $shiftDetails = ShiftDetail::all();
        $selectedShiftIds = $request->input('shifts');
        foreach ($shiftDetails as $index => $shiftDetail) {
            // Cập nhật shift_id cho mỗi bản ghi với giá trị tương ứng trong mảng $selectedShiftIds
            $shiftDetail->create(
                [
                    'doctor_id' => $doctor->id,
                    'shift_id' => $selectedShiftIds[$index % count($selectedShiftIds)]
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

        // Assuming the input name is 'shifts[]'
        $selectedShiftIds = $request->input('shifts');
        // Lấy danh sách tất cả các bản ghi ShiftDetail có cùng doctor_id
        $shiftDetails = ShiftDetail::where('doctor_id', $doctor->id)->get();

        if($shiftDetails){
            foreach ($shiftDetails as $index => $shiftDetail) {
                $doctorShift = [];
                $doctorShift = Arr::add($doctorShift, 'doctor_id', $doctor->id);
                $doctorShift = Arr::add($doctorShift, ['shift_id' => $selectedShiftIds[$index % count($selectedShiftIds)]]);
                ShiftDetail::create($doctorShift);
            }
        }

        foreach ($shiftDetails as $index => $shiftDetail) {
            // Cập nhật shift_id cho mỗi bản ghi với giá trị tương ứng trong mảng $selectedShiftIds
            $shiftDetail->update(['shift_id' => $selectedShiftIds[$index % count($selectedShiftIds)]]);
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

//        return Redirect::route('admin.doctor');
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
