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
                'users',
                'products',
                'categories',
                'customers',
                'orders',
                'order_items',
                'brands',
                'admin_users',
                'print_categories',
                'print_images',
                'sales',
                'colors',
                'sizes',
                'reviews',
                'subscribers',
                'tags',
            ] as $table
        ) {
            Schema::table($table, function (Blueprint $table) {
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach (
            [
                'users',
                'products',
                'categories',
                'customers',
                'orders',
                'order_items',
                'brands',
                'admin_users',
                'print_categories',
                'print_images',
                'sales',
                'colors',
                'sizes',
                'reviews',
                'subscribers',
                'tags',
            ] as $table
        ) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropSoftDeletes();
            });
        }
    }
};
