<?php

declare(strict_types=1);

namespace App\Http\Requests\Event;

use App\DTOs\Event\EventListDto;
use App\Enums\Event\EventTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

final class EventListRequest extends FormRequest
{
    public final function authorize(): bool
    {
        return true;
    }

    public final function rules(): array
    {
        return [
            'type' => ['nullable', 'string', new Enum(EventTypeEnum::class)],
            'upcoming' => ['nullable', 'boolean'],
            'per_page' => ['nullable', 'integer', 'between:1,100'],
        ];
    }

    public final function toDto(): EventListDto
    {
        return new EventListDto(
            type: $this->validated('type'),
            upcoming: $this->has('upcoming') ? $this->boolean('upcoming') : null,
            perPage: (int)($this->validated('per_page') ?? 12),
        );
    }
}
