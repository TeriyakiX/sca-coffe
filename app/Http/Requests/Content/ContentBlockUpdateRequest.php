<?php

declare(strict_types=1);

namespace App\Http\Requests\Content;

use App\DTOs\Content\ContentBlockUpdateDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class ContentBlockUpdateRequest extends FormRequest
{
    public final function authorize(): bool
    {
        return Auth::check();
    }

    public final function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:500'],
            'body' => ['nullable', 'string', 'max:5000'],
            'items' => ['nullable', 'array', 'max:50'],
            'sort_order' => ['nullable', 'integer', 'between:0,9999'],
        ];
    }

    public final function toDto(): ContentBlockUpdateDto
    {
        return new ContentBlockUpdateDto(
            title: $this->validated('title'),
            subtitle: $this->validated('subtitle'),
            body: $this->validated('body'),
            items: $this->validated('items'),
            sort_order: $this->validated('sort_order'),
        );
    }
}
