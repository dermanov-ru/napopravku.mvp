<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorSlot extends Model
{
    public $timestamps = false;
    
    protected $appends = [
        'date',
        'time',
    ];
    
    public function getDateAttribute()
    {
        return $this->attributes['date'] = $this->date();
    }
    
    public function getTimeAttribute()
    {
        return $this->attributes['time'] = $this->time();
    }
    
    public function date(  )
    {
        $timestamp = strtotime( $this["datetime"] );
        // TODO get russian name
        $shortDayOfWeek = date("D", $timestamp );
        $date = $shortDayOfWeek . date(" d.m.y", $timestamp );
        
        return $date;
    }
    
    public function time(  )
    {
        $timestamp = strtotime( $this["datetime"] );
        $time = date("H:i", $timestamp );
        
        return $time;
    }
    
    public function datetime(  )
    {
        return $this->date() . " " . $this->time();
    }
}
