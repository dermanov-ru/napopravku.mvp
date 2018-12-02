<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with("doctors")->orderBy("name")->get();
        
        return view('services', [
            "services" => $services
        ]);
    }
}
