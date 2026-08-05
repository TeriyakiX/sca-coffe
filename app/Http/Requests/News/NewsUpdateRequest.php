<?php

declare(strict_types=1);

namespace App\Http\Requests\News;

use App\DTOs\News\NewsUpdateDto;
use App\Enums\General\PublicationStatusEnum;
use App\Enums\News\NewsCategoryEnum;
use App\Models\News;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

final class NewsUpdateRequest extends FormRequest
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
                Rule::unique(News::DATABASE_TABLE, News::SLUG)->ignore($this->route('newsId'), News::ID),
            ],
            'category' => ['nullable', 'string', new Enum(NewsCategoryEnum::class)],
            'excerpt' => ['nullable', 'string', 'between:3,500'],
            'author' => ['nullable', 'string', 'between:2,255'],
            'content' => ['nullable', 'string'],
            'cover_url' => ['nullable', 'string', 'url', 'max:2048'],
            'status' => ['nullable', 'string', new Enum(PublicationStatusEnum::class)],
            'published_at' => ['nullable', 'date'],
        ];
    }

    public final function toDto(): NewsUpdateDto
    {
        return new NewsUpdateDto(
            title: $this->validated('title'),
            slug: $this->validated('slug'),
            category: $this->validated('category'),
            excerpt: $this->validated('excerpt'),
            author: $this->validated('author'),
            content: $this->validated('content'),
            cover_url: $this->validated('cover_url'),
            status: $this->validated('status'),
            published_at: $this->validated('published_at'),
        );
    }
}
