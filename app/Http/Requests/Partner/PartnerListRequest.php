<?php

declare(strict_types=1);

namespace App\Http\Requests\Partner;

use App\DTOs\Partner\PartnerListDto;
use App\Enums\Partner\PartnerCategoryEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

final class PartnerListRequest extends FormRequest
{
    public final function authorize(): bool
    {
        return true;
    }

    public final function rules(): array
    {
        return [
            'category' => ['nullable', 'string', new Enum(PartnerCategoryEnum::class)],
        ];
    }

    public final function toDto(): PartnerListDto
    {
        return new PartnerListDto(
            category: $this->validated('category'),
        );
    }
}
