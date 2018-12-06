<?php

namespace App;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use Cachable;
    
    public $timestamps = false;
    
    public function doctors(  )
    {
        return $this->belongsToMany('App\Doctor', "doctor_services")->withPivot('price');
    }
}
