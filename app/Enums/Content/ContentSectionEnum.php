<?php

declare(strict_types=1);

namespace App\Enums\Content;

enum ContentSectionEnum: string
{
    case HOME = 'home';
    case ASSOCIATION = 'association';
    case STANDARDS = 'standards';
    case MEMBERSHIP = 'membership';
    case ACCREDITATION = 'accreditation';
    case EDUCATION = 'education';
    case REGISTRIES = 'registries';
    case PARTNERS = 'partners';
    case CONTACTS = 'contacts';

    public final function label(): string
    {
        return __('enums/content.section.' . $this->value);
    }
}
