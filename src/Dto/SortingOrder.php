<?php

declare(strict_types=1);

namespace App\Dto;

enum SortingOrder: string
{
    case ASC = 'asc';
    case DESC = 'desc';
}
