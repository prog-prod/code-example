<?php

namespace App\Contracts;

use App\Models\Page;

interface PageRepositoryInterface
{
    public function getHomePage(): ?Page;

    public function getAboutPage(): ?Page;
}
