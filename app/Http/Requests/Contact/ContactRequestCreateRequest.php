<?php

declare(strict_types=1);

namespace App\Http\Requests\Contact;

use App\DTOs\Contact\ContactRequestCreateDto;
use App\Enums\Contact\ContactTopicEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

final class ContactRequestCreateRequest extends FormRequest
{
    public final function authorize(): bool
    {
        return true;
    }

    public final function rules(): array
    {
        return [
            'topic' => ['required', 'string', new Enum(ContactTopicEnum::class)],
            'name' => ['required', 'string', 'between:2,255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'message' => ['required', 'string', 'between:10,3000'],
        ];
    }

    public final function toDto(): ContactRequestCreateDto
    {
        return new ContactRequestCreateDto(
            topic: $this->validated('topic'),
            name: $this->validated('name'),
            email: $this->validated('email'),
            message: $this->validated('message'),
        );
    }
}
