<?php

declare(strict_types=1);

namespace App\Http\Requests\Page;

use App\DTOs\Page\PageUpdateDto;
use App\Enums\General\PublicationStatusEnum;
use App\Models\Page;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

final class PageUpdateRequest extends FormRequest
{
    public final function authorize(): bool
    {
        return Auth::check();
    }

    public final function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'between:2,255'],
            'slug' => [
                'nullable',
                'string',
                'between:2,255',
                'alpha_dash',
                Rule::unique(Page::DATABASE_TABLE, Page::SLUG)->ignore($this->route('pageId'), Page::ID),
            ],
            'content' => ['nullable', 'string'],
            'status' => ['nullable', 'string', new Enum(PublicationStatusEnum::class)],
            'sort_order' => ['nullable', 'integer', 'between:0,9999'],
        ];
    }

    public final function toDto(): PageUpdateDto
    {
        return new PageUpdateDto(
            title: $this->validated('title'),
            slug: $this->validated('slug'),
            content: $this->validated('content'),
            status: $this->validated('status'),
            sort_order: $this->validated('sort_order'),
        );
    }
}
