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
        foreach (\App\Models\MenuItem::all() as $item) {
            $item->translations()->updateOrCreate([
                'locale' => \App\Enums\LocalesEnum::UA->value,
                'key' => 'name'
            ], [
                'value' => $item->name_ua
            ]);
            $item->translations()->updateOrCreate([
                'locale' => \App\Enums\LocalesEnum::EN->value,
                'key' => 'name'
            ], [
                'value' => $item->name_en
            ]);
        }
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropColumn('name_ua');
            $table->dropColumn('name_en');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->string('name_ua')->nullable();
        });
    }
};
