<?php

declare(strict_types=1);

namespace App\Http\Resources\News;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin News
 */
final class NewsFullResource extends JsonResource
{
    public final function toArray(Request $request): array
    {
        return [
            News::ID => $this->{News::ID},
            News::SLUG => $this->{News::SLUG},
            News::CATEGORY => $this->{News::CATEGORY}->value,
            'category_label' => $this->{News::CATEGORY}->label(),
            News::STATUS => $this->{News::STATUS}->value,
            News::TITLE => $this->{News::TITLE},
            News::EXCERPT => $this->{News::EXCERPT},
            News::AUTHOR => $this->{News::AUTHOR},
            News::CONTENT => $this->{News::CONTENT},
            News::COVER_URL => $this->{News::COVER_URL},
            News::PUBLISHED_AT => $this->{News::PUBLISHED_AT}?->toIso8601String(),
            News::UPDATED_AT => $this->{News::UPDATED_AT}?->toIso8601String(),
        ];
    }
}
