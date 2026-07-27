<?php

declare(strict_types=1);

namespace App\Http\Requests\Partner;

use App\DTOs\Partner\PartnerUpdateDto;
use App\Enums\General\PublicationStatusEnum;
use App\Enums\Partner\PartnerCategoryEnum;
use App\Models\Partner;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

final class PartnerUpdateRequest extends FormRequest
{
    public final function authorize(): bool
    {
        return Auth::check();
    }

    public final function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'between:2,255'],
            'slug' => [
                'nullable',
                'string',
                'between:2,255',
                'alpha_dash',
                Rule::unique(Partner::DATABASE_TABLE, Partner::SLUG)->ignore($this->route('partnerId'), Partner::ID),
            ],
            'category' => ['nullable', 'string', new Enum(PartnerCategoryEnum::class)],
            'description' => ['nullable', 'string', 'max:1000'],
            'benefit' => ['nullable', 'string', 'max:1000'],
            'logo_url' => ['nullable', 'string', 'url', 'max:2048'],
            'site_url' => ['nullable', 'string', 'url', 'max:2048'],
            'status' => ['nullable', 'string', new Enum(PublicationStatusEnum::class)],
            'sort_order' => ['nullable', 'integer', 'between:0,9999'],
        ];
    }

    public final function toDto(): PartnerUpdateDto
    {
        return new PartnerUpdateDto(
            name: $this->validated('name'),
            slug: $this->validated('slug'),
            category: $this->validated('category'),
            description: $this->validated('description'),
            benefit: $this->validated('benefit'),
            logo_url: $this->validated('logo_url'),
            site_url: $this->validated('site_url'),
            status: $this->validated('status'),
            sort_order: $this->validated('sort_order'),
        );
    }
}
