<?php

declare(strict_types=1);

namespace App\Exceptions\Content;

use App\Exceptions\DomainException;
use Symfony\Component\HttpFoundation\Response;

final class ContentBlockUpdateEmptyDataException extends DomainException
{
    public function __construct()
    {
        parent::__construct('exceptions.content.update-empty-data', Response::HTTP_BAD_REQUEST);
    }
}
