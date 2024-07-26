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
        Schema::create('engineer', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name');
            $table->string('email')->unique();
            $table->string('mobile_number');
            $table->string('aadhar_number')->unique();
            $table->string('pan_number')->unique();
            $table->string('city_id');
            $table->string('city_address');
            $table->string('account_holder');
            $table->string('bank_name');
            $table->string('account_number');
            $table->string('ifsc_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('engineer');
    }
};
