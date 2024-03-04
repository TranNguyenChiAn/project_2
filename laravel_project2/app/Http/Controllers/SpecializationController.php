<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    public function index(){
        $specialization = Specialization::get()->sortBy('id')->all();;

        return view('admin.specialization_manage.index', [
                'specialization' => $specialization
            ]);
    }
}
