<?php

declare(strict_types=1);

namespace App\Http\Requests\Accreditation;

use App\DTOs\Accreditation\AccreditationApplicationUpdateDto;
use App\Enums\General\ApplicationStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;

final class AccreditationApplicationUpdateRequest extends FormRequest
{
    public final function authorize(): bool
    {
        return Auth::check();
    }

    public final function rules(): array
    {
        return [
            'status' => ['nullable', 'string', new Enum(ApplicationStatusEnum::class)],
            'manager_comment' => ['nullable', 'string', 'max:2000'],
        ];
    }

    public final function toDto(): AccreditationApplicationUpdateDto
    {
        return new AccreditationApplicationUpdateDto(
            status: $this->validated('status'),
            manager_comment: $this->validated('manager_comment'),
        );
    }
}
