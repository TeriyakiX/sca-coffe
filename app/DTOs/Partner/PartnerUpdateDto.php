<?php

declare(strict_types=1);

namespace App\DTOs\Partner;

use App\Traits\DTOs\UseAsArrayTrait;

final readonly class PartnerUpdateDto
{
    use UseAsArrayTrait;

    public final function __construct(
        public string|null $name = null,
        public string|null $slug = null,
        public string|null $category = null,
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
