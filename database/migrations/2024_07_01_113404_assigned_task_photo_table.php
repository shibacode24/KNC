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
        Schema::create('assigned_task_photo', function (Blueprint $table) {
            $table->id();
            $table->string('assigned_task_id');
            $table->string('photo');
            $table->timestamps();
        });     }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
