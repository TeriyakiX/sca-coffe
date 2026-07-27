<?php

declare(strict_types=1);

namespace App\Http\Requests\Accreditation;

use App\DTOs\Accreditation\AccreditationApplicationCreateDto;
use App\Enums\Accreditation\AccreditationTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

final class AccreditationApplicationCreateRequest extends FormRequest
{
    public final function authorize(): bool
    {
        return true;
    }

    public final function rules(): array
    {
        return [
            'type' => ['required', 'string', new Enum(AccreditationTypeEnum::class)],
            'organization' => ['required', 'string', 'between:2,255'],
            'inn' => ['nullable', 'string', 'digits_between:10,12'],
            'city' => ['required', 'string', 'between:2,120'],
            'contact_name' => ['required', 'string', 'between:2,255'],
            'contact_position' => ['nullable', 'string', 'between:2,255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'between:5,32'],
            'site_url' => ['nullable', 'string', 'url', 'max:2048'],
            'programs' => ['nullable', 'string', 'max:3000'],
            'facilities' => ['nullable', 'string', 'max:3000'],
        ];
    }

    public final function toDto(): AccreditationApplicationCreateDto
    {
        return new AccreditationApplicationCreateDto(
            type: $this->validated('type'),
            organization: $this->validated('organization'),
            city: $this->validated('city'),
            contact_name: $this->validated('contact_name'),
            email: $this->validated('email'),
            phone: $this->validated('phone'),
            inn: $this->validated('inn'),
            contact_position: $this->validated('contact_position'),
            site_url: $this->validated('site_url'),
            programs: $this->validated('programs'),
            facilities: $this->validated('facilities'),
        );
    }
}
