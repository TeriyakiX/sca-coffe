<?php

declare(strict_types=1);

namespace App\DTOs\Page;

use App\Traits\DTOs\UseAsArrayTrait;

final readonly class PageUpdateDto
{
    use UseAsArrayTrait;

    public final function __construct(
        public string|null $title = null,
        public string|null $slug = null,
        public string|null $content = null,
        public string|null $status = null,
        public int|null    $sort_order = null,
    )
    {
    }
}
