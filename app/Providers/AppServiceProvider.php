<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Layout;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\PrintCategory;
use App\Models\PrintImage;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Size;
use App\Models\Slide;
use App\Observers\ForceDeleteTranslationsObserver;
use App\Observers\RemoveTranslationsObserver;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Slide::observe(RemoveTranslationsObserver::class);
        Page::observe(ForceDeleteTranslationsObserver::class);
        Layout::observe(ForceDeleteTranslationsObserver::class);
        Brand::observe(ForceDeleteTranslationsObserver::class);
        Category::observe(ForceDeleteTranslationsObserver::class);
        Color::observe(ForceDeleteTranslationsObserver::class);
        MenuItem::observe(RemoveTranslationsObserver::class);
        PrintCategory::observe(ForceDeleteTranslationsObserver::class);
        PrintImage::observe(ForceDeleteTranslationsObserver::class);
        Product::observe(ForceDeleteTranslationsObserver::class);
        Sale::observe(ForceDeleteTranslationsObserver::class);
        Size::observe(ForceDeleteTranslationsObserver::class);

        JsonResource::withoutWrapping();
        Paginator::useBootstrap();
    }
}
