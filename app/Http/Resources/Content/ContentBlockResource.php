<?php

declare(strict_types=1);

namespace App\Http\Resources\Content;

use App\Models\ContentBlock;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin ContentBlock
 */
final class ContentBlockResource extends JsonResource
{
    public final function toArray(Request $request): array
    {
        return [
            ContentBlock::ID => $this->{ContentBlock::ID},
            ContentBlock::KEY => $this->{ContentBlock::KEY},
            ContentBlock::SECTION => $this->{ContentBlock::SECTION}->value,
            ContentBlock::TITLE => $this->{ContentBlock::TITLE},
            ContentBlock::SUBTITLE => $this->{ContentBlock::SUBTITLE},
            ContentBlock::BODY => $this->{ContentBlock::BODY},
            ContentBlock::ITEMS => $this->{ContentBlock::ITEMS} ?? [],
            ContentBlock::SORT_ORDER => $this->{ContentBlock::SORT_ORDER},
        ];
    }
}
