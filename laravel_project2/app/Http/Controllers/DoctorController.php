<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Doctor;
use App\Models\Gender;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;


class DoctorController extends Controller
{
    public function index() {
        $genders = Gender::all();
        $specialization = Specialization::all();

        $doctors = Doctor::with('specialization')
        ->with('gender')
        ->orderBy('id','desc');


        return view('admin.doctor_manage.index', [
            'doctors' => $doctors,
            'genders' => $genders,
            'specialization' => $specialization
        ]);
    }

    public function create() {
        $genders = Gender::all();
        $specialization = Specialization::all();

        return view('admin.doctor_manage.create',[
            'genders' => $genders,
            'specialization' => $specialization
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDoctorRequest $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request){

        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);

        $array = [];
        $array = Arr::add($array, 'name', $request->name);
        $array = Arr::add($array, 'email', $request->email);
        $array = Arr::add($array, 'password', $request->password);
        $array = Arr::add($array, 'gender_id', $request->gender_id);
        $array = Arr::add($array, 'specialization_id', $request->specialization_id);
        $array = Arr::add($array, 'contact_number', $request->contact_number);
        $array = Arr::add($array, 'address', $request->address);
        $array = Arr::add($array, 'image', $imageName);

            //Lấy dữ liệu từ form và lưu lên db
        Doctor::create($array);

        return Redirect::route('doctor');
    }

    public function edit(Doctor $doctor, Request $request)
    {
        $genders = Gender::all();
        $specialization = Specialization::all();
        //Gọi đến view để sửa
        return view('admin.doctor_manage.edit', [
            'doctor' => $doctor,
            'specialization' => $specialization,
            'genders' => $genders
        ]);
    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();

        // Lưu ảnh vào thư mục public/images
        $image->move(public_path('images'), $imageName);

        //Lấy dữ liệu trong form và update lên db
        $array = [];
        $array = Arr::add($array, 'name', $request->name);
        $array = Arr::add($array, 'email', $request->email);
        $array = Arr::add($array, 'specialization', $request->specialization);
        $array = Arr::add($array, 'contact_number', $request->contact_number);
        $array = Arr::add($array, 'address', $request->address);
        $array = Arr::add($array, 'gender', $request->gender);

        $doctor->image = $imageName;
        $doctor->save();

        $doctor->update($array);

        return Redirect::route('doctor');
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return Redirect::route('doctor')->with('success', 'Delete a doctor successfully!');

    }


}
