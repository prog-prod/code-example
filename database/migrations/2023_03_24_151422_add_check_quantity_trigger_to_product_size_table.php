<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
//        DB::unprepared(
//            "
//            CREATE TRIGGER check_quantity
//            BEFORE INSERT ON product_size
//            FOR EACH ROW
//            BEGIN
//                SET product_quantity = (SELECT quantity FROM products WHERE id = NEW.product_id);
//                IF NEW.quantity > product_quantity THEN
//                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Quantity exceeds available stock';
//                END IF;
//            END;
//            "
//        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS check_quantity');
    }
};
