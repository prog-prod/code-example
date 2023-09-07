<?php

namespace App\Contracts;

interface LogServiceInterface
{
    public function info($message);

    public function logPhoneCode(string $phone, string $code);

    public function getPhoneCodeLogByPhone(string $phone);

    public function error(string $message): void;
}
