<?php

declare(strict_types=1);

namespace App\Exceptions\Page;

use App\Exceptions\DomainException;
use Symfony\Component\HttpFoundation\Response;

final class PageUpdateFailedException extends DomainException
{
    public function __construct()
    {
        parent::__construct('exceptions.page.update-failed', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
