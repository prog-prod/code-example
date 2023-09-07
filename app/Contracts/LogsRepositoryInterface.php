<?php

namespace App\Contracts;

interface LogsRepositoryInterface
{
    public function logPhoneCode(string $phone, string $code);

    public function getPhoneCodeLogByPhone(string $phone);

}
