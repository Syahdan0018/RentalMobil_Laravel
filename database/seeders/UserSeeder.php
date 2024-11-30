<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Syahdan Farisqi',
            'email' => 'bosjerukasem@gmail.com',
            'username' => 'haha',
            'password' => '12345678',
            'role' => 'Operator',
            'remember_token' => Str::random(10)
        ]);
        User::create([
            'name' => 'Adolf Hitler',
            'email' => 'haha@gmail.com',
            'username' => 'german',
            'password' => '55556666',
            'role' => 'Tenant',
            'remember_token' => Str::random(10)
        ]);
        User::create([
            'name' => 'Joeseph Stallin',
            'email' => 'soviet@gmail.com',
            'username' => 'komunis',
            'password' => '34243321',
            'role' => 'Tenant'
        ]);
    }
}
