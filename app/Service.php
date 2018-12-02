<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $timestamps = false;
    
    public function doctors(  )
    {
        return $this->belongsToMany('App\Doctor', "doctor_services")->withPivot('price');
    }
}
