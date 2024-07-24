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
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('firm_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('city_id');

            $table->string('site_name');
            $table->integer('site_personal_or_buisness');

            $table->string('mobile_number');
            $table->string('city_address');
            $table->double('latitude');
            $table->double('longitude');
            $table->text('site_description');
            $table->text('site_documents');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('firm_id')->references('id')->on('firm');
            $table->foreign('client_id')->references('id')->on('client');
            $table->foreign('city_id')->references('id')->on('city');

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