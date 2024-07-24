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
        Schema::create('grn', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('order_id');
            $table->string('vendor_id');
            $table->string('material_id');
            $table->string('brand_id');
            $table->string('quantity');
            $table->string('delivery_location');
            $table->string('received_by');
            $table->string('remark');
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
