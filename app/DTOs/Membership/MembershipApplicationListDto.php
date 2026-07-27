<?php

declare(strict_types=1);

namespace App\DTOs\Membership;

final readonly class MembershipApplicationListDto
{
    public final function __construct(
        public string|null $search = null,
        public string|null $status = null,
        public string|null $category = null,
        public int         $perPage = 20,
    )
    {
    }
}
