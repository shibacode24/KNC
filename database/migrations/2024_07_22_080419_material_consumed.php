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
        Schema::create('material_consumed', function (Blueprint $table) {
            $table->id();
            $table->string('site_id');
            $table->string('workplace_id');
            $table->string('material_id');
            $table->string('raw_material_id');
            $table->string('consumed_quantity');

            $table->timestamps();
        });    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
