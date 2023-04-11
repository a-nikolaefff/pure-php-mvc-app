<?php

declare(strict_types=1);

namespace App\Dto;

enum SortingCriterion: string
{
    case USER_NAME = 'user_name';
    case USER_EMAIL = 'user_email';
    case DESCRIPTION = 'description';
    case IS_DONE = 'is_done';
    case CREATED_AT = 'created_at';
}
