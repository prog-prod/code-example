<?php

namespace Tests\Feature\Admin;

use App\Enums\CurrencyEnum;
use App\Enums\GenderEnum;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Currency;
use App\Models\Gender;
use App\Models\PrintCategory;
use App\Models\PrintImage;
use App\Models\Product;
use App\Models\ProductFeature;
use App\Models\Sale;
use App\Models\Size;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_admin_can_create_a_product()
    {
        $this->withoutExceptionHandling();
        $this->createGenders();
        $this->signInAsAdmin();

        Storage::fake('public');
        $this->createCurrency();

        $color = Color::factory(1)->create()->first();
        $size = Size::factory(1)->create()->first();
        $sale = Sale::factory(1)->create()->first();
        $category = Category::factory(1)->create()->first();
        $brand = Brand::factory(1)->create()->first();
        $gender = Gender::whereKey(GenderEnum::MAN->value)->first();
        $prints = PrintImage::factory(2)->for(PrintCategory::factory(), 'category')->create()->pluck('id')->toArray();

        $images = [UploadedFile::fake()->image('image_1.jpg'), UploadedFile::fake()->image('image_2.jpg')];
        $main_image = 'image_1.jpg';
        $images_order = 'image_1.jpg,image_2.jpg';
        $slug = 'test-product-slug';
        $key = 'test-product';

        $response = $this->post(route('admin.products.store'), [
            'key' => $key,
            'slug' => $slug,
            'name_en' => 'Product name',
            'name_uk' => 'Продукт 1',
            'description_en' => 'Product description',
            'description_uk' => 'Опис',
            'price' => 2999,
            'currency' => CurrencyEnum::UAH->value,
            'main' => 0,
            'weight' => 0,
            'active' => 1,
            'main-image' => $main_image,
            'category' => $category->id,
            'stock_quantity' => 100,
            'brand_id' => $brand->id,
            'gender_id' => $gender->id,
            'new_until' => now()->addWeek(),
            'color_id' => $color->id,
            'size_id' => $size->id,
            'prints' => $prints,
            'sale' => $sale->id,
            'feature-name_uk' => ['Feature name uk'],
            'feature-name_en' => ['Feature name en'],
            'feature-text_uk' => ['Feature text ek'],
            'feature-text_en' => ['Feature text en'],
            'images_order' => $images_order,
            'images' => $images,
        ]);

        $product = Product::query()->whereSlug($slug)->first();

        $response->assertRedirect(route('admin.products.group', $product->key))
            ->assertSessionHas('success', 'Product has been created successfully');

        $this->assertTranslations([
            'name_en' => 'Product name',
            'name_uk' => 'Продукт 1',
            'description_en' => 'Product description',
            'description_uk' => 'Опис',
        ], Product::class);

        $this->assertTranslations([
            'name_uk' => 'Feature name uk',
            'name_en' => 'Feature name en',
            'text_uk' => 'Feature text ek',
            'text_en' => 'Feature text en',
        ], ProductFeature::class);


        $this->assertNotNull($product);
        $this->assertCount(2, $product->images);
        $this->assertTrue(Storage::exists($product->images->first()->filename));
        $this->assertEquals($key, $product->key);
        $this->assertEquals($slug, $product->slug);
        $this->assertEquals($color->id, $product->color_id);
        $this->assertEquals($size->id, $product->size_id);
        $this->assertEquals($brand->id, $product->brand_id);
        $this->assertEquals($gender->id, $product->gender_id);
    }

    public function test_admin_can_see_edit_product_page()
    {
        $this->withoutExceptionHandling();

        $this->signInAsAdmin();
        $product = Product::factory()
            ->for(Brand::factory())
            ->for(Gender::whereKey(GenderEnum::WOMAN->value)->first())
            ->for(Category::factory())
            ->for(Currency::factory())
            ->for(Size::factory())
            ->for(Color::factory())
            ->create();

        $response = $this->get(route('admin.products.edit', $product->id));

        $response->assertOk()
            ->assertViewIs('admin.products.edit')
            ->assertViewHas('product', $product);
    }

    public function test_admin_can_update_a_product()
    {
//        $this->withoutExceptionHandling();

        // Log in as an admin
        $this->signInAsAdmin();
        $this->createCurrency();

        $key = 'updated-key';
        $slug = 'updated-key-slug';
        $related = Product::factory()
            ->for(Brand::factory())
            ->for(Category::factory())
            ->for(Currency::factory())
            ->create();
        $gender = Gender::whereKey(GenderEnum::MAN->value)->first();
        $color = Color::factory()->create();
        $size = Size::factory()->create();
        $brand = Brand::factory()->create();
        $sale = Sale::factory()->create();

        // Create a product
        $product = Product::factory()
            ->for(Brand::factory())
            ->for(Category::factory())
            ->has(Sale::factory())
            ->for(Gender::whereKey(GenderEnum::CHILD->value)->first())
            ->for(Color::factory())
            ->for(Size:: factory())
            ->create();

        // Send a POST request to the update endpoint
        $response = $this->put(route('admin.products.update', $product->slug), [
            'key' => $key,
            'slug' => $slug,
            'name_en' => 'Product name',
            'name_uk' => 'Продукт 1',
            'description_en' => 'Product description',
            'description_uk' => 'Опис',
            'price' => 12.99,
            'currency' => CurrencyEnum::UAH->value,
            'category' => Category::first()->id,
            'stock_quantity' => 4,
            'active' => 1,
            'prints' => [],
            'gender_id' => $gender->id,
            'brand_id' => $brand->id,
            'color_id' => $color->id,
            'size_id' => $size->id,
            'sale' => $sale->id,
            'related_products' => [$related->id],
            'feature-name_uk' => ['Feature 1 ua', 'Feature 2 ua'],
            'feature-name_en' => ['Feature 1 en', 'Feature 2 en'],
            'feature-text_uk' => ['Feature 1 Text ua', 'Feature 2 Text ua'],
            'feature-text_en' => ['Feature 1 Text en', 'Feature 2 Text en'],
            'images_order' => null,
            'images' => [],
        ]);
        $product->refresh();
        $response->assertRedirect();
        // Assert that the product was updated in the database
        $this->assertEquals($key, $product->key);
        $this->assertEquals(1300, $product->price->getMinorAmount()->toInt());
        $this->assertEquals(CurrencyEnum::UAH->value, $product->currency_name);
        $this->assertEquals(Category::first()->id, $product->category_id);
        $this->assertEquals(4, $product->stock_quantity);
        $this->assertEquals(GenderEnum::MAN->value, $product->gender_id);
        $this->assertEquals($brand->id, $product->brand_id);
        $this->assertEquals($color->id, $product->color_id);
        $this->assertEquals($size->id, $product->size_id);
        $this->assertEquals($sale->id, $product->sale?->id);
        $this->assertEquals([$related->id], $product->related->pluck('id')->toArray());
        $this->assertCount(0, $product->images);
        $this->assertCount(0, $product->prints);

        // Assert that the user is redirected to the index page with a success message
        $response->assertRedirect(route('admin.products.group', $product->key));
        $response->assertSessionHas('success', 'Product has been updated successfully');

        $this->assertTranslations([
            'name_en' => 'Product name',
            'name_uk' => 'Продукт 1',
            'description_en' => 'Product description',
            'description_uk' => 'Опис',
        ], Product::class);

        $this->assertTranslations([
            'name_uk' => ['Feature 1 ua', 'Feature 2 ua'],
            'name_en' => ['Feature 1 en', 'Feature 2 en'],
            'text_uk' => ['Feature 1 Text ua', 'Feature 2 Text ua'],
            'text_en' => ['Feature 1 Text en', 'Feature 2 Text en'],
        ], ProductFeature::class);
    }

    /** @test */
    public function admin_can_delete_products()
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();

        $product = Product::factory()
            ->for(Brand::factory())
            ->for(Gender::whereKey(GenderEnum::CHILD->value)->first())
            ->for(Category::factory())
            ->for(Currency::factory())
            ->for(Color::factory())
            ->has(Sale::factory())
            ->for(Size:: factory())
            ->create([
                'price' => 3000
            ]);

        $response = $this->delete(route('admin.products.destroy', $product));

        $this->assertSoftDeleted(
            'products',
            ['id' => $product->id]
        );

        $response->assertRedirect(route('admin.products.index'));
    }

    /** @test */
    public function admin_can_view_products_page()
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();

        $product = Product::factory()
            ->for(Brand::factory())
            ->for(Category::factory())
            ->for(Gender::whereKey(GenderEnum::WOMAN->value)->first())
            ->for(
                Currency::factory()->state([
                    'name' => CurrencyEnum::UAH->value,
                    'code' => CurrencyEnum::UAH->name,
                    'symbol' => CurrencyEnum::UAH->symbol()
                ])
            )
            ->for(Color::factory())
            ->for(Size:: factory())
            ->has(Sale::factory())
            ->create([
                'price' => 3000,
            ]);

        $response = $this->get(route('admin.products.index'));

        $response->assertOk();
        $response->assertSee($product->name);
    }

    /** @test */
    public function user_cant_see_a_products_page()
    {
        $user = User::factory()->create();
        $this->signIn($user);
        $response = $this->get(route('admin.products.index'));

        $response->assertRedirect(route('admin.login'));
    }
}
