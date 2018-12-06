<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class PersonalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $orders = \Auth::user()->orders()->whereDate('datetime', '>', Carbon::now())->orderby("datetime")->get();
        
        return view('personal.orders', [
            "orders" => $orders
        ]);
    }
}
