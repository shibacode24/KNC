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
        Schema::create('raw_material', function (Blueprint $table) {
            $table->id();
            $table->string('material_name');
            $table->string('unit');
            $table->unsignedInteger('minimum_keeping_quantity');
            $table->unsignedInteger('maximum_keeping_quantity');
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