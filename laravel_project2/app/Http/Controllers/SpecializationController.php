<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSpecializationRequest;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;

class SpecializationController extends Controller
{
    public function index(){
        $specialization = Specialization::get()->sortBy('id')->all();;

        return view('admin.specialization_manage.index', [
                'specialization' => $specialization
            ]);
    }

    public function create(){
        return view('admin.specialization_manage.create');
    }

    public function store(Request $request){

        $array = [];
        $array = Arr::add($array, 'name', $request->name);
        //Lấy dữ liệu từ form và lưu lên db
        Specialization::create($array);

        return Redirect::route('specialization.index');
    }

    public function edit(Specialization $specialization, Request $request)
    {
        //Gọi đến view để sửa
        return view('admin.specialization_manage.edit', [
            'specialization' => $specialization,
        ]);
    }

    public function update(UpdateSpecializationRequest $request, Specialization $specialization)
    {
        //Lấy dữ liệu trong form và update lên db
        $array = [];
        $array = Arr::add($array, 'name', $request->name);

        $specialization->update($array);

        return Redirect::route('specialization.index');
    }

    public function destroy(Specialization $specialization)
    {
        $specialization->delete();
        return Redirect::route('specialization.index');

    }
}
