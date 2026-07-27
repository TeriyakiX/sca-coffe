<?php

declare(strict_types=1);

namespace App\Exceptions\Accreditation;

use App\Exceptions\DomainException;
use Symfony\Component\HttpFoundation\Response;

final class AccreditationApplicationUpdateEmptyDataException extends DomainException
{
    public function __construct()
    {
        parent::__construct('exceptions.accreditation.update-empty-data', Response::HTTP_BAD_REQUEST);
    }
}
