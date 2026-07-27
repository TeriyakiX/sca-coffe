<?php

declare(strict_types=1);

namespace App\Exceptions\News;

use App\Exceptions\DomainException;
use Symfony\Component\HttpFoundation\Response;

final class NewsDeleteFailedException extends DomainException
{
    public function __construct()
    {
        parent::__construct('exceptions.news.delete-failed', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
