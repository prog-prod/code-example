<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slider_id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('before_title')->nullable();
            $table->string('title')->nullable();
            $table->string('after_title')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('use_product_image')->default(false);
            $table->json('action_btn')->nullable();
            $table->json('animation')->nullable();
            $table->string('bg_letter')->nullable();
            $table->foreign('slider_id')->references('id')->on('sliders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slides');
    }
};
