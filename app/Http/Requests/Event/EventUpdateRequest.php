<?php

declare(strict_types=1);

namespace App\Http\Requests\Event;

use App\DTOs\Event\EventUpdateDto;
use App\Enums\Event\EventTypeEnum;
use App\Enums\General\PublicationStatusEnum;
use App\Models\Event;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

final class EventUpdateRequest extends FormRequest
{
    public final function authorize(): bool
    {
        return Auth::check();
    }

    public final function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'between:3,255'],
            'slug' => [
                'nullable',
                'string',
                'between:3,255',
                'alpha_dash',
                Rule::unique(Event::DATABASE_TABLE, Event::SLUG)->ignore($this->route('eventId'), Event::ID),
            ],
            'type' => ['nullable', 'string', new Enum(EventTypeEnum::class)],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'place' => ['nullable', 'string', 'between:2,255'],
            'description' => ['nullable', 'string'],
            'registration_url' => ['nullable', 'string', 'url', 'max:2048'],
            'status' => ['nullable', 'string', new Enum(PublicationStatusEnum::class)],
        ];
    }

    public final function toDto(): EventUpdateDto
    {
        return new EventUpdateDto(
            title: $this->validated('title'),
            slug: $this->validated('slug'),
            type: $this->validated('type'),
            starts_at: $this->validated('starts_at'),
            ends_at: $this->validated('ends_at'),
            place: $this->validated('place'),
            description: $this->validated('description'),
            registration_url: $this->validated('registration_url'),
            status: $this->validated('status'),
        );
    }
}
