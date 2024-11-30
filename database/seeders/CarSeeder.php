<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Car::create([
        //     'regional_id' => '1',
        //     'car_name' => 'Innova2016',
        //     'address' => 'jl samirejo no 6 buaran',
        //     'number_of_car' => '5',
        //     'price' => '400000',
        //     'picture' => 'Innova2016.jpg'
        // ]);
        // Car::create([
        //     'regional_id' => '1',
        //     'car_name' => 'Avanza',
        //     'address' => 'jl samirejo no 6 buaran',
        //     'number_of_car' => '5',
        //     'price' => '400000',
        //     'picture' => 'Avanza.jpg'
        // ]);
        // Car::create([
        //     'regional_id' => '1',
        //     'car_name' => 'Modellista',
        //     'address' => 'jl samirejo no 6 buaran',
        //     'number_of_car' => '7',
        //     'price' => '400000',
        //     'picture' => 'Modellista.png'
        // ]);
        // Car::create([
        //     'regional_id' => '2',
        //     'car_name' => 'Alphard',
        //     'address' => 'jl jawar km01 mojotengah',
        //     'number_of_car' => '4',
        //     'price' => '400000',
        //     'picture' => 'Alphard.jpg'
        // ]);
        // Car::create([
        //     'regional_id' => '2',
        //     'car_name' => 'McLaren',
        //     'address' => 'krasak mojotengah',
        //     'number_of_car' => '2',
        //     'price' => '400000',
        //     'picture' => 'McLaren.jpg'
        // ]);
        Car::factory(1)->create();
    }
}
