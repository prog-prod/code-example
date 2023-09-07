<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('product_images')->update([
            'filename' => DB::raw("CONCAT('public/images/', filename)")
        ]);
        DB::table('users')->whereNotNull('avatar')->update([
            'avatar' => DB::raw("CONCAT('public/images/avatars/', avatar)")
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('product_images')->update([
            'filename' => DB::raw("REPLACE(filename, 'public/images/', '')")
        ]);

        DB::table('users')->whereNotNull('avatar')->update([
            'avatar' => DB::raw("REPLACE(avatar, 'public/images/avatars/', '')")
        ]);
    }
};
