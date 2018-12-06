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
        for ($i = 0; $i < 10; $i++){
            foreach ( $services as $service ) {
                $service["name"] .= ", вариант " . $i;
                DB::table('services')->insert($service);
            }
        }
    }
}
