<?php

declare(strict_types=1);

namespace App\DTOs\Membership;

use App\Traits\DTOs\UseAsArrayTrait;

final readonly class MembershipApplicationUpdateDto
{
    use UseAsArrayTrait;

    public final function __construct(
        public string|null $status = null,
        public string|null $manager_comment = null,
    )
    {
    }
}
