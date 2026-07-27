<?php

declare(strict_types=1);

namespace App\Enums\Page;

use App\Models\Page;

enum PageIndexEnum: string
{
    case UNIQUE_INDEX_SLUG = 'ixu_' . Page::DATABASE_TABLE . '_' . Page::SLUG;
    case INDEX_STATUS = 'ix_' . Page::DATABASE_TABLE . '_' . Page::STATUS;
    case INDEX_SORT_ORDER = 'ix_' . Page::DATABASE_TABLE . '_' . Page::SORT_ORDER;
}
