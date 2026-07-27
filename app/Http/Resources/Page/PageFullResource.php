<?php

declare(strict_types=1);

namespace App\Http\Resources\Page;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Page
 */
final class PageFullResource extends JsonResource
{
    public final function toArray(Request $request): array
    {
        return [
            Page::ID => $this->{Page::ID},
            Page::SLUG => $this->{Page::SLUG},
            Page::TITLE => $this->{Page::TITLE},
            Page::CONTENT => $this->{Page::CONTENT},
            Page::STATUS => $this->{Page::STATUS}->value,
            Page::SORT_ORDER => $this->{Page::SORT_ORDER},
        ];
    }
}
