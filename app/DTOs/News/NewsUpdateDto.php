<?php

declare(strict_types=1);

namespace App\DTOs\News;

use App\Traits\DTOs\UseAsArrayTrait;

final readonly class NewsUpdateDto
{
    use UseAsArrayTrait;

    public final function __construct(
        public string|null $title = null,
        public string|null $slug = null,
        public string|null $category = null,
        public string|null $excerpt = null,
        public string|null $author = null,
        public string|null $content = null,
        public string|null $cover_url = null,
        public string|null $status = null,
        public string|null $published_at = null,
    )
    {
    }
}
