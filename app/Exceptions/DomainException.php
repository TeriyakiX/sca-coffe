<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

abstract class DomainException extends Exception
{
    public function __construct(string $translationKey, int $status, array $replace = [])
    {
        parent::__construct(message: __($translationKey, $replace), code: $status);
    }

    public final function shouldLog(): bool
    {
        return $this->getCode() >= 500;
    }
}
