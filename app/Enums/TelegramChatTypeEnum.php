<?php

namespace App\Enums;

enum TelegramChatTypeEnum: string
{

    case GROUP = 'group';
    case SUPERGROUP = 'supergroup';
    case PRIVATE = 'private';

    public static function isGroup(mixed $type): bool
    {
        return in_array($type, [self::GROUP->value, self::SUPERGROUP->value]);
    }
}
