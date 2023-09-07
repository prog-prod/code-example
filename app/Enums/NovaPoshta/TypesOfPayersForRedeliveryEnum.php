<?php

namespace App\Enums\NovaPoshta;

enum TypesOfPayersForRedeliveryEnum: string
{
    case SENDER = "Sender";
    case RECIPIENT = "Recipient";
    case THIRD_PERSON = "ThirdPerson";
}
