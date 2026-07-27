<?php

declare(strict_types=1);

namespace App\Exceptions\Partner;

use App\Exceptions\DomainException;
use Symfony\Component\HttpFoundation\Response;

final class PartnerUpdateEmptyDataException extends DomainException
{
    public function __construct()
    {
        parent::__construct('exceptions.partner.update-empty-data', Response::HTTP_BAD_REQUEST);
    }
}
