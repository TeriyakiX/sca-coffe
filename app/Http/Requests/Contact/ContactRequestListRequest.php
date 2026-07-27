<?php

declare(strict_types=1);

namespace App\Http\Requests\Contact;

use App\DTOs\Contact\ContactRequestListDto;
use App\Enums\Contact\ContactTopicEnum;
use App\Enums\General\ApplicationStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;

final class ContactRequestListRequest extends FormRequest
{
    public final function authorize(): bool
    {
        return Auth::check();
    }

    public final function rules(): array
    {
        return [
            'status' => ['nullable', 'string', new Enum(ApplicationStatusEnum::class)],
            'topic' => ['nullable', 'string', new Enum(ContactTopicEnum::class)],
            'per_page' => ['nullable', 'integer', 'between:1,100'],
        ];
    }

    public final function toDto(): ContactRequestListDto
    {
        return new ContactRequestListDto(
            status: $this->validated('status'),
            topic: $this->validated('topic'),
            perPage: (int)($this->validated('per_page') ?? 20),
        );
    }
}
