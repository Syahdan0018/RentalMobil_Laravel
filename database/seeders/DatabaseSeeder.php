<?php

namespace Database\Seeders;

use App\Models\operator;
use App\Models\regional;
use App\Models\User;
use App\Models\Tenant;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(RegionalSeeder::class);
        // $this->call(CarSeeder::class);
        // $this->call(OperatorSeeder::class);
        $this->call(TenantSeeder::class);
        // $this->call(OrderSeeder::class);
        // $this->call(PaymentServiceSeeder::class);
    }
}
