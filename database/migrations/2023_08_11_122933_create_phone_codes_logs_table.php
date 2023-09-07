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
        Schema::create('phone_codes_logs', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('code');
            $table->string('ip')->nullable();
            $table->jsonb('location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phone_codes_logs');
    }
};
