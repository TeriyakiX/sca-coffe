<?php

declare(strict_types=1);

namespace App\Exceptions\Page;

use App\Exceptions\DomainException;
use Symfony\Component\HttpFoundation\Response;

final class PageDeleteFailedException extends DomainException
{
    public function __construct()
    {
        parent::__construct('exceptions.page.delete-failed', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
