<?php

declare(strict_types=1);

namespace App\Http\Requests\News;

use App\DTOs\News\NewsCreateDto;
use App\Enums\General\PublicationStatusEnum;
use App\Enums\News\NewsCategoryEnum;
use App\Models\News;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

final class NewsCreateRequest extends FormRequest
{
    public final function authorize(): bool
    {
        return Auth::check();
    }

    public final function rules(): array
    {
        return [
            'title' => ['required', 'string', 'between:3,255'],
            'slug' => ['required', 'string', 'between:3,255', 'alpha_dash', Rule::unique(News::DATABASE_TABLE, News::SLUG)],
            'category' => ['required', 'string', new Enum(NewsCategoryEnum::class)],
            'excerpt' => ['required', 'string', 'between:3,500'],
            'content' => ['nullable', 'string'],
            'cover_url' => ['nullable', 'string', 'url', 'max:2048'],
            'status' => ['nullable', 'string', new Enum(PublicationStatusEnum::class)],
            'published_at' => ['nullable', 'date'],
        ];
    }

    public final function toDto(): NewsCreateDto
    {
        return new NewsCreateDto(
            title: $this->validated('title'),
            slug: $this->validated('slug'),
            category: $this->validated('category'),
            excerpt: $this->validated('excerpt'),
            content: $this->validated('content'),
            cover_url: $this->validated('cover_url'),
            status: $this->validated('status'),
            published_at: $this->validated('published_at'),
        );
    }
}
