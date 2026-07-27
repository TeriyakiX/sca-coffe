<?php

declare(strict_types=1);

namespace App\DTOs\Contact;

use App\Traits\DTOs\UseAsArrayTrait;

final readonly class ContactRequestUpdateDto
{
    use UseAsArrayTrait;

    public final function __construct(
        public string|null $status = null,
        public string|null $manager_comment = null,
    )
    {
    }
}
