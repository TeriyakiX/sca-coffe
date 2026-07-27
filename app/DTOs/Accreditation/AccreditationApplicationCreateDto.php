<?php

declare(strict_types=1);

namespace App\DTOs\Accreditation;

final readonly class AccreditationApplicationCreateDto
{
    public final function __construct(
        public string      $type,
        public string      $organization,
        public string      $city,
        public string      $contact_name,
        public string      $email,
        public string      $phone,
        public string|null $inn = null,
        public string|null $contact_position = null,
        public string|null $site_url = null,
        public string|null $programs = null,
        public string|null $facilities = null,
    )
    {
    }
}
