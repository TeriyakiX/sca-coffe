<?php

declare(strict_types=1);

namespace App\Exceptions\Content;

use App\Exceptions\DomainException;
use Symfony\Component\HttpFoundation\Response;

final class ContentBlockUpdateFailedException extends DomainException
{
    public function __construct()
    {
        parent::__construct('exceptions.content.update-failed', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
