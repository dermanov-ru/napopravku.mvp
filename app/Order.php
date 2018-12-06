<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user(  )
    {
        return $this->belongsTo('App\User');
    }
    
    public function doctor(  )
    {
        return $this->belongsTo('App\Doctor');
    }
    
    public function doctorSlot(  )
    {
        return $this->belongsTo('App\DoctorSlot');
    }
    
    public function service(  )
    {
        return $this->belongsTo('App\Service');
    }
}
