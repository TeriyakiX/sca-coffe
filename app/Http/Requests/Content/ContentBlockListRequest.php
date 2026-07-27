<?php

declare(strict_types=1);

namespace App\Http\Requests\Content;

use App\Enums\Content\ContentSectionEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

final class ContentBlockListRequest extends FormRequest
{
    public final function authorize(): bool
    {
        return true;
    }

    public final function rules(): array
    {
        return [
            'section' => ['nullable', 'string', new Enum(ContentSectionEnum::class)],
        ];
    }

    public final function section(): string|null
    {
        return $this->validated('section');
    }
}
