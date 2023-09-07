<?php

namespace App\Repositories;

use App\Contracts\PageRepositoryInterface;
use App\Enums\Admin\PageSlugEnum;
use App\Models\Page;

class PageRepository implements PageRepositoryInterface
{

    public function getHomePage(): ?Page
    {
        return Page::whereSlug(PageSlugEnum::HOME->value)->first();
    }

    public function getAboutPage(): ?Page
    {
        return Page::whereSlug(PageSlugEnum::ABOUT->value)->first();
    }
}
