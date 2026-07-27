<?php

declare(strict_types=1);

namespace App\Enums\Contact;

use App\Models\ContactRequest;

enum ContactRequestIndexEnum: string
{
    case INDEX_STATUS = 'ix_' . ContactRequest::DATABASE_TABLE . '_' . ContactRequest::STATUS;
    case INDEX_TOPIC = 'ix_' . ContactRequest::DATABASE_TABLE . '_' . ContactRequest::TOPIC;
    case INDEX_EMAIL = 'ix_' . ContactRequest::DATABASE_TABLE . '_' . ContactRequest::EMAIL;
}
