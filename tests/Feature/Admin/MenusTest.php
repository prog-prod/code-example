<?php

namespace Tests\Feature\Admin;

use App\Models\Menu;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\TestCase;

class MenusTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    /**
     * Test that admin can view list of menus
     *
     * @return void
     */
    public function test_admin_can_view_menus(): void
    {
        $this->signInAsAdmin();

        $menus = Menu::factory()->count(3)->create();

        $response = $this->get(route('admin.menus.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.menus.index');
        $response->assertViewHas('menus');
        $response->assertSee($menus[0]->name);
        $response->assertSee($menus[1]->name);
        $response->assertSee($menus[2]->name);
    }

    /**
     * Test that admin can create a menu
     *
     * @return void
     */
    public function test_admin_can_create_menu(): void
    {
        $this->signInAsAdmin();

        $menuData = [
            'name' => $this->faker->sentence(),
            'image' => UploadedFile::fake()->image('test_image.jpg')
        ];

        $response = $this->post(route('admin.menus.store'), $menuData);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.menus.index'));

        $menu = Menu::where('name', $menuData['name'])->first();

        $this->assertNotNull($menu);
        $this->assertEquals($menuData['name'], $menu->name);

        Storage::assertExists($menu->image);
    }

    /**
     * Test that admin can view a menu
     *
     * @return void
     */
    public function test_admin_can_view_menu(): void
    {
        $this->signInAsAdmin();

        $menu = Menu::factory()->create();

        $response = $this->get(route('admin.menus.show', $menu));

        $response->assertStatus(200);
        $response->assertViewIs('admin.menus.show');
        $response->assertViewHas('menu');
        $response->assertSee($menu->name);
    }

    /**
     * Test that admin can update a menu
     *
     * @return void
     */
    public function test_admin_can_update_menu(): void
    {
        $this->signInAsAdmin();

        $menu = Menu::factory()->create();

        $menuData = [
            'name' => $this->faker->sentence(),
            'image' => UploadedFile::fake()->image('test_image.jpg')
        ];

        $response = $this->put(route('admin.menus.update', $menu), $menuData);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.menus.index'));

        $menu->refresh();

        $this->assertEquals($menuData['name'], $menu->name);

        Storage::assertExists($menu->image);
    }

    public function test_admin_can_delete_menu()
    {
        $menu = Menu::factory()->create();

        $this->signInAsAdmin();
        
        $response = $this->delete(route('admin.menus.destroy', $menu->id));

        $response->assertRedirect(route('admin.menus.index'));
        $response->assertSessionHas('success');
        $this->assertNull(Menu::find($menu->id));
    }
}
