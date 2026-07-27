<?php

declare(strict_types=1);

namespace App\Enums\General;

enum ApplicationStatusEnum: string
{
    case NEW = 'new';
    case IN_REVIEW = 'in_review';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
}
