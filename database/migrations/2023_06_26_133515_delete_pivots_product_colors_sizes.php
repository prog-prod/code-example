<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('product_colors');
        Schema::dropIfExists('product_size');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
