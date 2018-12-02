<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            [
                'name' => "Вызов врача на дом",
            ],
            
            [
                'name' => "Удаление зуба",
            ],
            
            [
                'name' => "Блефаропластика",
            ],
            
            [
                'name' => "Лечение кариеса",
            ],
            
            [
                'name' => "Коронки на зубы",
            ],
            
            
            [
                'name' => "Отбеливание zoom",
            ],
            
            
            [
                'name' => "ЭКО",
            ],
            
            [
                'name' => "Ринопластика",
            ],
            
            [
                'name' => "Удаление папиллом",
            ],
            
            [
                'name' => "Вызов детского врача / педиатра на дом",
            ],

        ];
    
        DB::table('services')->truncate();
        foreach ( $services as $service ) {
            DB::table('services')->insert($service);
        }
    }
}
