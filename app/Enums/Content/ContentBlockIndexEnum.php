<?php

declare(strict_types=1);

namespace App\Enums\Content;

use App\Models\ContentBlock;

enum ContentBlockIndexEnum: string
{
    case UNIQUE_INDEX_KEY = 'ixu_' . ContentBlock::DATABASE_TABLE . '_' . ContentBlock::KEY;
    case INDEX_SECTION = 'ix_' . ContentBlock::DATABASE_TABLE . '_' . ContentBlock::SECTION;
    case INDEX_SORT_ORDER = 'ix_' . ContentBlock::DATABASE_TABLE . '_' . ContentBlock::SORT_ORDER;
}
