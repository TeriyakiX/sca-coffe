<?php

declare(strict_types=1);

namespace App\DTOs\News;

final readonly class NewsListDto
{
    public final function __construct(
        public string|null $search = null,
        public string|null $category = null,
        public array|null  $categories = null,
        public int         $perPage = 12,
    )
    {
    }
}
