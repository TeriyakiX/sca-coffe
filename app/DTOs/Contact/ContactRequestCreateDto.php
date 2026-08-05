<?php

declare(strict_types=1);

namespace App\DTOs\Contact;

final readonly class ContactRequestCreateDto
{
    public final function __construct(
        public string $topic,
        public string $name,
        public string $email,
        public string $message,
        public string|null $phone = null,
        public bool   $marketingConsent = false,
    )
    {
    }
}
