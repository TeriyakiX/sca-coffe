<?php

declare(strict_types=1);

namespace App\Http\Requests\Membership;

use App\DTOs\Membership\MembershipApplicationListDto;
use App\Enums\General\ApplicationStatusEnum;
use App\Enums\Membership\MembershipCategoryEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;

final class MembershipApplicationListRequest extends FormRequest
{
    public final function authorize(): bool
    {
        return Auth::check();
    }

    public final function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'between:2,255'],
            'status' => ['nullable', 'string', new Enum(ApplicationStatusEnum::class)],
            'category' => ['nullable', 'string', new Enum(MembershipCategoryEnum::class)],
            'per_page' => ['nullable', 'integer', 'between:1,100'],
        ];
    }

    public final function toDto(): MembershipApplicationListDto
    {
        return new MembershipApplicationListDto(
            search: $this->validated('search'),
            status: $this->validated('status'),
            category: $this->validated('category'),
            perPage: (int)($this->validated('per_page') ?? 20),
        );
    }
}
