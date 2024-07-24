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
        Schema::create('add_material', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('material_id');
            $table->string('brand_id');
            $table->string('material_unit_id');
            $table->string('quantity');
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
