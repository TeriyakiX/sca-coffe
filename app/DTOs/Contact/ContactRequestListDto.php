<?php

declare(strict_types=1);

namespace App\DTOs\Contact;

final readonly class ContactRequestListDto
{
    public final function __construct(
        public string|null $status = null,
        public string|null $topic = null,
        public int         $perPage = 20,
    )
    {
    }
}
