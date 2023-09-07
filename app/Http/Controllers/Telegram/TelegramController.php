<?php

namespace App\Http\Controllers\Telegram;

use App\Contracts\LogServiceInterface;
use App\Contracts\TelegramServiceInterface;
use App\Http\Controllers\Controller;

class TelegramController extends Controller
{

    public function __invoke(TelegramServiceInterface $telegramService, LogServiceInterface $logService)
    {
        $updatesWebhook = $telegramService->getWebhookUpdate();

        $logService->info("Received data from telegram: " . $updatesWebhook);
//
        $message = $telegramService->writeAndGetComingMessage();
//
        $apiSdk = $telegramService->getTelegramApiSdk();
        $update = $apiSdk->commandsHandler(true);

        return 'ok';
    }
}
