<?php

declare(strict_types=1);

namespace App\Http\Resources\Partner;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Partner
 */
final class PartnerFullResource extends JsonResource
{
    public final function toArray(Request $request): array
    {
        return [
            Partner::ID => $this->{Partner::ID},
            Partner::SLUG => $this->{Partner::SLUG},
            Partner::CATEGORY => $this->{Partner::CATEGORY}->value,
            'category_label' => $this->{Partner::CATEGORY}->label(),
            Partner::STATUS => $this->{Partner::STATUS}->value,
            Partner::NAME => $this->{Partner::NAME},
            Partner::DESCRIPTION => $this->{Partner::DESCRIPTION},
            Partner::BENEFIT => $this->{Partner::BENEFIT},
            Partner::LOGO_URL => $this->{Partner::LOGO_URL},
            Partner::SITE_URL => $this->{Partner::SITE_URL},
        ];
    }
}
