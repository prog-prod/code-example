<?php

namespace App\Enums\NovaPoshta;

use App\Enums\Traits\EnumTrait;
use App\Models\Product;

enum CargoDescriptionEnum: string
{
    use EnumTrait;

    case CUP = 'Чашка';
    case CLOTHES = 'Одяг';

    case DISHES = 'Посуд';
    case ACCESSORIES = 'Аксесуари до одягу';
    case BAG = 'Сумка';

    public static function getDescriptionByProduct(Product $product)
    {
        $categoryDescriptionMapping = [
            'thermoses' => self::DISHES->value,
            'eco-bags' => self::BAG->value,
            'cups' => self::CUP->value,
            'accessories' => self::ACCESSORIES->value,
            'hats' => self::ACCESSORIES->value,
            'caps' => self::ACCESSORIES->value,
            'caps_and_hats' => self::ACCESSORIES->value,
            'cups_with_prints' => self::ACCESSORIES->value,
            'caps_with_prints' => self::ACCESSORIES->value,
            'cloth' => self::CLOTHES->value,
            't_shirts' => self::CLOTHES->value,
            'polo' => self::CLOTHES->value,
            'hoodie' => self::CLOTHES->value,
            'prints' => self::CLOTHES->value,
            'sweatshirts' => self::CLOTHES->value,
            't_shirts_with_prints' => self::CLOTHES->value,
            'masks_with_prints' => self::CLOTHES->value,
            'sweatshirts_with_prints' => self::CLOTHES->value,
            'hoodies_with_prints' => self::CLOTHES->value,
            'shoppers_with_prints' => self::CLOTHES->value,
        ];
        return $categoryDescriptionMapping[$product->category->key] ?? self::CLOTHES->value;
    }
}
