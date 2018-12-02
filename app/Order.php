<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user(  )
    {
        return $this->hasOne('App\User');
    }
    
    public function doctor(  )
    {
        return $this->hasOne('App\Doctor');
    }
    
    public function doctorSlot(  )
    {
        return $this->hasOne('App\DoctorSlot');
    }
    
    public function service(  )
    {
        return $this->hasOne('App\Service');
    }
}
