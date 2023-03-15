<?php

declare(strict_types=1);

namespace App\Dto;

enum SortingCriterion
{
    case UserName;
    case UserEmail;
    case Description;
    case IsDone;
    case CreatedAt;
}
