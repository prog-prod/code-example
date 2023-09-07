<?php

namespace App\DTO\SmsClub;

class SmsDataDTO
{
    public \stdClass $info;

    public function __construct(\stdClass $info)
    {
        $this->info = $info;
    }
}
