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
                'name' => "Бесарион Джумберович",
                'photo_url' => "https://napopravku.ru/upload/resize_cache/iblock/24e/284_284_6/24ef8a21528b2ea8ebe7b7f91ba221d4.png",
                'exp_years' => 30,
            ],
            
            [
                'name' => "Александр Николаевич",
                'photo_url' => "https://napopravku.ru/upload/resize_cache/iblock/be1/284_284_6/be1f7fe830a51e0f1d5b62b119bb59b5.jpg",
                'exp_years' => 10,
            ],
            
            [
                'name' => "Евгения Евгеньевна",
                'photo_url' => "https://napopravku.ru/upload/resize_cache/iblock/b64/284_284_6/b64fbdfedf482acfbe7e7e4af1bd9d87.jpg",
                'exp_years' => 10,
            ],
            
            [
                'name' => "Юлия Александровна",
                'photo_url' => "https://napopravku.ru/upload/resize_cache/iblock/0f4/284_284_6/0f4d0e2b2da04d51f8a9324f613c6af4.jpg",
                'exp_years' => 10,
            ],
            
            [
                'name' => "Игорь Николаевич",
                'photo_url' => "https://napopravku.ru/upload/resize_cache/iblock/54e/284_284_6/54e338950ae4fb7ef68e91114e1fb255.jpg",
                'exp_years' => 20,
            ],
            
            [
                'name' => "Леонид Владимирович",
                'photo_url' => "https://napopravku.ru/upload/resize_cache/iblock/3cb/284_284_6/3cbbb7233c81df592de7e771ef84c83e.jpg",
                'exp_years' => 10,
            ],
            
            //[
            //    'name' => "XXX",
            //    'photo_url' => "XXXX",
            //    'exp_years' => 10,
            //],
            
        ];
    
        DB::table('doctors')->truncate();
        for ($i = 0; $i < 3; $i++){
            foreach ( $doctors as $doctor ) {
                $doctor["name"] .= ", вариант " . $i;
                DB::table('doctors')->insert($doctor);
            }
        }
    }
}
