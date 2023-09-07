<?php

namespace App\Services;

use App\Contracts\TransliteratorServiceInterface;

class HelperService
{
    function isNotProduction(): bool
    {
        return app()->environment() !== 'production';
    }

    function isProduction(): bool
    {
        return app()->environment() === 'production';
    }

    function translit(string|null $text = null)
    {
        $transliterator = app(TransliteratorServiceInterface::class);

        return $text ? $transliterator->translit($text) : '';
    }

    function detranslit(string|null $text = null)
    {
        $transliterator = app(TransliteratorServiceInterface::class);

        return $text ? $transliterator->detranslit($text) : '';
    }

    function isTranslited(string|null $text = null)
    {
        $transliterator = app(TransliteratorServiceInterface::class);

        return $text ? $transliterator->isTextTranslited($text) : false;
    }
}
