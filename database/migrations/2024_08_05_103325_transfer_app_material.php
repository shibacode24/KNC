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

        Schema::create('transfer_app_material', function (Blueprint $table) {
            $table->id();
            $table->string('supervisor_id');
            $table->string('source_site_id');
            $table->string('dest_site_id');
            $table->string('dest_warehouse_id');
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
