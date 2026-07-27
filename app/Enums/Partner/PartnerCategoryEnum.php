<?php

declare(strict_types=1);

namespace App\Enums\Partner;

enum PartnerCategoryEnum: string
{
    case EQUIPMENT = 'equipment';
    case ROASTERY = 'roastery';
    case SUPPLIER = 'supplier';
    case SERVICE = 'service';
    case EDUCATION = 'education';
    case MEDIA = 'media';

    public final function label(): string
    {
        return __('enums/partner.category.' . $this->value);
    }
}
