<?php

declare(strict_types=1);

namespace App\Exceptions\Event;

use App\Exceptions\DomainException;
use Symfony\Component\HttpFoundation\Response;

final class EventUpdateEmptyDataException extends DomainException
{
    public function __construct()
    {
        parent::__construct('exceptions.event.update-empty-data', Response::HTTP_BAD_REQUEST);
    }
}
