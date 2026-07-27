<?php

declare(strict_types=1);

namespace App\DTOs\Accreditation;

final readonly class AccreditationApplicationListDto
{
    public final function __construct(
        public string|null $search = null,
        public string|null $status = null,
        public string|null $type = null,
        public int         $perPage = 20,
    )
    {
    }
}
