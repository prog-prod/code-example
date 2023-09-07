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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('autoplay')->default(true);
            $table->string('lazyLoad')->default('progressive');
            $table->string('autoplay_speed')->nullable(7500);
            $table->integer('speed')->default(100);
            $table->boolean('pause_on_focus')->default(false);
            $table->boolean('pause_on_hover')->default(false);
            $table->boolean('infinite')->default(true);
            $table->boolean('arrows')->default(true);
            $table->boolean('dots')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
