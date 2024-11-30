<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->unsignedBigInteger('car_id')->nullable();
            $table->enum('status', ['pending payment','pending confirm','confirmed','renting','canceled','pending to return','returned']);
            $table->enum('driver', ['car_only','with_driver']);
            $table->date('start_rent')->default(now());
            $table->date('end_rent');
            $table->integer('duration');
            $table->integer('unit');
            $table->integer('total_price');
            $table->string('snap_token');
            // $table->unsignedBigInteger('payment_service_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
