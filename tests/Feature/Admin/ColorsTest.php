<?php

namespace Tests\Feature\Admin;

use App\Models\Color;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ColorsTest extends TestCase
{
    use DatabaseTransactions;

    public function test_admin_can_create_color()
    {
        $this->signInAsAdmin();

        $response = $this->post('/admin/colors', [
            "key" => 'Red',
            "hex_code" => '#FF0000'
        ]);

        $response->assertRedirect('/admin/colors');
        $this->assertDatabaseHas('colors', [
            "key" => 'Red',
            "hex_code" => '#FF0000'
        ]);
    }

    public function test_admin_can_update_color()
    {
        $this->signInAsAdmin();

        $color = Color::factory()->create();

        $response = $this->put("/admin/colors/{$color->id}", [
            "key" => 'Blue',
            "hex_code" => '#0000FF'
        ]);

        $response->assertRedirect('/admin/colors');
        $this->assertDatabaseHas('colors', [
            'key' => 'Blue',
            'hex_code' => '#0000FF',
        ]);
    }

    public function test_admin_can_delete_color()
    {
        $this->signInAsAdmin();

        $color = Color::factory()->create();

        $response = $this->delete("/admin/colors/{$color->id}");

        $response->assertRedirect('/admin/colors');
        $this->assertSoftDeleted('colors', [
            'id' => $color->id,
        ]);
    }

    public function test_admin_can_view_colors()
    {
        $this->signInAsAdmin();

        Color::factory()->create([
            "key" => 'Red',
            "hex_code" => '#FF0000'
        ]);

        $response = $this->get('/admin/colors');

        $response->assertOk();
        $response->assertSee('Red');
        $response->assertSee('#FF0000');
    }

    public function test_user_cant_view_colors()
    {
        Color::factory()->create([
            "key" => 'Red',
            "hex_code" => '#FF0000'
        ]);

        $response = $this->get('/admin/colors');
        $response->assertRedirect('/admin/login');
    }

}
