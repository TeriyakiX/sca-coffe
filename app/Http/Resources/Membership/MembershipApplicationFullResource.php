<?php

declare(strict_types=1);

namespace App\Http\Resources\Membership;

use App\Models\MembershipApplication;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin MembershipApplication
 */
final class MembershipApplicationFullResource extends JsonResource
{
    public final function toArray(Request $request): array
    {
        return [
            MembershipApplication::ID => $this->{MembershipApplication::ID},
            MembershipApplication::CATEGORY => $this->{MembershipApplication::CATEGORY}->value,
            'category_label' => $this->{MembershipApplication::CATEGORY}->label(),
            MembershipApplication::SPECIALIZATION => $this->{MembershipApplication::SPECIALIZATION}->value,
            'specialization_label' => $this->{MembershipApplication::SPECIALIZATION}->label(),
            MembershipApplication::STATUS => $this->{MembershipApplication::STATUS}->value,
            MembershipApplication::NAME => $this->{MembershipApplication::NAME},
            MembershipApplication::EMAIL => $this->{MembershipApplication::EMAIL},
            MembershipApplication::PHONE => $this->{MembershipApplication::PHONE},
            MembershipApplication::CITY => $this->{MembershipApplication::CITY},
            MembershipApplication::COMPANY => $this->{MembershipApplication::COMPANY},
            MembershipApplication::ABOUT => $this->{MembershipApplication::ABOUT},
            MembershipApplication::MANAGER_COMMENT => $this->{MembershipApplication::MANAGER_COMMENT},
            MembershipApplication::PROCESSED_AT => $this->{MembershipApplication::PROCESSED_AT}?->toIso8601String(),
            MembershipApplication::CREATED_AT => $this->{MembershipApplication::CREATED_AT}?->toIso8601String(),
        ];
    }
}
