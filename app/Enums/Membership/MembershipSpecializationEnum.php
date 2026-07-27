<?php

declare(strict_types=1);

namespace App\Enums\Membership;

enum MembershipSpecializationEnum: string
{
    case BARISTA = 'barista';
    case TRAINER = 'trainer';
    case ROASTER = 'roaster';
    case TECHNOLOGIST = 'technologist';
    case TEA_SPECIALIST = 'tea-specialist';
    case COFFEE_SHOP_OWNER = 'coffee-shop-owner';
    case TRAINING_CENTER = 'training-center';
    case SUPPLIER = 'supplier';
    case OTHER = 'other';

    public final function label(): string
    {
        return __('enums/membership.specialization.' . $this->value);
    }
}
