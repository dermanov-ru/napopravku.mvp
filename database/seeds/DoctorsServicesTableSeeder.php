<?php

use Illuminate\Database\Seeder;

class DoctorsServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctors = \App\Doctor::all();
        $services = \App\Service::all();
    
        DB::table('doctor_services')->truncate();
        foreach ( $doctors as $doctor ) {
            // each doctor will have 3 service
            for ($i = 0; $i < 5; $i++){
                $service = $services->random();
                $price = rand(1, 20) * 1000;
                $doctor->services()->attach($service, [ 'price' => $price ]);
            }
        }
    }
}
