<?php

declare(strict_types=1);

namespace App\DTOs\Page;

final readonly class PageCreateDto
{
    public final function __construct(
        public string      $title,
        public string      $slug,
        public string|null $content = null,
        public string|null $status = null,
        public int|null    $sort_order = null,
    )
    {
    }
}
