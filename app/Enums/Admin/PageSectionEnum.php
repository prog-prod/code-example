<?php

namespace App\Enums\Admin;

enum PageSectionEnum: string
{
    case HERO_SLIDER = 'hero_slider';
    case TOP_CATEGORIES = 'top_categories';
    case BEST_COLLECTIONS = 'best_collections';
    case SALE = 'sale';
    case DEAL = 'deal';
    case INSTAGRAM = 'instagram';
    case SERVICE = 'service';
    case SUBSCRIPTION = 'subscription';
    case ABOUT = 'about';
}
