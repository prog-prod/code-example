<?php

namespace App\Contracts;

interface TransliteratorServiceInterface
{
    public function translit($src);

    public function isTextTranslited(null|string $text): bool;

    public function detranslit($src): string;
}
