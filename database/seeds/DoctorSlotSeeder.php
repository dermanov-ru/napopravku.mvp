<?php

use Illuminate\Database\Seeder;

class DoctorSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doctor_slots')->truncate();
        
        $doctors = \App\Doctor::all();
        $startTime = 3600 * 8; // "8:00";
        $finishTime = 3600 * 20.5; // "20:30";
        $step = 1800; // 0.5 hour;
        $days = 31;
    
        foreach ( $doctors as $doctor ) {
            for ($day = 0; $day < $days; $day++){
                $slotDate = date('y-m-d ', strtotime("+ {$day} days"));
                
                for ($slotTime = $startTime; $slotTime <= $finishTime; $slotTime += $step){
                    $slotHours = intval($slotTime / 3600);
                    $slotMinuts = $slotTime % 3600;
                    $slotMinuts = $slotMinuts ? 60 * $slotMinuts / 3600 : 0;
                    $slotDateTime = date('y-m-d H:i:s', strtotime($slotDate . "$slotHours:$slotMinuts"));
                    
                    // этим флагом можно регулировать (в ЛК доктора), когда доктор работает
                    // также, по мере записи к врачу - это поле будет "занято"
                    $is_free = rand(1, 0);
                    
                    $slot = [
                        "doctor_id" => $doctor->id,
                        "datetime" => $slotDateTime,
                        "is_free" => $is_free,
                    ];
                    DB::table('doctor_slots')->insert($slot);
                }
            }
        }
    }
}
