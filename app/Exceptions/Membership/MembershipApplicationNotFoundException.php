<?php

declare(strict_types=1);

namespace App\Exceptions\Membership;

use App\Exceptions\DomainException;
use Symfony\Component\HttpFoundation\Response;

final class MembershipApplicationNotFoundException extends DomainException
{
    public function __construct()
    {
        parent::__construct('exceptions.membership.not-found', Response::HTTP_NOT_FOUND);
    }
}
