<?php

namespace App\Notifications\Channels;

class TelegramMessage
{
    public string $content;

    public static function create(): static
    {
        return new static;
    }

    public function content(string $content): static
    {
        $this->content = $content;
        return $this;
    }
}

