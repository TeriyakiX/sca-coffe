<?php

declare(strict_types=1);

namespace App\DTOs\Partner;

final readonly class PartnerListDto
{
    public final function __construct(
        public string|null $category = null,
    )
    {
    }
}
