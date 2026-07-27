<?php

declare(strict_types=1);

namespace App\Enums\News;

enum NewsCategoryEnum: string
{
    case ASSOCIATION = 'association';
    case STANDARDS = 'standards';
    case EDUCATION = 'education';
    case COFFEE_RU = 'coffee-ru';
    case TEA_RU = 'tea-ru';
    case INTERNATIONAL = 'international';
    case EVENTS = 'events';
    case INTERVIEWS = 'interviews';
    case REGULATION = 'regulation';

    public final function label(): string
    {
        return __('enums/news.category.' . $this->value);
    }
}
