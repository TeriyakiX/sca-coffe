<?php

declare(strict_types=1);

namespace App\Http\Requests\Membership;

use App\DTOs\Membership\MembershipApplicationUpdateDto;
use App\Enums\General\ApplicationStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;

final class MembershipApplicationUpdateRequest extends FormRequest
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

    public final function toDto(): MembershipApplicationUpdateDto
    {
        return new MembershipApplicationUpdateDto(
            status: $this->validated('status'),
            manager_comment: $this->validated('manager_comment'),
        );
    }
}
