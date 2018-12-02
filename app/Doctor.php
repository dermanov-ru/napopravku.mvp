<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    public $slots = null;
    
    public function services(  )
    {
        return $this->belongsToMany('App\Service', "doctor_services")->withPivot('price');
    }
    
    /**
     * Получает слоты для записи на ближайшие дни.
     *
     * @param $toDays - кол-во ближайших дней.
     *                $toDays = 0 - получить слоты только на сегодня.
     * */
    public function loadSlots( $toDays )
    {
        $from = date("y-m-d 00:00:00");
        $to = date('y-m-d 23:59:59', strtotime("+ $toDays days"));
        
        $this->slots = DoctorSlot::where("doctor_id", $this->id)
            ->whereBetween('datetime', [$from , $to ])
            ->orderBy("id")
            ->get();
    }
    
    public function slotsByDate(  )
    {
        $slots = $this->slots;
        $result = [];
    
        foreach ( $slots as $slot ) {
            $result[ $slot->date() ][] = $slot;
        }
        
        return $result;
    }
}
