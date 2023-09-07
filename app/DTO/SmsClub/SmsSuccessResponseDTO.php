<?php

namespace App\DTO\SmsClub;

class SmsSuccessResponseDTO
{
    public SmsDataDTO $success_request;

    public function __construct(\stdClass $success_request)
    {
        $this->success_request = new SmsDataDTO(info: $success_request->info);
    }
}
