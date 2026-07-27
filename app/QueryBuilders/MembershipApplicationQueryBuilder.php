<?php

declare(strict_types=1);

namespace App\QueryBuilders;

use App\Models\MembershipApplication;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin MembershipApplication
 */
final class MembershipApplicationQueryBuilder extends Builder
{
    public final function search(string $search): self
    {
        $words = explode(' ', $search);

        return $this->where(function (self $builder) use ($words) {
            foreach ($words as $index => $word) {
                $method = $index === 0 ? 'where' : 'orWhere';

                $builder->$method(MembershipApplication::NAME, 'LIKE', "%$word%")
                    ->orWhere(MembershipApplication::EMAIL, 'LIKE', "%$word%")
                    ->orWhere(MembershipApplication::COMPANY, 'LIKE', "%$word%");
            }
        });
    }

    public final function byStatus(string $status): self
    {
        return $this->where(MembershipApplication::STATUS, $status);
    }

    public final function byCategory(string $category): self
    {
        return $this->where(MembershipApplication::CATEGORY, $category);
    }

    public final function newestFirst(): self
    {
        return $this->orderByDesc(MembershipApplication::CREATED_AT);
    }
}
