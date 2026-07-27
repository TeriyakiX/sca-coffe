<?php

declare(strict_types=1);

namespace App\QueryBuilders;

use App\Models\ContactRequest;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin ContactRequest
 */
final class ContactRequestQueryBuilder extends Builder
{
    public final function byStatus(string $status): self
    {
        return $this->where(ContactRequest::STATUS, $status);
    }

    public final function byTopic(string $topic): self
    {
        return $this->where(ContactRequest::TOPIC, $topic);
    }

    public final function newestFirst(): self
    {
        return $this->orderByDesc(ContactRequest::CREATED_AT);
    }
}
