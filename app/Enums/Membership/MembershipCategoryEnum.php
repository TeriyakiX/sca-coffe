<?php

declare(strict_types=1);

namespace App\Enums\Membership;

enum MembershipCategoryEnum: string
{
    case INDIVIDUAL = 'individual';
    case CORPORATE = 'corporate';
    case TRAINING_CENTER = 'training-center';
    case PARTNER = 'partner';

    public final function label(): string
    {
        return __('enums/membership.category.' . $this->value);
    }
}
