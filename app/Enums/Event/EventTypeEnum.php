<?php

declare(strict_types=1);

namespace App\Enums\Event;

enum EventTypeEnum: string
{
    case CONFERENCE = 'conference';
    case SEMINAR = 'seminar';
    case WORKING_GROUP = 'working-group';
    case CHAMPIONSHIP = 'championship';
    case WEBINAR = 'webinar';

    public final function label(): string
    {
        return __('enums/event.type.' . $this->value);
    }
}
