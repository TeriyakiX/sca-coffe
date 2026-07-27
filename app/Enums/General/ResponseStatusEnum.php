<?php

declare(strict_types=1);

namespace App\Enums\General;

enum ResponseStatusEnum: string
{
    case SUCCESS = 'success';
    case ERROR = 'error';
}
