<?php

declare(strict_types=1);

namespace App\Exceptions\Content;

use App\Exceptions\DomainException;
use Symfony\Component\HttpFoundation\Response;

final class ContentBlockNotFoundException extends DomainException
{
    public function __construct()
    {
        parent::__construct('exceptions.content.not-found', Response::HTTP_NOT_FOUND);
    }
}
