<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tenant;
use Illuminate\Support\Str;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tenant::create([
            'id_card_number' => Str::random(16),
            'user_id' => '2',
            'password' => '55556666',
            'name' => 'Adolf Hitler',
            'born_date' => '11/11/1998',
            'gender' => 'male',
            'address' => 'desa copryan - kecamatan buaran',
            'regional_id' => '1'
        ]);
        Tenant::create([
            'id_card_number' => Str::random(16),
            'user_id' => '3',
            'password' => '34243321',
            'name' => 'Joeseph Stallin',
            'born_date' => '10/10/2006',
            'gender' => 'male',
            'address' => 'desa kalibeber - kec mojotengah',
            'regional_id' => '2'
        ]);
    }
}
