<?php

use App\Enums\LocalesEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach (
            [
                \App\Models\PrintCategory::all(),
                \App\Models\PrintImage::all(),
                \App\Models\Category::all(),
                \App\Models\Product::withoutGlobalScope('active')->get(),
                \App\Models\Brand::all(),
            ] as $models
        ) {
            foreach ($models as $model) {
                $model->translations()->updateOrCreate([
                    'locale' => LocalesEnum::UA->value,
                    'key' => 'description'
                ], [
                    'value' => $model->description
                ]);
            }
        }
        foreach (['print_categories', 'print_images', 'categories', 'products', 'brands'] as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('description');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach (['print_categories', 'print_images', 'categories', 'products', 'brands'] as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->longText('description')->nullable();
            });
        }
    }
};
