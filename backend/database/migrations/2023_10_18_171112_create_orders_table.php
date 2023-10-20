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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("driver_id");
            $table->unsignedBigInteger("vehicle_id");
            $table->unsignedBigInteger("mine_id");

            $table->timestamp("start_date")->nullable();
            $table->timestamp("return_date")->nullable();

            $table->unsignedBigInteger("req_pic_1")->nullable();
            $table->unsignedBigInteger("approval_pic_1")->nullable();
            $table->timestamp("approval_pic_1_at")->nullable();

            $table->unsignedBigInteger("req_pic_2")->nullable();
            $table->unsignedBigInteger("approval_pic_2")->nullable();
            $table->timestamp("approval_pic_2_at")->nullable();

            $table->unsignedBigInteger("rejected_by")->nullable();
            $table->timestamp("rejected_at")->nullable();

            $table->timestamp("release_at")->nullable();
            $table->timestamp("return_at")->nullable();

            $table->unsignedBigInteger("created_by")->nullable();

            $table->unsignedBigInteger("canceled_by")->nullable();
            $table->timestamp("canceled_at")->nullable();

            $table->string("status");

            $table->timestamps();

            $table->foreign("driver_id")->references("id")->on("drivers");
            $table->foreign("vehicle_id")->references("id")->on("vehicles");
            $table->foreign("mine_id")->references("id")->on("mines");
            $table->foreign("req_pic_1")->references("id")->on("users");
            $table->foreign("approval_pic_1")->references("id")->on("users");
            $table->foreign("req_pic_2")->references("id")->on("users");
            $table->foreign("approval_pic_2")->references("id")->on("users");
            $table->foreign("rejected_by")->references("id")->on("users");
            $table->foreign("created_by")->references("id")->on("users");
            $table->foreign("canceled_by")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
