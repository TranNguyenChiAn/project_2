<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SpecializationController;

use App\Models\Doctor;
use App\Models\Gender;
use App\Models\Specialization;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

use App\Requests\UpdateDoctorRequest;
use App\Requests\StoreDoctorRequest;


class DoctorController extends Controller
{
    public function index() {
        $genders = Gender::all();
        $specialization = Specialization::all();

        $doctors = Doctor::with('specialization')
        ->with('gender')
        ->get();


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
     * @param  \App\Requests\StoreDoctorRequest $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request){

        $array = [];
        $array = Arr::add($array, 'name', $request->name);
        $array = Arr::add($array, 'email', $request->email);
        $array = Arr::add($array, 'password', $request->password);
        $array = Arr::add($array, 'gender_id', $request->gender_id);
        $array = Arr::add($array, 'specialization_id', $request->specialization_id);
        $array = Arr::add($array, 'contact_number', $request->contact_number);
        $array = Arr::add($array, 'address', $request->address);
            //Lấy dữ liệu từ form và lưu lên db
        Doctor::create($array);

        return Redirect::route('doctor');
    }

    public function edit(Doctor $doctor, Request $request)
    {
        $specialization = Specialization::all();
        //Gọi đến view để sửa
        return view('admin.doctor_manage.edit', [
            'doctor' => $doctor,
            'specialization' => $specialization,
        ]);
    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        //Lấy dữ liệu trong form và update lên db
        $array = [];
        $array = Arr::add($array, 'name', $request->name);
        $array = Arr::add($array, 'email', $request->email);
        $array = Arr::add($array, 'specialization', $request->specialization);
        $array = Arr::add($array, 'contact_number', $request->contact_number);
        $array = Arr::add($array, 'address', $request->address);

        $doctor->update($array);

        return Redirect::route('doctor');
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return Redirect::route('doctor')->with('success', 'Delete a doctor successfully!');

    }


}
