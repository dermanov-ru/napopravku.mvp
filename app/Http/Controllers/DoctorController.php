<?php

namespace App\Http\Controllers;

use App\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with("services")->orderBy("name")->get();

        return view('doctors', [
            "doctors" => $doctors
        ]);
    }
}
