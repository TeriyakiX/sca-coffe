<?php

declare(strict_types=1);

namespace App\Http\Requests\Membership;

use App\DTOs\Membership\MembershipApplicationCreateDto;
use App\Enums\Membership\MembershipCategoryEnum;
use App\Enums\Membership\MembershipSpecializationEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

final class MembershipApplicationCreateRequest extends FormRequest
{
    public final function authorize(): bool
    {
        return true;
    }

    public final function rules(): array
    {
        return [
            'category' => ['required', 'string', new Enum(MembershipCategoryEnum::class)],
            'specialization' => ['required', 'string', new Enum(MembershipSpecializationEnum::class)],
            'name' => ['required', 'string', 'between:2,255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'between:5,32'],
            'city' => ['required', 'string', 'between:2,120'],
            'company' => ['nullable', 'string', 'between:2,255'],
            'about' => ['nullable', 'string', 'max:2000'],
        ];
    }

    public final function toDto(): MembershipApplicationCreateDto
    {
        return new MembershipApplicationCreateDto(
            category: $this->validated('category'),
            specialization: $this->validated('specialization'),
            name: $this->validated('name'),
            email: $this->validated('email'),
            phone: $this->validated('phone'),
            city: $this->validated('city'),
            company: $this->validated('company'),
            about: $this->validated('about'),
        );
    }
}
