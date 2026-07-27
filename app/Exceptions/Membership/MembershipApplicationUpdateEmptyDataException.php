<?php

declare(strict_types=1);

namespace App\Exceptions\Membership;

use App\Exceptions\DomainException;
use Symfony\Component\HttpFoundation\Response;

final class MembershipApplicationUpdateEmptyDataException extends DomainException
{
    public function __construct()
    {
        parent::__construct('exceptions.membership.update-empty-data', Response::HTTP_BAD_REQUEST);
    }
}
