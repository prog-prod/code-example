<?php

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $values = collect(OrderStatusEnum::getValues())->map(function ($status) {
                return '"' . $status . '"';
            })->join(',');
            DB::statement(
                "ALTER TABLE orders CHANGE COLUMN status status ENUM(" . $values . ")"
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            DB::statement("ALTER TABLE orders CHANGE COLUMN status status ENUM('1','2','3','4','5')");
        });
    }
};
