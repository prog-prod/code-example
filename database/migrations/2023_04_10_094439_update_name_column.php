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
        Schema::table('print_categories', function (Blueprint $table) {
            $table->unique('name');
            $table->renameColumn('img', 'image');
            $table->string('name_en')->nullable()->after('name');
            $table->string('name_ua')->nullable()->after('name');
            $table->renameColumn('name', 'key');
        });

        Schema::table('print_images', function (Blueprint $table) {
            $table->unique('name');
            $table->string('name_en')->nullable()->after('name');
            $table->string('name_ua')->nullable()->after('name');
            $table->string('description')->nullable()->after('image');
            $table->renameColumn('name', 'key');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->unique('name');
            $table->renameColumn('img', 'image');
            $table->string('name_en')->nullable()->after('name');
            $table->string('name_ua')->nullable()->after('name');
            $table->renameColumn('name', 'key');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->unique('name');
            $table->string('name_en')->nullable()->after('name');
            $table->string('name_ua')->nullable()->after('name');
            $table->renameColumn('name', 'key');
        });

        Schema::table('colors', function (Blueprint $table) {
            $table->unique('name');
            $table->string('name_en')->nullable()->after('name');
            $table->string('name_ua')->nullable()->after('name');
            $table->renameColumn('name', 'key');
        });
        Schema::table('sales', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name');
            $table->string('name_ua')->nullable()->after('name');
            $table->renameColumn('name', 'key');
        });
        Schema::table('sizes', function (Blueprint $table) {
            $table->unique('name');
            $table->string('name_en')->nullable()->after('name');
            $table->string('name_ua')->nullable()->after('name');
            $table->renameColumn('name', 'key');
        });
        Schema::table('brands', function (Blueprint $table) {
            $table->unique('name');
            $table->string('name_en')->nullable()->after('name');
            $table->string('name_ua')->nullable()->after('name');
            $table->renameColumn('name', 'key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('print_categories', function (Blueprint $table) {
            $table->dropUnique('print_categories_name_unique');
            $table->renameColumn('image', 'img');
            $table->dropColumn('name_en');
            $table->dropColumn('name_ua');
            $table->renameColumn('key', 'name');
        });

        Schema::table('print_images', function (Blueprint $table) {
            $table->dropUnique('print_images_name_unique');
            $table->dropColumn('name_en');
            $table->dropColumn('name_ua');
            $table->dropColumn('description');
            $table->renameColumn('key', 'name');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropUnique('categories_name_unique');
            $table->renameColumn('image', 'img');
            $table->dropColumn('name_en');
            $table->dropColumn('name_ua');
            $table->renameColumn('key', 'name');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropUnique('products_name_unique');
            $table->dropColumn('name_en');
            $table->dropColumn('name_ua');
            $table->renameColumn('key', 'name');
        });

        Schema::table('colors', function (Blueprint $table) {
            $table->dropUnique('colors_name_unique');
            $table->dropColumn('name_en');
            $table->dropColumn('name_ua');
            $table->renameColumn('key', 'name');
        });
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('name_en');
            $table->dropColumn('name_ua');
        });
        Schema::table('sizes', function (Blueprint $table) {
            $table->dropUnique('sizes_name_unique');
            $table->dropColumn('name_en');
            $table->dropColumn('name_ua');
            $table->renameColumn('key', 'name');
        });
        Schema::table('brands', function (Blueprint $table) {
            $table->dropUnique('brands_name_unique');
            $table->dropColumn('name_en');
            $table->dropColumn('name_ua');
            $table->renameColumn('key', 'name');
        });
    }
};
