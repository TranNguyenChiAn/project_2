<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Gender;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use PhpParser\Comment\Doc;
use App\Requests\UpdateDoctorRequest;
use App\Requests\StoreDoctorRequest;

class DoctorController extends Controller
{
    public function index() {
        $doctors = Doctor::with('specialization')->get();

        return view('admin.doctor_manage.index', [
            'doctors' => $doctors
        ]);
    }

    public function create() {
        $genders = Gender::all();

        return view('admin.doctor_manage.create',[
            'genders' => $genders
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Requests\StoreDoctorRequest $request
     * @return \Illuminate\Http\Response
     */

    public function store(StoreDoctorRequest $request) {
        if($request->validated()){
            $array = [];
            $array = Arr::add($array, 'name', $request->name);
            $array = Arr::add($array, 'email', $request->email);
            $array = Arr::add($array, 'email', $request->gender);
            $array = Arr::add($array, 'contact_number', $request->contact_number);
            $array = Arr::add($array, '', $request->address);

            //Lấy dữ liệu từ form và lưu lên db
            Doctor::create($array);
            //Hiển thị thông báo thêm không thành công (error)
            flash()->addSuccess('Them thanh cong');
            //Quay lại danh sá ch
            return Redirect::route('doctor');
        } else {
            flash()->addError('Them khong thanh cong');
            return Redirect::back();
        }

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
