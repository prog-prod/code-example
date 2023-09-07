<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
//        Schema::create('categorizables', function (Blueprint $table) {
//            $table->id();
//            $table->morphs('categorizable');
//            $table->foreignId('category_id')->constrained()->onDelete('cascade');
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        Schema::dropIfExists('categorizables');
    }
};
