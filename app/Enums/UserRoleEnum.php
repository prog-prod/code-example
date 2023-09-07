<?php

namespace App\Enums;

enum UserRoleEnum: int
{
    case USER = 1;
    case ADMIN = 2;
    case EDITOR = 3;
}
