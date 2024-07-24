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
        Schema::create('attendance_supervisor', function (Blueprint $table) {
            $table->id();
            $table->string('supervisor_id');
            $table->string('date');
            $table->string('checkin_time');
            $table->string('checkout_time');

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
