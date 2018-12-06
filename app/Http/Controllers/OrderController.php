<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\DoctorSlot;
use App\Order;
use App\Service;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function order(Request $request)
    {
        $log = Log::channel( "orders_make" );
        $userId = Auth::id();
        
        $output = [
            "success" => true,
            "msg" => "",
            "more" => [
            ],
        ];
        
        
        // validate inputs
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|integer',
            'slot_id' => 'required|integer',
            'service_id' => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            $output["success"] = false;
            $output["msg"] = "Неверно указаны данные для записи.";
    
            $log->critical("wrong data selected on frontend", [
                'user_id' => $userId,
                '\request()->all()' => \request()->all(),
            ]);
            
            return response()->json($output);
        }
    
        
        // check incoming data consistence
        try {
            $doctor = Doctor::findOrFail($request->doctor_id);
            $doctorService = $doctor->services()->where('service_id', $request->service_id)->firstOrFail();
            $slot = DoctorSlot::where([
                [ 'id', $request->slot_id ],
                [ 'doctor_id', $request->doctor_id ],
            ])->firstOrFail();
        }
        // hacker detected :)
        catch (ModelNotFoundException $exception){
            $output["success"] = false;
            $output["msg"] = "Неверно указаны данные для записи.";
            
            $log->alert("order params is not consistent. posible hacked detected.", [
                'user_id' => $userId,
                '\request()->all()' => \request()->all(),
                '$exception' => $exception
            ]);
    
            return response()->json($output);
        }
    
        // check slot steel free
        if (!$slot->is_free) {
            $output["success"] = false;
            $output["msg"] = "К сожалению, кто-то уже записался на это время :( Выберите другое время, пожалуйста.";
            $output["more"]["slot_is_not_free"] = true;
        
            return response()->json($output);
        }
    
        
        // make order
        $order = new \App\Order();
        $order->user_id = $userId;
        $order->doctor_id = $request->doctor_id;
        $order->slot_id = $request->slot_id;
        $order->service_id = $request->service_id;
        $order->price = $doctorService->pivot->price;
        $order->datetime = $slot->datetime;
    
        $slot->is_free = 0;
    
        try {
            DB::transaction(function () use ($slot, $order) {
                $slot->save();
                $order->save();
            }, 5);
        }
        catch (\Exception $exception){
            $output["success"] = false;
            $output["msg"] = "Не удалось выполнить запись к доктору :( Попробуйте повторить запрос позже.";
            
            $log->critical("error while save order transaction", [
                'user_id' => $userId,
                '\request()->all()' => \request()->all(),
                '$exception' => $exception
            ]);
        
            return response()->json($output);
        }
    
        $output["more"]["order_id"] = $order->id;
    
        
        return response()->json($output);
    }
    
    public function cancel($id)
    {
        $log = Log::channel( "orders_cancel" );
        $userId = Auth::id();
        
        
        // check incoming data consistence
        try {
            $order = Order::where([
                [ "id", $id ],
                [ "user_id", $userId ],
            ])->firstOrFail();
            $slot = DoctorSlot::findOrFail($order->slot_id);
        }
        // hacker detected :)
        catch (ModelNotFoundException $exception){
            $log->alert("order params is not consistent. posible hacked detected.", [
                'user_id' => $userId,
                '\request()->all()' => \request()->all(),
                '$exception' => $exception
            ]);
    
            return back();
        }
    
        $slot->is_free = 1;
    
        try {
            DB::transaction(function () use ($slot, $order) {
                $order->delete();
                $slot->save();
            }, 5);
        }
        catch (\Exception $exception){
            $log->critical("error while save order transaction", [
                'user_id' => $userId,
                '\request()->all()' => \request()->all(),
                '$exception' => $exception
            ]);
    
            return back();
        }
    
        
        return back();
    }
}
