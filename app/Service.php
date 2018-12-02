<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function doctors(  )
    {
        return $this->belongsToMany('App\Doctor', "doctor_services")->withPivot('price');
    }
}
