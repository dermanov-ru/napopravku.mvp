<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorSlot extends Model
{
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
}
