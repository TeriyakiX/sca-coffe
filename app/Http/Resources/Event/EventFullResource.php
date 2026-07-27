<?php

declare(strict_types=1);

namespace App\Http\Resources\Event;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Event
 */
final class EventFullResource extends JsonResource
{
    public final function toArray(Request $request): array
    {
        return [
            Event::ID => $this->{Event::ID},
            Event::SLUG => $this->{Event::SLUG},
            Event::TYPE => $this->{Event::TYPE}->value,
            'type_label' => $this->{Event::TYPE}->label(),
            Event::STATUS => $this->{Event::STATUS}->value,
            Event::TITLE => $this->{Event::TITLE},
            Event::DESCRIPTION => $this->{Event::DESCRIPTION},
            Event::PLACE => $this->{Event::PLACE},
            Event::REGISTRATION_URL => $this->{Event::REGISTRATION_URL},
            Event::STARTS_AT => $this->{Event::STARTS_AT}?->toIso8601String(),
            Event::ENDS_AT => $this->{Event::ENDS_AT}?->toIso8601String(),
        ];
    }
}
