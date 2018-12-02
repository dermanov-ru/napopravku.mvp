<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    public function services(  )
    {
        return $this->belongsToMany('App\Service', "doctor_services")->withPivot('price');
    }
}
