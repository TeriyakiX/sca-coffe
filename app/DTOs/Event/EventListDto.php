<?php

declare(strict_types=1);

namespace App\DTOs\Event;

final readonly class EventListDto
{
    public final function __construct(
        public string|null $type = null,
        public bool|null   $upcoming = null,
        public int         $perPage = 12,
    )
    {
    }
}
