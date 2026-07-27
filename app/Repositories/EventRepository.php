<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\Event\EventCreateDto;
use App\DTOs\Event\EventListDto;
use App\DTOs\Event\EventUpdateDto;
use App\Models\Event;
use App\QueryBuilders\EventQueryBuilder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final readonly class EventRepository
{
    public final function publishedList(EventListDto $dto): LengthAwarePaginator
    {
        return Event::query()
            ->published()
            ->when($dto->type, fn(EventQueryBuilder $builder) => $builder->byType($dto->type))
            ->when($dto->upcoming === true, fn(EventQueryBuilder $builder) => $builder->upcoming())
            ->when($dto->upcoming === false, fn(EventQueryBuilder $builder) => $builder->past())
            ->chronological()
            ->paginate($dto->perPage);
    }

    public final function adminList(EventListDto $dto): LengthAwarePaginator
    {
        return Event::query()
            ->when($dto->type, fn(EventQueryBuilder $builder) => $builder->byType($dto->type))
            ->chronological()
            ->paginate($dto->perPage);
    }

    public final function publishedBySlug(string $slug): Event|null
    {
        return Event::query()
            ->published()
            ->bySlug($slug)
            ->first();
    }

    public final function item(string $eventId): Event|null
    {
        return Event::query()->find($eventId);
    }

    public final function create(EventCreateDto $dto): Event
    {
        return Event::query()->create([
            Event::TITLE => $dto->title,
            Event::SLUG => $dto->slug,
            Event::TYPE => $dto->type,
            Event::STARTS_AT => $dto->starts_at,
            Event::ENDS_AT => $dto->ends_at,
            Event::PLACE => $dto->place,
            Event::DESCRIPTION => $dto->description,
            Event::REGISTRATION_URL => $dto->registration_url,
            Event::STATUS => $dto->status,
        ]);
    }

    public final function update(Event $event, EventUpdateDto $dto): Event|null
    {
        return $event->update($dto->toArray())
            ? $event
            : null;
    }

    public final function delete(Event $event): bool
    {
        return $event->delete();
    }
}
