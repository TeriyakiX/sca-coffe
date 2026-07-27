<?php

declare(strict_types=1);

namespace App\DTOs\Event;

final readonly class EventCreateDto
{
    public final function __construct(
        public string      $title,
        public string      $slug,
        public string      $type,
        public string      $starts_at,
        public string|null $ends_at = null,
        public string|null $place = null,
        public string|null $description = null,
        public string|null $registration_url = null,
        public string|null $status = null,
    )
    {
    }
}
