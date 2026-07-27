<?php

declare(strict_types=1);

namespace App\DTOs\News;

final readonly class NewsCreateDto
{
    public final function __construct(
        public string      $title,
        public string      $slug,
        public string      $category,
        public string      $excerpt,
        public string|null $content = null,
        public string|null $cover_url = null,
        public string|null $status = null,
        public string|null $published_at = null,
    )
    {
    }
}
