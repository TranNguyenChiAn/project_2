<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSpecializationRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;

class DepartmentController extends Controller
{
    public function index(){
        $departments = Department::paginate(5);

        return view('admin.department_manage.index', [
            'departments' => $departments
        ]);
    }

    public function create(){
        return view('admin.department_manage.create');
    }

    public function store(Request $request){

        $array = [];
        $array = Arr::add($array, 'name', $request->name);
        //Lấy dữ liệu từ form và lưu lên db
        Department::create($array);

        return Redirect::route('department.index');
    }

    public function edit(Department $department, Request $request)
    {
        //Gọi đến view để sửa
        return view('admin.department_manage.edit', [
            'department' => $department,
        ]);
    }

    public function update(UpdateSpecializationRequest $request, Department $department)
    {
        //Lấy dữ liệu trong form và update lên db
        $array = [];
        $array = Arr::add($array, 'name', $request->name);

        $department->update($array);

        return Redirect::route('department.index');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return Redirect::route('department.index');

    }
}
