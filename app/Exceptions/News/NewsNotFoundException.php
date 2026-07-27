<?php

declare(strict_types=1);

namespace App\Exceptions\News;

use App\Exceptions\DomainException;
use Symfony\Component\HttpFoundation\Response;

final class NewsNotFoundException extends DomainException
{
    public function __construct()
    {
        parent::__construct('exceptions.news.not-found', Response::HTTP_NOT_FOUND);
    }
}
