<?php

namespace App;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use Cachable;
    
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
