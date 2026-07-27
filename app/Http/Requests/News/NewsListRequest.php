<?php

declare(strict_types=1);

namespace App\Http\Requests\News;

use App\DTOs\News\NewsListDto;
use App\Enums\News\NewsCategoryEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

final class NewsListRequest extends FormRequest
{
    public final function authorize(): bool
    {
        return true;
    }

    public final function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'between:2,255'],
            'category' => ['nullable', 'string', new Enum(NewsCategoryEnum::class)],
            'categories' => ['nullable', 'array', 'between:1,10'],
            'categories.*' => ['required', 'string', new Enum(NewsCategoryEnum::class)],
            'per_page' => ['nullable', 'integer', 'between:1,100'],
        ];
    }

    public final function toDto(): NewsListDto
    {
        return new NewsListDto(
            search: $this->validated('search'),
            category: $this->validated('category'),
            categories: $this->validated('categories'),
            perPage: (int)($this->validated('per_page') ?? 12),
        );
    }
}
