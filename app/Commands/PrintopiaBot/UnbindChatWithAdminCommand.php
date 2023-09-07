<?php

namespace App\Commands\PrintopiaBot;

use App\Contracts\AdminRepositoryInterface;
use App\Contracts\LogServiceInterface;
use App\Contracts\TelegramRepositoryInterface;
use Telegram\Bot\Commands\Command;

class UnbindChatWithAdminCommand extends Command
{

    protected string $name = 'unbind';
    protected string $pattern = '{token}';
    protected string $description = 'Відвʼязати аккаунт.';
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
                'text' => $chatId . " Для того щоб відвʼязати чат від аккаунту Printopia, відправте Ваш API ключ. \nПриклад: /{$this->name} <token>",
            ]);

            return;
        }
        $admin = $this->getAdmin($token);
        if ($admin) {
            $admin->detachTelegramChat($chat);
        } else {
            $this->replyWithMessage([
                'text' => "Аккаунт не знайдено по такому API токену: " . $token,
            ]);
            return;
        }

        if (!$admin->existTelegramChat($chat)) {
            $this->replyWithMessage([
                'text' => "Ви успішно відвʼязали чат від аккаунту: " . $admin->email,
            ]);
        } else {
            $this->replyWithMessage([
                'text' => "Не вдалось відвʼязати чат від аккаунту: " . $admin->email,
            ]);
        }
    }

    private function getAdmin(string $token)
    {
        return $this->adminRepository->getAdminByToken($token);
    }
}
