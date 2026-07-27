<?php

declare(strict_types=1);

namespace App\Enums\Accreditation;

enum AccreditationTypeEnum: string
{
    case TRAINING_CENTER = 'training-center';
    case TRAINER = 'trainer';
    case PROGRAM = 'program';

    public final function label(): string
    {
        return __('enums/accreditation.type.' . $this->value);
    }
}
