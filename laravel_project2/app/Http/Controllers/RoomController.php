<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;

class RoomController extends Controller
{
    public function index(){
        $rooms = Room::paginate(5);
        return view('admin.room_manage.index', [
            'rooms' => $rooms
        ]);
    }

    public function create(){
        $room  = Room::all();
        return view('admin.room_manage.create', [
            'room' => $room
        ]);
    }

    public function store(Request $request){

        $array = [];
        $array = Arr::add($array, 'floor', $request->floor);
        $array = Arr::add($array, 'room_name', $request->room_name);
        Room::create($array);

        return Redirect::route('room.index');
    }

    public function edit(Room $room, Request $request)
    {
        //Gọi đến view để sửa
        return view('admin.room_manage.edit', [
            'room' => $room,
        ]);
    }

    public function update(Request $request, Room $room){
        $array = [];
        $array = Arr::add($array, 'floor', $request->floor);
        $array = Arr::add($array, 'room_name', $request->room_name);
        $room -> update($array);
        return Redirect::route('room.index');
    }

    public function destroy(Room $room){
        $room->delete();
        return Redirect::route('room.index')->with('success', 'Delete room successfully!');
    }
}
