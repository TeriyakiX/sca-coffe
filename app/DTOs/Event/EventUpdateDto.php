<?php

declare(strict_types=1);

namespace App\DTOs\Event;

use App\Traits\DTOs\UseAsArrayTrait;

final readonly class EventUpdateDto
{
    use UseAsArrayTrait;

    public final function __construct(
        public string|null $title = null,
        public string|null $slug = null,
        public string|null $type = null,
        public string|null $starts_at = null,
        public string|null $ends_at = null,
        public string|null $place = null,
        public string|null $description = null,
        public string|null $registration_url = null,
        public string|null $status = null,
    )
    {
    }
}
