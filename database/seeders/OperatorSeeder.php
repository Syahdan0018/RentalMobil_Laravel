<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\operator;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        operator::create([
            'car_id' => '1',
            'user_id' => '1',
            'role' => 'administrator',
            'name' => 'Syahdan Farisqi'
        ]);
        operator::create([
            'car_id' => '2',
            'user_id' => '1',
            'role' => 'administrator',
            'name' => 'Syahdan Farisqi'
        ]);
        operator::create([
            'car_id' => '3',
            'user_id' => '1',
            'role' => 'administrator',
            'name' => 'Syahdan Farisqi'
        ]);
        operator::create([
            'car_id' => '4',
            'user_id' => '1',
            'role' => 'administrator',
            'name' => 'Syahdan Farisqi'
        ]);
        operator::create([
            'car_id' => '5',
            'user_id' => '1',
            'role' => 'administrator',
            'name' => 'Syahdan Farisqi'
        ]);
    }
}
