<?php

use App\Enums\SexEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->after('id')->nullable();
            $table->string('login')->after('id')->nullable();
            $table->dateTime('phone_verified_at')->after('phone')->nullable();
            $table->string('country_code')->after('id')->nullable();
            $table->date('birthday')->after('phone')->nullable();
            $table->foreign('country_code')->references('code')->on('countries')->onDelete('set null');
            $table->enum('sex', SexEnum::getValues())->after('phone')->nullable();
            $table->string('last_name')->after('name')->nullable();
            $table->string('middle_name')->after('name')->nullable();
            $table->string('first_name')->after('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('login');
            $table->dropColumn('phone_verified_at');
            $table->dropForeign('users_country_code_foreign');
            $table->dropColumn('country_code');
            $table->dropColumn('birthday');
            $table->dropColumn('sex');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('middle_name');
        });
    }
};
