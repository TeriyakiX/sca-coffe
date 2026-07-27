<?php

declare(strict_types=1);

namespace App\Exceptions\Accreditation;

use App\Exceptions\DomainException;
use Symfony\Component\HttpFoundation\Response;

final class AccreditationApplicationUpdateFailedException extends DomainException
{
    public function __construct()
    {
        parent::__construct('exceptions.accreditation.update-failed', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
