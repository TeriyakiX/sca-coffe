<?php

declare(strict_types=1);

namespace App\Services\Event;

use App\DTOs\Event\EventCreateDto;
use App\DTOs\Event\EventListDto;
use App\DTOs\Event\EventUpdateDto;
use App\Exceptions\Event\EventDeleteFailedException;
use App\Exceptions\Event\EventNotFoundException;
use App\Exceptions\Event\EventUpdateEmptyDataException;
use App\Exceptions\Event\EventUpdateFailedException;
use App\Models\Event;
use App\Repositories\EventRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final readonly class EventService
{
    public final function __construct(
        private EventRepository $repository,
    )
    {
    }

    public final function list(EventListDto $dto): LengthAwarePaginator
    {
        return $this->repository->publishedList($dto);
    }

    public final function adminList(EventListDto $dto): LengthAwarePaginator
    {
        return $this->repository->adminList($dto);
    }

    /**
     * @throws EventNotFoundException
     */
    public final function item(string $slug): Event
    {
        return $this->repository->publishedBySlug($slug) ?? throw new EventNotFoundException();
    }

    public final function create(EventCreateDto $dto): Event
    {
        return $this->repository->create($dto);
    }

    /**
     * @throws EventUpdateEmptyDataException|EventNotFoundException|EventUpdateFailedException
     */
    public final function update(Event|string $event, EventUpdateDto $dto): Event
    {
        if (empty($dto->toArray())) {
            throw new EventUpdateEmptyDataException();
        }

        if (is_string($event) && !$event = $this->repository->item($event)) {
            throw new EventNotFoundException();
        }

        return $this->repository->update($event, $dto) ?? throw new EventUpdateFailedException();
    }

    /**
     * @throws EventNotFoundException|EventDeleteFailedException
     */
    public final function delete(Event|string $event): bool
    {
        if (is_string($event) && !$event = $this->repository->item($event)) {
            throw new EventNotFoundException();
        }

        return $this->repository->delete($event) ?: throw new EventDeleteFailedException();
    }
}
