<?php

declare(strict_types=1);

namespace App\Exceptions\Accreditation;

use App\Exceptions\DomainException;
use Symfony\Component\HttpFoundation\Response;

final class AccreditationApplicationNotFoundException extends DomainException
{
    public function __construct()
    {
        parent::__construct('exceptions.accreditation.not-found', Response::HTTP_NOT_FOUND);
    }
}
