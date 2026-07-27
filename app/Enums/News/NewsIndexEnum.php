<?php

declare(strict_types=1);

namespace App\Enums\News;

use App\Models\News;

enum NewsIndexEnum: string
{
    case UNIQUE_INDEX_ID = 'ixu_' . News::DATABASE_TABLE . '_' . News::ID;
    case UNIQUE_INDEX_SLUG = 'ixu_' . News::DATABASE_TABLE . '_' . News::SLUG;
    case INDEX_CATEGORY = 'ix_' . News::DATABASE_TABLE . '_' . News::CATEGORY;
    case INDEX_STATUS = 'ix_' . News::DATABASE_TABLE . '_' . News::STATUS;
    case INDEX_PUBLISHED_AT = 'ix_' . News::DATABASE_TABLE . '_' . News::PUBLISHED_AT;
}
