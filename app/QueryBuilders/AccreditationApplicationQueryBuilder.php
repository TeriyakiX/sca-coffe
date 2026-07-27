<?php

declare(strict_types=1);

namespace App\QueryBuilders;

use App\Models\AccreditationApplication;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin AccreditationApplication
 */
final class AccreditationApplicationQueryBuilder extends Builder
{
    public final function search(string $search): self
    {
        $words = explode(' ', $search);

        return $this->where(function (self $builder) use ($words) {
            foreach ($words as $index => $word) {
                $method = $index === 0 ? 'where' : 'orWhere';

                $builder->$method(AccreditationApplication::ORGANIZATION, 'LIKE', "%$word%")
                    ->orWhere(AccreditationApplication::EMAIL, 'LIKE', "%$word%")
                    ->orWhere(AccreditationApplication::CONTACT_NAME, 'LIKE', "%$word%");
            }
        });
    }

    public final function byStatus(string $status): self
    {
        return $this->where(AccreditationApplication::STATUS, $status);
    }

    public final function byType(string $type): self
    {
        return $this->where(AccreditationApplication::TYPE, $type);
    }

    public final function newestFirst(): self
    {
        return $this->orderByDesc(AccreditationApplication::CREATED_AT);
    }
}
