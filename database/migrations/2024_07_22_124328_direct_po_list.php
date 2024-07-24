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
        Schema::create('direct_po_list', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('time');
            $table->string('material_id');
            $table->string('quantity');
            $table->string('unit_type_id');
            $table->string('brand_id');
            $table->string('vendor_id');
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
