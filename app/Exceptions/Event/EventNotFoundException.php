<?php

declare(strict_types=1);

namespace App\Exceptions\Event;

use App\Exceptions\DomainException;
use Symfony\Component\HttpFoundation\Response;

final class EventNotFoundException extends DomainException
{
    public function __construct()
    {
        parent::__construct('exceptions.event.not-found', Response::HTTP_NOT_FOUND);
    }
}
