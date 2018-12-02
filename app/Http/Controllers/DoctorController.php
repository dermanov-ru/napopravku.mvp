<?php

namespace App\Http\Controllers;

use App\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function list()
    {
        $doctors = Doctor::with("services")->orderBy("name")->get();

        return view('doctors', [
            "doctors" => $doctors
        ]);
    }
    
    public function card($id)
    {
        $doctor = Doctor::findOrFail($id);

        return view('doctor', [
            "doctor" => $doctor
        ]);
    }
}
