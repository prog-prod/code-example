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
        Schema::table('product_images', function (Blueprint $table) {
            $table->foreignId('color_id')->nullable()->after('product_id')->constrained()->onDelete('set null');
            $table->integer('position')->nullable()->after('color_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_images', function (Blueprint $table) {
            $table->dropColumn('position');
            $table->dropForeign('product_images_color_id_foreign');
            $table->dropColumn('color_id');
        });
    }
};
