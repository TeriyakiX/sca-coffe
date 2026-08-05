<?php

declare(strict_types=1);

namespace App\DTOs\Membership;

final readonly class MembershipApplicationCreateDto
{
    public final function __construct(
        public string      $category,
        public string      $specialization,
        public string      $name,
        public string      $email,
        public string      $phone,
        public string      $city,
        public string|null $company = null,
        public string|null $about = null,
        public bool        $expertInterest = false,
        public bool        $marketingConsent = false,
    )
    {
    }
}
