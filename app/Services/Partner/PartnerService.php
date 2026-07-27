<?php

declare(strict_types=1);

namespace App\Services\Partner;

use App\DTOs\Partner\PartnerCreateDto;
use App\DTOs\Partner\PartnerListDto;
use App\DTOs\Partner\PartnerUpdateDto;
use App\Exceptions\Partner\PartnerDeleteFailedException;
use App\Exceptions\Partner\PartnerNotFoundException;
use App\Exceptions\Partner\PartnerUpdateEmptyDataException;
use App\Exceptions\Partner\PartnerUpdateFailedException;
use App\Models\Partner;
use App\Repositories\PartnerRepository;
use Illuminate\Database\Eloquent\Collection;

final readonly class PartnerService
{
    public final function __construct(
        private PartnerRepository $repository,
    )
    {
    }

    public final function list(PartnerListDto $dto): Collection
    {
        return $this->repository->publishedList($dto);
    }

    public final function adminList(PartnerListDto $dto): Collection
    {
        return $this->repository->adminList($dto);
    }

    public final function create(PartnerCreateDto $dto): Partner
    {
        return $this->repository->create($dto);
    }

    /**
     * @throws PartnerUpdateEmptyDataException|PartnerNotFoundException|PartnerUpdateFailedException
     */
    public final function update(Partner|string $partner, PartnerUpdateDto $dto): Partner
    {
        if (empty($dto->toArray())) {
            throw new PartnerUpdateEmptyDataException();
        }

        if (is_string($partner) && !$partner = $this->repository->item($partner)) {
            throw new PartnerNotFoundException();
        }

        return $this->repository->update($partner, $dto) ?? throw new PartnerUpdateFailedException();
    }

    /**
     * @throws PartnerNotFoundException|PartnerDeleteFailedException
     */
    public final function delete(Partner|string $partner): bool
    {
        if (is_string($partner) && !$partner = $this->repository->item($partner)) {
            throw new PartnerNotFoundException();
        }

        return $this->repository->delete($partner) ?: throw new PartnerDeleteFailedException();
    }
}
