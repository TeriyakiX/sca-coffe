<?php

declare(strict_types=1);

namespace App\Enums\Event;

use App\Models\Event;

enum EventIndexEnum: string
{
    case UNIQUE_INDEX_SLUG = 'ixu_' . Event::DATABASE_TABLE . '_' . Event::SLUG;
    case INDEX_TYPE = 'ix_' . Event::DATABASE_TABLE . '_' . Event::TYPE;
    case INDEX_STATUS = 'ix_' . Event::DATABASE_TABLE . '_' . Event::STATUS;
    case INDEX_STARTS_AT = 'ix_' . Event::DATABASE_TABLE . '_' . Event::STARTS_AT;
}
