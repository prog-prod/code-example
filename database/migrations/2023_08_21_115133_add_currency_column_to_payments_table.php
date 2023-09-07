<?php

use App\Enums\CurrencyEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('details');
            $table->string('currency_name')->default(CurrencyEnum::UAH->value)->nullable()->after('amount');
            $table->foreign('currency_name')->references('name')->on('currencies')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->jsonb('details')->nullable();
            $table->dropForeign('payments_currency_name_foreign');
            $table->dropColumn('currency_name');
        });
    }
};
