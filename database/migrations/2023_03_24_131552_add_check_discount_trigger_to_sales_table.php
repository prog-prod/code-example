<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
//        DB::unprepared(
//            '
//           CREATE TRIGGER check_discount BEFORE INSERT ON sales
//            FOR EACH ROW
//            BEGIN
//                DECLARE price INT;
//                SELECT price INTO price FROM products WHERE id = NEW.product_id;
//                IF NEW.discount >= price THEN
//                    SIGNAL SQLSTATE \'45000\' SET MESSAGE_TEXT = \'Discount cannot be greater than or equal to the product price!\';
//                END IF;
//            END
//        '
//        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS check_discount');
    }
};
