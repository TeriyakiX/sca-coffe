<?php

declare(strict_types=1);

namespace App\Exceptions\News;

use App\Exceptions\DomainException;
use Symfony\Component\HttpFoundation\Response;

final class NewsUpdateFailedException extends DomainException
{
    public function __construct()
    {
        parent::__construct('exceptions.news.update-failed', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
