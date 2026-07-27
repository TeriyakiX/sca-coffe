<?php

declare(strict_types=1);

namespace App\QueryBuilders;

use App\Enums\General\PublicationStatusEnum;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Event
 */
final class EventQueryBuilder extends Builder
{
    public final function published(): self
    {
        return $this->where(Event::STATUS, PublicationStatusEnum::PUBLISHED->value);
    }

    public final function byType(string $type): self
    {
        return $this->where(Event::TYPE, $type);
    }

    public final function bySlug(string $slug): self
    {
        return $this->where(Event::SLUG, $slug);
    }

    public final function upcoming(): self
    {
        return $this->where(Event::STARTS_AT, '>=', now());
    }

    public final function past(): self
    {
        return $this->where(Event::STARTS_AT, '<', now());
    }

    public final function chronological(): self
    {
        return $this->orderBy(Event::STARTS_AT);
    }
}
