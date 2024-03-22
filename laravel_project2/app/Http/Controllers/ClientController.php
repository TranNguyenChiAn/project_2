<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Gender;
use App\Models\Specialization;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $genders = Gender::all();
        $specialization = Specialization::all();

        $doctors = Doctor::with('specialization')
            ->with('gender')
            ->orderBy('id', 'desc')
            ->get();


        return view('customer.homepage.index', [
            'doctors' => $doctors,
            'genders' => $genders,
            'specialization' => $specialization
        ]);
    }

    public function appointmentForm()
    {
        $genders = Gender::all();
        $specialization = Specialization::all();
        return view('customer.appointment.form', [
            'genders' => $genders,
            'specialization' => $specialization
        ]);
    }


}
