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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('type');
            $table->string('brand');
            $table->string('model');
            $table->integer('price');
            $table->integer('discount');
            $table->string('detail');
            $table->string('pro_image');
            $table->unsignedBigInteger('creater_id');
            $table->foreign('creater_id')->references('id')->on('users');
            $table->unsignedBigInteger('updater_id');
            $table->foreign('updater_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
