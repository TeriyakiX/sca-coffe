<?php

declare(strict_types=1);

namespace App\Exceptions\Partner;

use App\Exceptions\DomainException;
use Symfony\Component\HttpFoundation\Response;

final class PartnerNotFoundException extends DomainException
{
    public function __construct()
    {
        parent::__construct('exceptions.partner.not-found', Response::HTTP_NOT_FOUND);
    }
}
