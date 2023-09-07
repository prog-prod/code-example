<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE orders AUTO_INCREMENT = 10135;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
