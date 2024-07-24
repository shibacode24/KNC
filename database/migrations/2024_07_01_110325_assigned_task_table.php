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
        Schema::create('assigned_task', function (Blueprint $table) {
            $table->id();
            $table->string('site_id');
            $table->string('subcategory_id');
            $table->string('contractor_id');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('total_work');
            $table->string('work_unit_type_id');
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
