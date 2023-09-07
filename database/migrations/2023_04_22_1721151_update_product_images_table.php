<?php

use App\Models\Color;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $color = Color::first();

        Product::withoutGlobalScope('active')->whereHas('images', function ($q) {
            $q->where('color_id', null);
        })->chunk(100, function ($products) use ($color) {
            foreach ($products as $product) {
                $newColor = $product->colors->first() ?? $color;
                $product->images()->update(['color_id' => $newColor->id]);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
