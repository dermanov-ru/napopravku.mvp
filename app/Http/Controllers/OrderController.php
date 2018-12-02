<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\DoctorSlot;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|integer',
            'slot_id' => 'required|integer',
            'service_id' => 'required|integer',
        ]);
        
        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }
    
        Service::findOrFail($request->service_id);
    
        $slot = DoctorSlot::findOrFail($request->slot_id);
        // TODO check that slot still is free or fail
        $slot->is_free = 0;
        $slot->save();
    
        $doctorService = Doctor::findOrFail($request->doctor_id)->services()->where('service_id', $request->service_id)->first();
    
        $order = new \App\Order();
        $order->user_id = 1; // TODO get current
        $order->doctor_id = $request->doctor_id;
        $order->slot_id = $request->slot_id;
        $order->service_id = $request->service_id;
        $order->price = $doctorService->pivot->price;
        $order->datetime = $slot->datetime();
        $order->save();
    
        return back()->with('order_done', true);
    }
}
