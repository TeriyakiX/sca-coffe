<?php

declare(strict_types=1);

namespace App\Enums\Partner;

use App\Models\Partner;

enum PartnerIndexEnum: string
{
    case UNIQUE_INDEX_SLUG = 'ixu_' . Partner::DATABASE_TABLE . '_' . Partner::SLUG;
    case INDEX_CATEGORY = 'ix_' . Partner::DATABASE_TABLE . '_' . Partner::CATEGORY;
    case INDEX_STATUS = 'ix_' . Partner::DATABASE_TABLE . '_' . Partner::STATUS;
}
