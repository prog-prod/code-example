<?php

use App\Enums\LocalesEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach (\App\Models\Slide::all() as $slide) {
            foreach (['before_title', 'title', 'after_title', 'description', 'bg_letter'] as $column) {
                $slide->translations()->updateOrCreate([
                    'locale' => LocalesEnum::UA->value,
                    'key' => $column
                ], [
                    'value' => $slide->{$column}
                ]);
            }
        }
        
        Schema::table('slides', function (Blueprint $table) {
            $table->dropColumn('before_title');
            $table->dropColumn('title');
            $table->dropColumn('after_title');
            $table->dropColumn('description');
            $table->dropColumn('bg_letter');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('slides', function (Blueprint $table) {
            $table->string('before_title')->nullable();
            $table->string('title')->nullable();
            $table->string('after_title')->nullable();
            $table->text('description')->nullable();
            $table->string('bg_letter')->nullable();
        });
    }
};
