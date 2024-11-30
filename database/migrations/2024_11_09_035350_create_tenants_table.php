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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->char('id_card_number', 16);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('password', 255);
            $table->string('name', 255);
            $table->date('born_date')->nullable();
            $table->enum('gender',['male','female','unknown'])->default('unknown');
            $table->text('address')->nullable();
            $table->unsignedBigInteger('regional_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
