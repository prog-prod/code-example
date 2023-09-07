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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_id');
            $table->string('account_id');
            $table->string('account_type')->nullable();
            $table->string('comment');
            $table->jsonb('details');
            $table->unsignedBigInteger('amount');
            $table->string('currency_name');
            $table->timestamps();

            $table->foreign('payment_id')->on('payments')->references('id')->onDelete('cascade');
            $table->foreign('currency_name')->references('name')->on('currencies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
