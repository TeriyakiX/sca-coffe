<?php

declare(strict_types=1);

namespace App\Enums\Contact;

enum ContactTopicEnum: string
{
    case MEMBERSHIP = 'membership';
    case ACCREDITATION = 'accreditation';
    case WORKING_GROUP = 'working-group';
    case PARTNERSHIP = 'partnership';
    case PRESS = 'press';
    case OTHER = 'other';

    public final function label(): string
    {
        return __('enums/contact.topic.' . $this->value);
    }
}
