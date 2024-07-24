<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('supervisor', function (Blueprint $table) {
            $table->id();
            $table->string('supervisor_name');
            $table->string('email')->unique();
            $table->string('mobile_number');
            $table->string('aadhar_number')->unique();
            $table->string('pan_number')->unique();
            $table->string('city_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};