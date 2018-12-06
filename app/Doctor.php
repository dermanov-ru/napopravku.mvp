<?php

namespace App;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use Cachable;
    
    public $timestamps = false;
    public $slots = null;
    
    
    protected $appends = ['slots_by_date'];
    
    public function getSlotsByDateAttribute()
    {
        return $this->attributes['slots_by_date'] = $this->slotsByDate();
    }
    
    public function services(  )
    {
        return $this->belongsToMany('App\Service', "doctor_services")->withPivot('price');
    }
    
    /**
     * Получает слоты для записи на ближайшие дни, начиная с завтрашнего дня.
     *
     * @param $toDays - кол-во ближайших дней.
     * */
    public function loadSlots( $toDays )
    {
        $from = date("y-m-d 00:00:00", strtotime("+ 1 days"));
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
