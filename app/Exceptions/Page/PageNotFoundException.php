<?php

declare(strict_types=1);

namespace App\Exceptions\Page;

use App\Exceptions\DomainException;
use Symfony\Component\HttpFoundation\Response;

final class PageNotFoundException extends DomainException
{
    public function __construct()
    {
        parent::__construct('exceptions.page.not-found', Response::HTTP_NOT_FOUND);
    }
}
