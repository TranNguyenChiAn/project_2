<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;

class ShiftContronller
{
    public function index(){
        $shifts = Shift::paginate(5);
        return view('admin.shift_manage.index', [
            'shifts' => $shifts
        ]);
    }

    public function create(){
        $shift  = Shift::all();
        return view('admin.shift_manage.create', [
            'shift ' => $shift
        ]);
    }

    public function store(Request $request){

        $array = [];
        $array = Arr::add($array, 'start_time', $request->start_time);
        $array = Arr::add($array, 'end_time', $request->end_time);
        Shift::create($array);

        return Redirect::route('shift.index');
    }

    public function edit(Shift $shift, Request $request)
    {
        //Gọi đến view để sửa
        return view('admin.shift_manage.edit', [
            'shift' => $shift,
        ]);
    }

    public function update(Request $request, Shift $shift){
        $array = [];
        $array = Arr::add($array, 'start_time', $request->start_time);
        $array = Arr::add($array, 'end_time', $request->end_time);
        $shift -> update($array);
        return Redirect::route('shift.index');
    }

    public function destroy(Shift $shift){
        $shift->delete();
        return Redirect::route('shift.index')->with('success', 'Delete shift successfully!');
    }
}