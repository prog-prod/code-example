<?php

namespace App\Services;

use App\Contracts\LogServiceInterface;
use App\Contracts\LogsRepositoryInterface;
use Illuminate\Support\Facades\Log;

class LogService implements LogServiceInterface
{

    private LogsRepositoryInterface $logsRepository;

    public function __construct()
    {
        $this->logsRepository = app(LogsRepositoryInterface::class);
    }

    public function info($message): void
    {
        if (!is_string($message)) {
            $message = json_encode($message, JSON_UNESCAPED_UNICODE);
        }
        Log::info($message);
    }

    public function logPhoneCode(string $phone, string $code)
    {
        return $this->logsRepository->logPhoneCode($phone, $code);
    }

    public function getPhoneCodeLogByPhone(string $phone)
    {
        return $this->logsRepository->getPhoneCodeLogByPhone($phone);
    }

    public function error(string $message): void
    {
        Log::error($message);
    }
}
