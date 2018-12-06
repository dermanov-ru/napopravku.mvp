<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->truncate();
        
        $this->call([
            DoctorsTableSeeder::class,
            ServicesTableSeeder::class,
            DoctorsServicesTableSeeder::class,
            DoctorSlotSeeder::class,
        ]);
    }
}
