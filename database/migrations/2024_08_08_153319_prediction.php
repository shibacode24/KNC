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

        Schema::create('prediction', function (Blueprint $table) {
            $table->id();
            $table->string('category_id');
            $table->string('sub_category_id');
            $table->string('min_measurement_of_unit');
            $table->string('working_unit_type_id');
            $table->string('hours_of_completion');

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
