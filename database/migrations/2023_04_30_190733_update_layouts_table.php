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
        Schema::table('layouts', function (Blueprint $table) {
            $table->string('header_logo')->nullable();
            $table->string('footer_logo')->nullable();
            $table->boolean('top_ads_status')->default(0);
            $table->string('top_ads_bg_color')->nullable();
            $table->string('top_ads_link')->nullable();
            $table->string('top_ads_image')->nullable();
            $table->text('phones')->nullable();
            $table->text('emails')->nullable();
        });
        Schema::table('layouts', function (Blueprint $table) {
            $table->dropColumn('header');
            $table->dropColumn('footer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('layouts', function (Blueprint $table) {
            $table->dropColumn('header_logo');
            $table->dropColumn('footer_logo');
            $table->dropColumn('top_ads_status');
            $table->dropColumn('top_ads_bg_color');
            $table->dropColumn('top_ads_link');
            $table->dropColumn('top_ads_image');
            $table->dropColumn('phones');
            $table->dropColumn('emails');
        });
        Schema::table('layouts', function (Blueprint $table) {
            $table->json('header');
            $table->json('footer');
        });
    }
};
