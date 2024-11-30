<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\regional;

class RegionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        regional::create([
            'province' => 'jawa tengah',
            'district' => 'pekalongan'
        ]);
        regional::create([
            'province' => 'Jawa Tengah',
            'district' => 'wonosobo'
        ]);
    }
}
