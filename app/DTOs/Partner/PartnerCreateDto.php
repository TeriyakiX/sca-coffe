<?php

declare(strict_types=1);

namespace App\DTOs\Partner;

final readonly class PartnerCreateDto
{
    public final function __construct(
        public string      $name,
        public string      $slug,
        public string      $category,
        public string|null $description = null,
        public string|null $benefit = null,
        public string|null $logo_url = null,
        public string|null $site_url = null,
        public string|null $status = null,
        public int|null    $sort_order = null,
    )
    {
    }
}
