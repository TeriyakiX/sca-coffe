<?php

declare(strict_types=1);

namespace App\Exceptions\News;

use App\Exceptions\DomainException;
use Symfony\Component\HttpFoundation\Response;

final class NewsUpdateEmptyDataException extends DomainException
{
    public function __construct()
    {
        parent::__construct('exceptions.news.update-empty-data', Response::HTTP_BAD_REQUEST);
    }
}
