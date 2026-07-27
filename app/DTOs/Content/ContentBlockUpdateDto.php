<?php

declare(strict_types=1);

namespace App\DTOs\Content;

use App\Traits\DTOs\UseAsArrayTrait;

final readonly class ContentBlockUpdateDto
{
    use UseAsArrayTrait;

    public final function __construct(
        public string|null $title = null,
        public string|null $subtitle = null,
        public string|null $body = null,
        public array|null  $items = null,
        public int|null    $sort_order = null,
    )
    {
    }
}
