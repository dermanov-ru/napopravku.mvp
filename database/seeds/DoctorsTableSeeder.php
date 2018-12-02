<?php

use Illuminate\Database\Seeder;

class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctors = [
            [
                'name' => "Гаприндашвили Бесарион Джумберович",
                'photo_url' => "https://napopravku.ru/doctor-profile/gaprindashvili-besarion-dzhumberovich-osteopat/",
                'exp_years' => 30,
            ],
            
            [
                'name' => "Подолянский Александр Николаевич",
                'photo_url' => "https://napopravku.ru/doctor-profile/podolyanskiy-aleksandr-nikolaevich-osteopat/",
                'exp_years' => 10,
            ],
            
            [
                'name' => "Шадрина Евгения Евгеньевна",
                'photo_url' => "https://napopravku.ru/doctor-profile/shadrina-evgeniya-evgenevna-manualnyj-terapevt/",
                'exp_years' => 10,
            ],
            
            [
                'name' => "Павлинова (Живова) Юлия Александровна",
                'photo_url' => "https://napopravku.ru/doctor-profile/zhivova-yuliya-aleksandrovna-nevrolog/",
                'exp_years' => 10,
            ],
            
            [
                'name' => "Салмин Игорь Николаевич",
                'photo_url' => "https://napopravku.ru/doctor-profile/salmin-igor-nikolaevich-osteopat/",
                'exp_years' => 20,
            ],
            
            [
                'name' => "Александров Леонид Владимирович",
                'photo_url' => "https://napopravku.ru/doctor-profile/aleksandrov-leonid-vladimirovich-osteopat/",
                'exp_years' => 10,
            ],
            
            //[
            //    'name' => "XXX",
            //    'photo_url' => "XXXX",
            //    'exp_years' => 10,
            //],
            
        ];
    
        DB::table('doctors')->truncate();
        foreach ( $doctors as $doctor ) {
            DB::table('doctors')->insert($doctor);
        }
    }
}
