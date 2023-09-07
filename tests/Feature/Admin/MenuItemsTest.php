<?php

namespace Tests\Feature\Admin;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MenuItemsTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function admin_can_create_menu_item()
    {
        $this->signInAsAdmin();

        $menu = Menu::factory()->create();
        $response = $this->post(route('admin.menu_items.store', ['menu_id' => $menu->id]), [
            'key' => 'test_item',
            'link' => 'http://example.com',
            'mega' => 0,
        ]);
        $response->assertRedirect(route('admin.menus.show', $menu));
        $this->assertDatabaseHas('menu_items', [
            'menu_id' => $menu->id,
            'key' => 'test_item',
            'link' => 'http://example.com',
            'mega' => 0,
        ]);
    }

    /**
     * @test
     */
    public function admin_can_edit_menu_item()
    {
        $this->signInAsAdmin();

        $menu = Menu::factory()->create();
        $menuItem = MenuItem::factory()->create(['menu_id' => $menu->id]);

        $newKey = 'new_key';
        $newLink = 'http://new-example.com';

        $response = $this->put(route('admin.menu_items.update', ['menu_id' => $menu->id, $menuItem]), [
            'key' => $newKey,
            'link' => $newLink,
            'mega' => 1,
        ]);

        $response->assertRedirect(route('admin.menus.show', $menu));
        $this->assertDatabaseHas('menu_items', [
            'id' => $menuItem->id,
            'menu_id' => $menu->id,
            'key' => $newKey,
            'link' => $newLink,
            'mega' => 1,
        ]);
    }

    /**
     * @test
     */
    public function admin_can_delete_menu_item()
    {
        $this->signInAsAdmin();
        $menu = Menu::factory()->create();
        $menuItem = MenuItem::factory()->create(['menu_id' => $menu->id]);

        $response = $this->delete(route('admin.menu_items.destroy', ['menu_id' => $menu->id, $menuItem]));

        $response->assertRedirect(route('admin.menus.show', $menu));
        $this->assertDatabaseMissing('menu_items', ['id' => $menuItem->id]);
    }

    /**
     * @test
     */
    public function user_cant_create_menu_item()
    {
        $this->actingAs(User::factory()->create());
        $menu = Menu::factory()->create();
        $response = $this->post(route('admin.menu_items.store', $menu), [
            'key' => 'test_item',
            'link' => 'http://example.com',
            'mega' => 0,
        ]);
        $response->assertRedirect(route('admin.login'));
    }
}
