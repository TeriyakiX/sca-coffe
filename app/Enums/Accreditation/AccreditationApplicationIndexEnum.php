<?php

declare(strict_types=1);

namespace App\Enums\Accreditation;

use App\Models\AccreditationApplication;

enum AccreditationApplicationIndexEnum: string
{
    case INDEX_STATUS = 'ix_' . AccreditationApplication::DATABASE_TABLE . '_' . AccreditationApplication::STATUS;
    case INDEX_TYPE = 'ix_' . AccreditationApplication::DATABASE_TABLE . '_' . AccreditationApplication::TYPE;
    case INDEX_EMAIL = 'ix_' . AccreditationApplication::DATABASE_TABLE . '_' . AccreditationApplication::EMAIL;
}
