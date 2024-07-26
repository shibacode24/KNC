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
        Schema::create('direct_issue_material', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('time');
            $table->string('site_id');
            $table->string('supervisor_id');
            $table->string('warehouse_id');
            $table->string('material_id');
            $table->string('brand_id');
            $table->string('raw_material_id');
            $table->string('unit_id');
            $table->string('quantity');
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
