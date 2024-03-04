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

use PhpParser\Comment\Doc;

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

    public function store(Doctor $doctors, Request $request){
        $doctor = new Doctor();
        $doctor->name = $request->name; 
        $doctor-> email = $request->email;
        $doctor->gender_id = $request->gender->id;
        $doctor->specialization_id = $request->specialization->id;
        $doctor->contact_number = $request->contact_number;

        $doctors->save();

        return view('admin.products_manage.index',[
            'doctors' => $doctors
        ]);
    }

    public function edit(Doctor $doctor, Request $request)
    {
        //Gọi đến view để sửa
        return view('admin.doctor_manage.edit', [
            'doctor' => $doctor
        ]);
    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        //Lấy dữ liệu trong form và update lên db
        $array = [];
        $array = Arr::add($array, 'name', $request->name);
        $array = Arr::add($array, 'email', $request->email);
        $array = Arr::add($array, 'email', $request->gender);
        $array = Arr::add($array, 'specialization', $request->specialization);
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
