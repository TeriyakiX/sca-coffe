<?php

declare(strict_types=1);

namespace App\Http\Requests\Page;

use App\DTOs\Page\PageCreateDto;
use App\Enums\General\PublicationStatusEnum;
use App\Models\Page;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

final class PageCreateRequest extends FormRequest
{
    public final function authorize(): bool
    {
        return Auth::check();
    }

    public final function rules(): array
    {
        return [
            'title' => ['required', 'string', 'between:2,255'],
            'slug' => ['required', 'string', 'between:2,255', 'alpha_dash', Rule::unique(Page::DATABASE_TABLE, Page::SLUG)],
            'content' => ['nullable', 'string'],
            'status' => ['nullable', 'string', new Enum(PublicationStatusEnum::class)],
            'sort_order' => ['nullable', 'integer', 'between:0,9999'],
        ];
    }

    public final function toDto(): PageCreateDto
    {
        return new PageCreateDto(
            title: $this->validated('title'),
            slug: $this->validated('slug'),
            content: $this->validated('content'),
            status: $this->validated('status'),
            sort_order: $this->validated('sort_order'),
        );
    }
}
