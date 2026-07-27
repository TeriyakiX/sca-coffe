<?php

declare(strict_types=1);

namespace App\Exceptions\Contact;

use App\Exceptions\DomainException;
use Symfony\Component\HttpFoundation\Response;

final class ContactRequestUpdateEmptyDataException extends DomainException
{
    public function __construct()
    {
        parent::__construct('exceptions.contact.update-empty-data', Response::HTTP_BAD_REQUEST);
    }
}
