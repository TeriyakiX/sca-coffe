<?php

declare(strict_types=1);

namespace App\Http\Resources\Contact;

use App\Models\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin ContactRequest
 */
final class ContactRequestFullResource extends JsonResource
{
    public final function toArray(Request $request): array
    {
        return [
            ContactRequest::ID => $this->{ContactRequest::ID},
            ContactRequest::TOPIC => $this->{ContactRequest::TOPIC}->value,
            'topic_label' => $this->{ContactRequest::TOPIC}->label(),
            ContactRequest::STATUS => $this->{ContactRequest::STATUS}->value,
            ContactRequest::NAME => $this->{ContactRequest::NAME},
            ContactRequest::EMAIL => $this->{ContactRequest::EMAIL},
            ContactRequest::MESSAGE => $this->{ContactRequest::MESSAGE},
            ContactRequest::MANAGER_COMMENT => $this->{ContactRequest::MANAGER_COMMENT},
            ContactRequest::PROCESSED_AT => $this->{ContactRequest::PROCESSED_AT}?->toIso8601String(),
            ContactRequest::CREATED_AT => $this->{ContactRequest::CREATED_AT}?->toIso8601String(),
        ];
    }
}
