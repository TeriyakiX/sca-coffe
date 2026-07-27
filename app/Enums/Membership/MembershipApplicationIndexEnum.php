<?php

declare(strict_types=1);

namespace App\Enums\Membership;

use App\Models\MembershipApplication;

enum MembershipApplicationIndexEnum: string
{
    case INDEX_STATUS = 'ix_' . MembershipApplication::DATABASE_TABLE . '_' . MembershipApplication::STATUS;
    case INDEX_CATEGORY = 'ix_' . MembershipApplication::DATABASE_TABLE . '_' . MembershipApplication::CATEGORY;
    case INDEX_EMAIL = 'ix_' . MembershipApplication::DATABASE_TABLE . '_' . MembershipApplication::EMAIL;
}
