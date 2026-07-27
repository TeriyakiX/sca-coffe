<?php

declare(strict_types=1);

namespace App\Http\Resources\Accreditation;

use App\Models\AccreditationApplication;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin AccreditationApplication
 */
final class AccreditationApplicationFullResource extends JsonResource
{
    public final function toArray(Request $request): array
    {
        return [
            AccreditationApplication::ID => $this->{AccreditationApplication::ID},
            AccreditationApplication::TYPE => $this->{AccreditationApplication::TYPE}->value,
            'type_label' => $this->{AccreditationApplication::TYPE}->label(),
            AccreditationApplication::STATUS => $this->{AccreditationApplication::STATUS}->value,
            AccreditationApplication::ORGANIZATION => $this->{AccreditationApplication::ORGANIZATION},
            AccreditationApplication::INN => $this->{AccreditationApplication::INN},
            AccreditationApplication::CITY => $this->{AccreditationApplication::CITY},
            AccreditationApplication::CONTACT_NAME => $this->{AccreditationApplication::CONTACT_NAME},
            AccreditationApplication::CONTACT_POSITION => $this->{AccreditationApplication::CONTACT_POSITION},
            AccreditationApplication::EMAIL => $this->{AccreditationApplication::EMAIL},
            AccreditationApplication::PHONE => $this->{AccreditationApplication::PHONE},
            AccreditationApplication::SITE_URL => $this->{AccreditationApplication::SITE_URL},
            AccreditationApplication::PROGRAMS => $this->{AccreditationApplication::PROGRAMS},
            AccreditationApplication::FACILITIES => $this->{AccreditationApplication::FACILITIES},
            AccreditationApplication::MANAGER_COMMENT => $this->{AccreditationApplication::MANAGER_COMMENT},
            AccreditationApplication::PROCESSED_AT => $this->{AccreditationApplication::PROCESSED_AT}?->toIso8601String(),
            AccreditationApplication::CREATED_AT => $this->{AccreditationApplication::CREATED_AT}?->toIso8601String(),
        ];
    }
}
