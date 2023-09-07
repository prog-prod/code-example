<?php

namespace App\Enums\Admin;

use App\Enums\Traits\EnumTrait;

enum PageSlugEnum: string
{
    use EnumTrait;

    case HOME = 'home';
    case ABOUT = 'about-us';
    case CONTACT = 'contact-us';
}
