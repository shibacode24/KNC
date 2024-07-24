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
        Schema::create('issue_material_by_inventory', function (Blueprint $table) {
            $table->id();
            $table->string('requested_material_id');
            $table->string('material_id');
            $table->string('brand_id');
            $table->string('requested_material_quantity');
            $table->string('material_unit_id');
            $table->string('selected_warehouse_id');
            $table->string('available_material');
            $table->string('issue_material');
            $table->string('remaining_material');
            $table->string('remark');
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
