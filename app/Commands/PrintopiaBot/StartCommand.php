<?php

namespace App\Commands\PrintopiaBot;


use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{

    protected string $name = 'start';
    protected string $description = 'Тисни щоб почати';

    public function handle(): void
    {
        $this->replyWithMessage([
            'text' => 'Привіт! Ласкаво просимо до інтернет-магазину Printopia. Щоб дізнатися більше тисни /help',
        ]);
    }
}
