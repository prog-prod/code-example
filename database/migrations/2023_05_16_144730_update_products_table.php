<?php

use App\Enums\GenderEnum;
use App\Http\Controllers\Admin\Traits\ProductTrait;
use App\Models\Gender;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    use ProductTrait;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // update gender table
        foreach (\App\Enums\GenderEnum::cases() as $gender) {
            Gender::create([
                'key' => strtolower($gender->name)
            ]);
        }
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('size_id')->nullable()->after('key')->constrained()->onDelete('cascade');
            $table->foreignId('color_id')->nullable()->after('key')->constrained()->onDelete('cascade');
            $table->boolean('main')->after('stock_quantity')->default(false);
            $table->dropColumn('table_sizes_img');
            $table->unsignedBigInteger('gender_id')->nullable()->after('key');
            $table->string('slug')->unique()->nullable()->after('key');
            $table->index('key');
        });
        DB::transaction(function () {
            $genderMapping = [
                '1' => 1, // map '1' to the id of the corresponding gender in the 'genders' table
                '2' => 2,
                '3' => 3,
            ];

            foreach ($this->productBuilder(false)->get() as $product) {
                if ($product->gender) {
                    $product->gender_id = $genderMapping[$product->gender];
                    $product->save();
                }
            }
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('gender');
            $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade');
        });
        foreach ($this->productBuilder()->get() as $product) {
            $product->key = $this->updated_key($product->key);
            $product->main = 1;
            $product->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropForeign('products_size_id_foreign');
            $table->dropForeign('products_color_id_foreign');
            $table->dropColumn('size_id');
            $table->dropColumn('color_id');
            $table->string('table_sizes_img')->nullable();
            $table->enum('gender', [GenderEnum::getValues()])->nullable()->after('key');
        });
        DB::transaction(function () {
            $genderMapping = [
                '1' => 1, // map '1' to the id of the corresponding gender in the 'genders' table
                '2' => 2,
                '3' => 3,
            ];

            foreach ($this->productBuilder()->get() as $product) {
                if ($product->gender) {
                    $product->gender = $genderMapping[$product->gender_id];
                    $product->save();
                }
            }
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_gender_id_foreign');
            $table->dropColumn('gender_id');
        });
        foreach ($this->productBuilder()->get() as $product) {
            $product->gender = collect([null, ...GenderEnum::getValues()])->random();
            $product->save();
        }
    }

    public function updated_key(string $key): array|string
    {
        return str_replace(
            [
                ' ',
                'а',
                'б',
                'в',
                'г',
                'д',
                'е',
                'є',
                'ж',
                'з',
                'и',
                'і',
                'й',
                'к',
                'л',
                'м',
                'н',
                'о',
                'п',
                'р',
                'с',
                'т',
                'у',
                'ф',
                'х',
                'ц',
                'ч',
                'ш',
                'щ',
                'ь',
                'ю',
                'я',
                'ы',
                'ъ',
                'э',
                'А',
                'Б',
                'В',
                'Г',
                'Д',
                'Е',
                'Є',
                'Ж',
                'З',
                'И',
                'І',
                'Й',
                'К',
                'Л',
                'М',
                'Н',
                'О',
                'П',
                'Р',
                'С',
                'Т',
                'У',
                'Ф',
                'Х',
                'Ц',
                'Ч',
                'Ш',
                'Щ',
                'Ь',
                'Ю',
                'Я',
                'Ы',
                'Ъ',
                'Э',
                '&amp;',
                '#039;'
            ],
            [
                '-',
                'a',
                'b',
                'v',
                'g',
                'd',
                'e',
                'ye',
                'zh',
                'z',
                'i',
                'i',
                'y',
                'k',
                'l',
                'm',
                'n',
                'o',
                'p',
                'r',
                's',
                't',
                'u',
                'f',
                'h',
                'z',
                'ch',
                'sh',
                'sch',
                '',
                'yu',
                'ya',
                'i',
                '',
                '',
                'A',
                'B',
                'V',
                'G',
                'D',
                'E',
                'Ye',
                'Zh',
                'Z',
                'I',
                'I',
                'Y',
                'K',
                'L',
                'M',
                'N',
                'O',
                'P',
                'R',
                'S',
                'T',
                'U',
                'F',
                'H',
                'Z',
                'Ch',
                'Sh',
                'Sch',
                '',
                'Yu',
                'Ya',
                'I',
                '',
                '',
                ''
            ],
            strtolower($key)
        );
    }
};
