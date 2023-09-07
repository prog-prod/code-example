<?php

namespace App\Commands\PrintopiaBot;

use App\Contracts\AdminRepositoryInterface;
use App\Contracts\LogServiceInterface;
use App\Contracts\TelegramRepositoryInterface;
use Telegram\Bot\Commands\Command;

class BindChatWithAdminCommand extends Command
{

    protected string $name = 'bind';
    protected string $pattern = '{token}';
    protected string $description = 'Привʼязати аккаунт до бота, щоб отримувати сповіщення сюди.';
    private AdminRepositoryInterface $adminRepository;
    private LogServiceInterface $logService;
    private TelegramRepositoryInterface $telegramRepository;

    public function __construct(
        LogServiceInterface $logService,
        TelegramRepositoryInterface $telegramRepository,
        AdminRepositoryInterface $adminRepository
    ) {
        $this->adminRepository = $adminRepository;
        $this->telegramRepository = $telegramRepository;
        $this->logService = $logService;
    }

    public function handle(): void
    {
        $token = $this->argument('token');
        $chatId = $this->getUpdate()->getChat()->id;
        $chat = $this->telegramRepository->getChatByChatId($chatId);
        if (!$token) {
            $this->replyWithMessage([
                'text' => $chatId . " Для того щоб привʼязати чат цей чат до аккаунту Printopia, відправте Ваш API ключ. \nПриклад: /bind <token>",
            ]);

            return;
        }
        $admin = $this->getAdmin($token);
        if ($admin) {
            $admin->attachTelegramChat($chat);
        } else {
            $this->replyWithMessage([
                'text' => "Аккаунт не знайдено по такому API токену: " . $token,
            ]);
            return;
        }

        if ($admin->existTelegramChat($chat)) {
            $this->replyWithMessage([
                'text' => "Ви успішно привʼязали чат для аккаунту: " . $admin->email,
            ]);
        } else {
            $this->replyWithMessage([
                'text' => "Не вдалось привʼязати чат до аккаунту: " . $admin->email,
            ]);
        }
    }

    private function getAdmin(string $token)
    {
        return $this->adminRepository->getAdminByToken($token);
    }
}
