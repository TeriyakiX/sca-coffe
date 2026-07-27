<?php

declare(strict_types=1);

namespace App\Http\Requests\Accreditation;

use App\DTOs\Accreditation\AccreditationApplicationListDto;
use App\Enums\Accreditation\AccreditationTypeEnum;
use App\Enums\General\ApplicationStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;

final class AccreditationApplicationListRequest extends FormRequest
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
            'type' => ['nullable', 'string', new Enum(AccreditationTypeEnum::class)],
            'per_page' => ['nullable', 'integer', 'between:1,100'],
        ];
    }

    public final function toDto(): AccreditationApplicationListDto
    {
        return new AccreditationApplicationListDto(
            search: $this->validated('search'),
            status: $this->validated('status'),
            type: $this->validated('type'),
            perPage: (int)($this->validated('per_page') ?? 20),
        );
    }
}
