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
            $table->string('store_name');
            $table->string('branch');
            $table->string('full_name');
            $table->string('sex');
            $table->string('phone_number');
            $table->string('utility');
            $table->string('mode_of_payment');
            $table->string('amount_of_payment');
            $table->string('complete_address');
            $table->string('start_date')->nullable();
            $table->string('start_time')->nullable();
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
