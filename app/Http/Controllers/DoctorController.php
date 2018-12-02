<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\DoctorSlot;
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
        $doctor = Doctor::with([ "services" ])->findOrFail($id);
        $doctor->loadSlots(4);
        
        return view('doctor', [
            "doctor" => $doctor
        ]);
    }
}
