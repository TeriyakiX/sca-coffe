<?php

declare(strict_types=1);

namespace App\Exceptions\Partner;

use App\Exceptions\DomainException;
use Symfony\Component\HttpFoundation\Response;

final class PartnerDeleteFailedException extends DomainException
{
    public function __construct()
    {
        parent::__construct('exceptions.partner.delete-failed', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
