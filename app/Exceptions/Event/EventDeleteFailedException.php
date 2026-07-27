<?php

declare(strict_types=1);

namespace App\Exceptions\Event;

use App\Exceptions\DomainException;
use Symfony\Component\HttpFoundation\Response;

final class EventDeleteFailedException extends DomainException
{
    public function __construct()
    {
        parent::__construct('exceptions.event.delete-failed', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
