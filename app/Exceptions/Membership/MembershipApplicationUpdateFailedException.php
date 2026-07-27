<?php

declare(strict_types=1);

namespace App\Exceptions\Membership;

use App\Exceptions\DomainException;
use Symfony\Component\HttpFoundation\Response;

final class MembershipApplicationUpdateFailedException extends DomainException
{
    public function __construct()
    {
        parent::__construct('exceptions.membership.update-failed', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
