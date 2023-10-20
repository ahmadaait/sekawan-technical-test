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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger("company_id")->nullable();
            $table->string('license_plate');
            $table->enum('status', ["available", "unavailable"])->default("available");
            $table->enum('ownership_type', ["owned_by_company", "rented_from_another"])->default("owned_by_company");
            $table->enum('load_type', ["person", "item"])->default("person");
            $table->integer('fuel_tank')->default(0);
            $table->date('service_schedule');
            $table->timestamps();

            $table->foreign("company_id")->references("id")->on("companies");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
