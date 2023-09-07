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
        foreach (
            [
                'print_categories',
                'print_images',
                'categories',
                'products',
                'colors',
                'print_categories',
                'sizes',
                'brands',
            ] as $table
        ) {
            if (Schema::hasColumn($table, 'name_ua')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->dropColumn('name_ua');
                });
            }
            if (Schema::hasColumn($table, 'name_en')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->dropColumn('name_en');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
