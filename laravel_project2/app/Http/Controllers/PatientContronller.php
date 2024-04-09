<?php

namespace App\Http\Controllers;

use App\Models\Patient;

class PatientContronller
{
    public function index(){
        $patients = Patient::paginate(5);
        return view('admin.patient_manage.index', [
            'patients' => $patients
        ]);
    }

    public function edit(Patient $patient){
        $patients = Patient::all();
        return view('admin.patient_manage.edit', [
            'patients' => $patients
        ]);
    }

    public function update(){
        $patients = Patient::all();
        return view('admin.patient_manage.index', [
            'patients' => $patients
        ]);
    }


}