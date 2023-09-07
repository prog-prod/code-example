<?php

namespace Tests\Feature\Admin;

use App\Contracts\ProductRepositoryInterface;
use App\Enums\Admin\PageSlugEnum;
use App\Models\Layout;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Storage;
use Tests\TestCase;

class PagesTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test the index page.
     *
     * @return void
     */
    public function testAdminCanSeeIndexPage(): void
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();

        $pages = Page::factory()->for(Layout::factory())->count(3)->create();

        $response = $this->get(route('admin.pages.index'));

        $response->assertOk();
        $response->assertViewIs('admin.pages.index');
        $response->assertViewHas('pages', $pages->first()->name);
    }

    /**
     * Test the edit page.
     *
     * @return void
     */
    public function testAdminCanSeeEditPage(): void
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();

        $page = Page::factory()->for(Layout::factory())->create([
            'slug' => PageSlugEnum::CONTACT->value,
        ]);

        $productsWithSale = $this->app->make(ProductRepositoryInterface::class)->getProductsWithSale();
        $productsCollections = $this->app->make(ProductRepositoryInterface::class)->getBestCollections();

        $response = $this->get(route('admin.pages.edit', ['page' => $page->id]));

        $response->assertOk();
        $response->assertViewIs('admin.pages.contact-us.edit');
        $response->assertViewHas('page', $page);
        $response->assertViewHas('productsWithSale', $productsWithSale);
        $response->assertViewHas('productsCollections', $productsCollections);
    }

    /**
     * Test updating a page.
     *
     * @return void
     */
    public function testAdminCanUpdatePage(): void
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();

        Storage::fake('public');

        $page = Page::factory()->for(Layout::factory())->create([
            'slug' => PageSlugEnum::CONTACT->value,
            'sections' => [
                'google_maps' => [
                    'order' => 1,
                    'active' => 1,
                ],
                'contact_form' => [
                    'order' => 2,
                    'active' => 1,
                ],
            ],
        ]);

        $data = [
            'slug' => PageSlugEnum::CONTACT->value,
            'sections' => [
                'google_maps' => [
                    'order' => 2,
                    'active' => 0,
                ],
                'contact_form' => [
                    'order' => 1,
                    'active' => 1,
                ],
            ],
        ];

        $response = $this->put(route('admin.pages.update', ['page' => $page->id]), $data);

        $response->assertRedirect(route('admin.pages.index'));
        $response->assertSessionHas('success');

        $page->refresh();

        $section_actual = $page->sections->toArray();
        $this->assertEquals($data['slug'], $page->slug);
        $this->assertEquals($data['sections']['google_maps']['order'], $section_actual['google_maps']['order']);
        $this->assertEquals($data['sections']['google_maps']['active'], $section_actual['google_maps']['active']);

        $this->assertEquals($data['sections']['contact_form']['order'], $section_actual['contact_form']['order']);
        $this->assertEquals($data['sections']['contact_form']['active'], $section_actual['contact_form']['active']);
    }

}
