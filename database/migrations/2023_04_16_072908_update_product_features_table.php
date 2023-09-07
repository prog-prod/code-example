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
        foreach (\App\Models\ProductFeature::all() as $feature) {
            $feature->translations()->updateOrCreate([
                'locale' => \App\Enums\LocalesEnum::UA->value,
                'key' => 'name'
            ], [
                'value' => $feature->name
            ]);
            $feature->translations()->updateOrCreate([
                'locale' => \App\Enums\LocalesEnum::UA->value,
                'key' => 'text'
            ], [
                'value' => $feature->text
            ]);
        }
        Schema::table('product_features', function (Blueprint $table) {
            $table->dropColumn('text');
            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_features', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->text('text');
        });
    }
};
